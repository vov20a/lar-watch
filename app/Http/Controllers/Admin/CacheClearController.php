<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class CacheClearController extends Controller
{
    public function clear(Request $request)
    {

        if ($request->method() == 'DELETE') {
            if ($request->filter == 'filter') {
                Cookie::queue(Cookie::forget('groups'));
                Cookie::queue(Cookie::forget('attrs'));
                // Cache::forget('groups');
                // Cache::forget('attrs');
                return redirect()->back()->with('success', 'Cookie filters is cleared');
            } else if ($request->currency == 'currency') {
                //текущая валюта
                Cookie::queue(Cookie::forget('currency'));
                //список всех валют-massive
                Cookie::queue(Cookie::forget('currencies_arr'));
                //при F5 перегружается только CurrencyComposer,но валюта в корзине не пересчитывается
                //даем команду на пересчет при валюте  'USD'
                $currency = Currency::where(['code' => 'USD'])->firstOrFail();
                if ($currency) {
                    Cart::recalcCurrency($currency);
                    return redirect()->back()->with('success', 'Cookie currency is cleared');
                }
                return redirect()->back()->with('error', 'Cookie currency is not cleared');
            } else if ($request->recentlyViewed == 'recentlyViewed') {
                Cookie::queue(Cookie::forget('recentlyViewed'));
                return redirect()->back()->with('success', 'Cookie recentlyViewed is cleared');
            } else if ($request->menu == 'menu') {
                Cache::forget('menus');
                return redirect()->back()->with('success', 'Cache menu is cleared');
            } else {
                return redirect()->back()->with('error', 'Cache Not Found');
            }
        }
        return view('admin.clear');
    }
}
