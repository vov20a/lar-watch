<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Breadcrumbs;
use App\Preview;
use App\RelatedProduct;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        // dd($product);
        $category = Category::where('id', $product->category_id)->firstOrFail();
        // dd($category);
        $related_products = DB::select("select * from product_related JOIN products ON products.id=
        product_related.related_id WHERE product_related.product_id=?", [$product->id]);
        // $related = \R::getAll("SELECT * FROM related_product JOIN product ON product.id=
        // related_product.related_id WHERE related_product.product_id=?", [$product->id]);

        // $related_products = RelatedProduct::with('products')->sync($product->relateds)->get();
        // dd($related_products);
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
            compact('category', 'product', 'previews', 'recently_viewed', 'related_products', 'breadcrumbs', 'has_banner')
        );
    }
}
