<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CurrencyController extends Controller
{
    public function change(Request $request)
    {
        if ($request->method() == 'GET') {
            $currency = Currency::where(['code' => $request->curr])->firstOrFail();
            if ($currency) {
                $currency = serialize($currency);
                Cookie::queue('currency', $currency, 60 * 24 * 7);
                // Cookie::queue('currency', $currency, 0);
                //вызывается для пересчета валюты в корзине-был доллар стал Евро
                Cart::recalcCurrency(unserialize($currency));
            }
        }
        return redirect()->back();
    }
}
