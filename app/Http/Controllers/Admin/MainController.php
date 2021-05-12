<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\User;

class MainController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $categories = Category::all();
        $users = User::all();
        $products = Product::all();
        // dd($orders, $categories, $users, $products);
        return view('admin.main.index', compact('orders', 'categories', 'users', 'products'));
    }
}
