<?php

namespace App\Http\Controllers\Admin;

use App\Attribute_Product;
use App\Http\Controllers\Controller;
use App\Preview;
use App\Product;
use App\ProductRelated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_products = Product::get();
        // dd($all_products);
        return view('admin.products.create', compact('all_products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'category_id' => 'required|integer',
            'content' => 'required',
            'price' => 'required|numeric',
            'img' => 'nullable|image',
            'preview0' => 'nullable|image',
            'preview1' => 'nullable|image',
            'preview2' => 'nullable|image',
        ]);
        // dd($request->all());
        $data = $request->all();

        $data['img'] = Product::uploadImage($request);
        $data['status'] = !empty($data['status']) ? 1 : 0;
        // dd($data);
        $product = Product::create($data);
        // filters
        $product_model = new Product();
        $product_model->editFilter($product->id, $data);
        $product_model->editRelatedProduct($product->id, $data);

        // dd($product);
        $previews_data = [];
        for ($i = 0; $i < 3; $i++) {
            if ($preview_file = Preview::uploadImage($request, $i)) {
                $previews_data['preview' . $i] = $preview_file;
            }
        }
        // dd($previews_data);
        if (count($previews_data)) {
            foreach ($previews_data as $key => $value) {
                // dd($key, $value);
                Preview::create(['product_id' => $product->id, 'img' => $value]);
            }
        }
        return redirect()
            ->route('products.index')
            ->with('success', 'Товар добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $category = $product->category;
        //получаем картинки previews если они есть
        $previews = Preview::where(['product_id' => $product->id])->get();
        //получаем фильтры товара
        $filter = Attribute_Product::where('product_id', $product->id)->pluck('attr_id', 'id')->all();
        // dd($filter);
        // $related_products = DB::select("select * from product_related JOIN products ON products.id=
        // product_related.related_id WHERE product_related.product_id=?", [$product->id]);
        $relateds = $product->relateds;
        // dd($relateds);
        // $related_products = [];
        // foreach ($relateds as $item) {
        //     $related_products[] = $item->products;
        // }
        $all_products = Product::get();
        // dd($all_products);
        session()->put('id', $category->id);
        // dump(session()->get('category'));
        return view('admin.products.edit', compact('product', 'previews', 'filter', 'all_products', 'relateds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required',
            'category_id' => 'required|integer',
            'content' => 'required',
            'price' => 'required|numeric',
            'img' => 'nullable|image',
            'preview0' => 'nullable|image',
            'preview1' => 'nullable|image',
            'preview2' => 'nullable|image',
        ]);
        // dd($request->all());
        $product = Product::find($id);
        $data = $request->all();
        //save filters
        $product_model = new Product();
        $product_model->editRelatedProduct($product->id, $data);
        $product_model->editFilter($product->id, $data);
        //сохраняется только один раз-если файла еше нет
        if ($file = Product::uploadImage($request, $product->img)) {
            $data['img'] = $file;
        }
        //object previews
        $previews = Preview::where(['product_id' => $product->id])->get();
        //получаем картинки previews если они есть

        $previews_data = [];
        // $previews = (count($previews)) ? $previews : null;
        for ($i = 0; $i < 3; $i++) {
            $previews[$i] = (!empty($previews[$i])) ? $previews[$i] : null;
            if ($preview_file = Preview::uploadImage($request, $i, $previews[$i])) {
                $previews_data["preview$i"] = $preview_file;
            }
        }
        // dd($previews);
        // dd($previews_data);
        if (count($previews_data)) {
            foreach ($previews_data as $key => $img) {
                // dump($key);
                $i = preg_replace("#\D+#", "", $key);
                // dd($i);
                if (!$previews[$i]) {
                    Preview::create(['product_id' => $product->id, 'img' => $img]);
                } else {
                    $previews[$i]->update(['img' => $img]);
                }
            }
        }

        $data['status'] = !empty($data['status']) ? 1 : 0;
        $product->update($data);
        return redirect()
            ->route('products.index')
            ->with('success', 'Изменения сохранены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        //delete filters of product
        Attribute_Product::where(['product_id' => $id])->delete();
        //delete related products of product
        ProductRelated::where(['product_id' => $id])->delete();
        //delete preview_image from folder previews/data and delete from DB
        $previews = Preview::where('product_id', $product->id)->get();
        for ($i = 0; $i < count($previews); $i++) {
            Storage::delete($previews[$i]->img);
            $previews[$i]->delete();
        }
        // dd($previews);
        //удаляем картинку
        Storage::delete($product->img);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Товар удален');
    }
}
