<?php

namespace App\Http\Controllers;

use App\Breadcrumbs;
use App\Category;
use App\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        // $cats = Category::all();
        if (Cache::has('br_menus')) {
            $cats = Cache::get('br_menus');
        } else {
            $cats = Category::all();
            Cache::put('br_menus', $cats, 60 * 24 * 7);
        }
        //
        $category = Category::where('slug', $slug)->firstOrFail();
        //получаем товары как самой $category, так и ее дочерних категорий
        $model = new Category();
        $ids = $category->id . ',';
        $ids .= $model->getIds($category->id, $cats);
        $ids = trim($ids, ',');
        $ids = explode(',', $ids);
        // dd($ids);

        $products = Product::whereIn('category_id', $ids)->paginate(6);

        //здесь $ids строка
        // $products = DB::select(
        //     "select * from products where category_id IN ($ids)"
        // );
        // dd($products);
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id, $category->title);

        return view('categories.show', compact('category', 'products', 'breadcrumbs'));
    }
}
