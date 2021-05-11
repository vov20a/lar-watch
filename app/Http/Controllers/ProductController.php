<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Breadcrumbs;
use App\Preview;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        // dd($product);
        $category = Category::where('id', $product->category_id)->firstOrFail();
        // dd($category);
        $popular_brands = Product::where('id', '>', '7')
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();
        // dd($popular_brands);
        $previews = Preview::where('product_id', $product->id)->limit(3)->get();
        // dd($previews);
        //запись  в cookies просмотренныx товаров
        Product::setRecentlyViewed($product->id);

        //просмотр товаров в cookies
        $r_viewed = Product::getRecentlyViewed();
        // dd($r_viewed);
        $recently_viewed = null;
        if ($r_viewed) {
            $recently_viewed = Product::find($r_viewed);
        }
        // dd($recently_viewed);
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category->id, $product->title, true);
        // echo $breadcrumbs;
        // die;
        $has_banner = false;
        return view(
            'products.show',
            compact('category', 'product', 'previews', 'recently_viewed', 'popular_brands', 'breadcrumbs', 'has_banner')
        );
    }
}
