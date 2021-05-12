<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //нет пагинации - виджет выводит все категории
        // $categories = Category::paginate(5);
        $categories = Category::get();
        // dd($categories);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'parent_id' => 'required|nullable|integer',
            'keywords' => 'required',
            'description' => 'required',
        ]);
        //dd($request->all());
        Category::create($request->all());
        // $request->sesion()->flash('success', 'Категория добавлена');
        return redirect()
            ->route('categories.index')
            ->with('success', 'Категория добавлена');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        session()->put('parent_id', $category->parent_id);
        session()->put('id', $category->id);

        return view('admin.categories.edit', compact('category'));
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
            'parent_id' => 'required|integer',
            'keywords' => 'required',
            'description' => 'required',
        ]);
        // dd($request->all());
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()
            ->route('categories.index')
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
        //dd($id);
        $category = Category::find($id);
        $category_child = DB::select(
            'select * from categories where parent_id = ? LIMIT 1',
            [$category->id]
        );

        //если есть дочерние кат-ии то удаление невозможно
        if ($category_child) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Ошибка! У категории есть дочерняя категория.');
        }
        //если есть товары у категории то удаление невозможно
        if ($category->products->count()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Ошибка! У категории есть товары.');
        }
        $category->delete();
        // Category::destroy($id);
        return redirect()
            ->route('categories.index')
            ->with('success', 'Категория удалена');
    }
}
