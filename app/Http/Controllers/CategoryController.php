<?php

namespace App\Http\Controllers;

use App\Attribute_Product;
use App\Breadcrumbs;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $filter = null;
    public $cnt_groups = null;

    public function show($slug, Request $request)
    {
        // $cats = Category::all();
        if (Cache::has('br_menus')) {
            $cats = Cache::get('br_menus');
        } else {
            $cats = Category::all();
            Cache::put('br_menus', $cats, 60 * 24 * 7);
        }
        //ajax request

        // if ($request->filter) {
        //     $filter = Category::getFilter($request);

        /* Запрос на фильрацию по взаимо-исключающему для каждой группы фильтру */
        // DB::select(
        //    'SELECT `product`.* FROM `product` WHERE category_id IN (6) AND id IN
        //     (
        //         SELECT product_id FROM attribute_product WHERE attr_id IN(1,5) GROUP BY product_id HAVING COUNT(product_id)=2
        //     )'
        // );
        // SELECT `product`.* FROM `product` WHERE category_id IN (6) AND id IN
        // (
        //     SELECT product_id FROM attribute_product WHERE attr_id IN(1,5) GROUP BY product_id HAVING COUNT(product_id)=2
        // )
        // }


        $filter = $this->filter;
        $category = Category::where('slug', $slug)->firstOrFail();
        //получаем товары как самой $category, так и ее дочерних категорий
        $model = new Category();
        $ids = $category->id . ',';
        $ids .= $model->getIds($category->id, $cats);
        $ids = trim($ids, ',');
        $ids = explode(',', $ids);

        session()->forget('filter');
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id, $category->title);
        //страница categories.filter показывается двумя путями:
        //1-Ajax запрос $request->ajax()
        //2-при пагинации-включается в вид categories.show когда show=true(продукты категории выключаются)
        $show = false;
        if ($request->filter) {
            $this->filter = Category::getFilter($request);
            //посчет задействованных групп
            $this->cnt_groups = Category::getCountFilter($this->filter);
            // dd($this->cnt_groups);
            if ($request->ajax()) {
                $this->filter = explode(',', $this->filter);
                //запоминаем отмеченные фильтры
                session()->put('filter', $this->filter);
                // $products = Product::whereIn('category_id', $ids)->whereIn('id', function ($query) {
                //     $query->select('product_id')->from('Attribute__Products')->whereIn('attr_id', $this->filter);
                // })->paginate(3);
                $products = Product::whereIn('category_id', $ids)->whereIn('id', function ($query) {
                    $query->select('product_id')->from('Attribute__Products')->whereIn('attr_id', $this->filter)->groupBy('product_id')->havingRaw("COUNT('product_id') = ?", [$this->cnt_groups]);
                })->paginate(3);
                $filter = implode(',', $this->filter);
                // dd($products);
                return view('categories.filter', compact('products', 'category', 'filter'));
            }
            $filter = $this->filter;
            $this->filter = explode(',', $this->filter);
            session()->put('filter', $this->filter);
            $products = Product::whereIn('category_id', $ids)->whereIn('id', function ($query) {
                $query->select('product_id')->from('Attribute__Products')->whereIn('attr_id', $this->filter)->groupBy('product_id')->havingRaw("COUNT('product_id') = ?", [$this->cnt_groups]);
            })->paginate(3);
            $show = true;
            return view('categories.show', compact('products', 'category', 'breadcrumbs', 'filter', 'show'));
        }

        //обычный вывод продуктов категории
        $products = Product::whereIn('category_id', $ids)->paginate(3);
        //здесь $ids строка
        // $products = DB::select(
        //     "select * from products where category_id IN ($ids)"
        // );
        // dd($products);
        return view('categories.show', compact('category',  'breadcrumbs', 'products', 'filter', 'show'));
    }
}
