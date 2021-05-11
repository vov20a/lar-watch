<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;

class Cart
{
    public function addToCart($product, $qty = 1)
    {
        if (empty(session('cart_currency'))) {
            session()->put('cart_currency', unserialize(Cookie::get('currency')));
        }
        // return session('cart_currency')->code;
        $qty = $qty == '-1' ? -1 : (int)$qty;
        $arr = !empty(session('cart')) ? session('cart') : [];
        if (!empty($arr)) {
            //в корзине лежит первый товар-добавляем второй,третий и тд
            for ($i = 0; $i < count($arr); $i++) {
                //изменяем старый
                if ($arr[$i]['id'] == $product->id) {
                    $arr[$i] = [
                        'id' => $arr[$i]['id'],
                        'title' => $arr[$i]['title'],
                        'price' => $arr[$i]['price'], // * session('cart_currency')->value,
                        'slug' => $arr[$i]['slug'],
                        'qty' => $arr[$i]['qty'] + $qty,
                        'img' => $arr[$i]['img'],
                        'currency' => session('cart_currency'),
                    ];
                    $this->addAgrigate($qty, $arr[$i]['price']);
                    if ($arr[$i]['qty'] == 0) {
                        $qty = 0;
                        array_splice($arr, $i, 1);
                    } else {
                        $qty = $arr[$i]['qty'];
                    }
                    break;
                    //добавляем новый
                } elseif ($i == count($arr) - 1) {
                    $arr[$i + 1] = [
                        'id' => $product->id,
                        'title' => $product->title,
                        'price' => $product->price * session('cart_currency')->value,
                        'slug' => $product->slug,
                        'qty' => $qty,
                        'img' => $product->img,
                        'currency' => session('cart_currency'),
                    ];
                    $this->addAgrigate(
                        $arr[$i + 1]['qty'],
                        $arr[$i + 1]['price']
                    );
                    break;
                }
            }
            session()->put('cart', $arr);
            return $qty;
        }
        //первый продукт
        else {
            session()->push('cart', [
                'id' => $product->id,
                'title' => $product->title,
                'price' => $product->price * session('cart_currency')->value,
                'slug' => $product->slug,
                'qty' => $qty,
                'img' => $product->img,
                'currency' => session('cart_currency'),
            ]);
            $this->addAgrigate(
                session('cart')[0]['qty'],
                session('cart')[0]['price']
            );
        }
    }
    protected function addAgrigate($qty, $price)
    {
        $qty_arr = !empty(session('cart_qty')) ? session('cart_qty') : [];
        if (empty($qty_arr)) {
            $qty_arr[0] = $qty;
        } else {
            $qty_arr[0] += $qty;
        }
        session()->put('cart_qty', $qty_arr);

        $sum_arr = !empty(session('cart_sum')) ? session('cart_sum') : [];
        if (empty($sum_arr)) {
            $sum_arr[0] = $qty * $price;
        } else {
            $sum_arr[0] += $qty * $price;
        }
        session()->put('cart_sum', $sum_arr);
    }
    //удоление товара
    public function recalc($id)
    {
        $arr = session('cart');
        if (empty($arr)) {
            return false;
        }
        $qty_arr = session('cart_qty');
        $sum_arr = session('cart_sum');
        for ($i = 0; $i < count($arr); $i++) {
            if ($arr[$i]['id'] == $id) {
                $qtyMinus = $arr[$i]['qty'];
                $sumMinus = $arr[$i]['qty'] * $arr[$i]['price'];
                $qty_arr[0] -= $qtyMinus;
                $sum_arr[0] -= $sumMinus;
                session()->put('cart_qty', $qty_arr);
                session()->put('cart_sum', $sum_arr);
                // unset($arr[$i]); нарушается порядок следования
                //все э-ты смещаются и идут по порядку--yдаляется только $i
                array_splice($arr, $i, 1);
            }
        }
        session()->put('cart', $arr);
    }
    public static function recalcCurrency($currency)
    {
        //$currency-новая валюта- объект
        if (!empty(session('cart_currency'))) {
            //валюта в которой лежит товар в корзине- объект
            $cart_currency = session('cart_currency');
            //array[i][product]данные о товаре в корзине
            $cart = session('cart');
            //array[0] общая сумма
            $sum_arr = session('cart_sum');
            // dd($cart_currency->code, $cart, $sum_arr, $currency->code);
            //пересчет общей суммы в новую валюту
            if (!empty($cart)) {
                //перевод из доллара в другую валюту
                if ($cart_currency->base) {
                    $sum_arr[0] *= $currency->value;
                } else {
                    //перевод из другой валюты в другую валюту(через доллар)(делим на курс старой валюты и умн. на курс новой)
                    $sum_arr[0] = round($sum_arr[0] / $cart_currency->value * $currency->value, 2);
                    // dd($sum_arr);
                }
                //пересчет каждого товара в новую валюту
                foreach ($cart as $k => $v) {
                    if ($cart_currency->base) {
                        $cart[$k]['price'] *= $currency->value;
                    } else {
                        $cart[$k]['price'] = round($cart[$k]['price'] / $cart_currency->value *
                            $currency->value, 2);
                    }
                }
                // dd($cart);
            }

            session()->put('cart', $cart);
            session()->put('cart_sum', $sum_arr);
            session()->put('cart_currency', $currency);
            // dd(session('cart_currency'), session('cart'), session('cart_sum'));
        }
    }
}
