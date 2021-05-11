<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('id', '<', 9)->get();
        // dd($products);
        $has_banner = True;
        return view('home.index', compact('products', 'has_banner'));
    }
}
