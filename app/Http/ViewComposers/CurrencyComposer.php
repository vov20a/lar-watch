<?php

namespace app\Http\ViewComposers;

use App\Currency;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cookie;

class CurrencyComposer
{

    public function compose(View $view)
    {
        $currency = self::getStart();
        $currencies_arr = self::getCurrencies();
        $currency_arr = [];
        $key = $currency->code;
        // dd(var_dump($currency));

        if (array_key_exists($key, $currencies_arr)) {
            $currency_arr = $currencies_arr[$key];
            $currency_arr['code'] = $key;
        }
        return $view->with(['currencies' => $currencies_arr, 'currency' => $currency_arr]);
    }
    public static function getStart()
    {
        //get from cookie or put in cookie
        if (Cookie::get('currency')) {
            $currency = Cookie::get('currency');
            $currency = unserialize($currency);
        } else {
            $currency = Currency::where(['base' => true])->firstOrFail();
            //для работы с куками
            $currency = serialize($currency);
            Cookie::queue('currency', $currency, 60 * 24 * 7);
            // Cookie::queue('currency', $currency, 0);
            //получаем опять объект
            $currency = unserialize($currency);
        }
        return $currency;
    }
    public static function getCurrencies()
    {
        //get from cookie or put in cookie
        if (Cookie::get('currencies_arr')) {
            $currencies_arr = Cookie::get('currencies_arr');
            $currencies_arr = unserialize($currencies_arr);
        } else {
            $currencies = Currency::orderBy('base', 'desc')->get();
            $currencies_arr = [];
            foreach ($currencies as $k => $item) {
                $currencies_arr[$item->code]['title'] = $item->title;
                $currencies_arr[$item->code]['code'] = $item->code;
                $currencies_arr[$item->code]['symbol_left'] = $item->symbol_left;
                $currencies_arr[$item->code]['symbol_right'] = $item->symbol_right;
                $currencies_arr[$item->code]['value'] = $item->value;
                $currencies_arr[$item->code]['base'] = $item->base;
            }
            //для работы с куками
            $currencies_arr = serialize($currencies_arr);
            Cookie::queue('currencies_arr', $currencies_arr, 60 * 24 * 7);
            //получаем опять объект
            $currencies_arr = unserialize($currencies_arr);
        }
        return $currencies_arr;
    }
}
