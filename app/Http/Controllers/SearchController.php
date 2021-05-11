<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // dd($request);
        //1 этап - получаем get-param term-начало ввода
        if (isset($_GET['term']) && $request->ajax()) {
            $q = trim($_GET['term']);
            $arr = [];
            $products = Product::where('title', 'LIKE', "%{$q}%")
                ->limit(10)
                ->get();
            // dd($products);
            foreach ($products as $product) {
                array_push($arr, $product['title']);
            }
            $json = json_encode($arr);
            exit($json);
        }
        //второй запрос через autocomplete search-клик по Поиск
        if (isset($_GET['search']) && $request->ajax()) {
            $search = trim($_GET['search']);
            $product = Product::where('title', '=', $search)->firstOrFail();
            $json = json_encode($product);
            exit($json);
        }
        //обычный запрос - через submit form
        $search = isset($_GET['search']) ? trim($_GET['search']) : null;
        if (!$search) {
            return redirect(route('home'))->with(
                'error',
                'Ошибка в запросе....'
            );
        }
        $products = Product::where('title', 'LIKE', "%{$search}%")->paginate(6);
        //   $products = \R::getAll("SELECT product.*, menu.title AS cat
        //   FROM product JOIN menu ON menu.id = product.category_id  WHERE product.title LIKE ?
        //   ORDER BY product.id LIMIT $start, $perpage ", ["%{$q}%"]);

        return view('search.index', compact('search', 'products'));
    }
}
