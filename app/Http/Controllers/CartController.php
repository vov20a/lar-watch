<?php

namespace App\Http\Controllers;

use App\Breadcrumbs;
use App\Cart;
use App\Mail\UserMail;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // dd($request->data);
        //если qty!=1 то берут значение из input value=?-ставим в карточке продукта
        if ($request->get('id') && $request->ajax()) {
            $id = $request->get('id');

            $product = Product::find($id);
            if (!$product) {
                return false;
            }
            $qty = $request->get('qty');
            $cart = new Cart();
            $cart->addToCart($product, $qty);

            return view('carts.cart-modal');
            // echo $session;
            //die;
        }
        //запрос пришел без обработки javascript
        return redirect()
            ->back()
            ->with('error', 'Incorrect add a product');
    }
    public function show(Request $request)
    {
        // echo ('vova');
        // die();
        return view('carts.cart-modal');
    }
    public function delItem(Request $request)
    {
        $id = (int) $request->id;
        if (!$id) {
            return false;
        }
        $cart = new Cart();
        $cart->recalc($id);
        if ($request->ajax()) {
            return view('carts.cart-modal');
        }
        //запрос пришел без js
        return redirect()
            ->back()
            ->with('error', 'Incorrect delete a product');
    }
    public function clearCart(Request $request)
    {
        if ($request->ajax()) {
            session()->forget('cart');
            session()->forget('cart_qty');
            session()->forget('cart_sum');
            return view('carts.cart-modal');
        }
        //запрос пришел без обработки javascript
        return redirect()
            ->back()
            ->with('error', 'Incorrect clear cart');
    }
    public function checkout()
    {
        $arr = session('cart');
        $arr_qty = session('cart_qty');
        $arr_sum = session('cart_sum');
        $breadcrumbs = Breadcrumbs::getBreadcrumbs('', 'checkout');
        return view('carts.checkout', compact('arr', 'arr_qty', 'arr_sum', 'breadcrumbs'));
    }
    public function changeCart(Request $request)
    {
        if ($request->ajax()) {
            $qty = $request->qty;
            $id = (int) $request->id;
            $product = Product::find($id);
            if (!$product) {
                return false;
            }
            $cart = new Cart();
            $qty = $cart->addToCart($product, $qty);
            return [
                'qty' => $qty,
                'id' => $product->id,
                'price' => $product->price,
                'sum' => session('cart_sum')[0],
                'qty_total' => session('cart_qty')[0],
            ];
            // echo json_encode(['qty' => $qty]);
            // die();
            // return view('carts.cart-modal');
        }
        //запрос пришел без js
        return redirect()
            ->back()
            ->with('error', 'Incorrect change a product');
    }
    public function send(Request $request)
    {
        if ($request->method() == 'POST') {
            // dump($request->all());
            // dd(session('cart_currency'));
            if (auth()->guest()) {
                $request->validate([
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users',
                    'phone' => 'required',
                    'password' => 'required',
                ]);
                //прошли валидацию-сохраняем usera
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
                //сразу авторизован
                Auth::login($user);
            } elseif (auth()->user()) {
                $request->validate([
                    'phone' => 'required',
                ]);
                $user = User::find(Auth::user()->id);
            }
            //сохраняем часть данных в табл orders
            $order = Order::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'note' => $request->note,
                'currency_id' => session('cart_currency')->id,
            ]);
            //сохраняем  данные для письма
            $products = session('cart');
            $cart_qty = session('cart_qty');
            $cart_sum = session('cart_sum');
            $data = [$products, $cart_qty, $cart_sum, $order->id];
            // dd($products);
            //сохраняем часть данных в табл order-product
            for ($i = 0; $i < count($products); $i++) {
                $order->products()->syncWithoutDetaching([
                    [
                        'product_id' => $products[$i]['id'],
                        'qty' => $products[$i]['qty'],
                        'title' => $products[$i]['title'],
                        'price' => $products[$i]['price'],
                    ],
                ]);
            }
            //отправка двух писем-  to user
            Mail::to($user->email)->send(new UserMail($data));
            // to admin
            Mail::to('vov20a@mail.ru')->send(new UserMail($data));
            //delete session
            session()->forget('cart');
            session()->forget('cart_qty');
            session()->forget('cart_sum');
            session()->forget('cart_currency');
            return redirect()
                ->back()
                ->with('success', 'Заказ принят');
        }
        //конец метода POST

        return redirect()->back();
    }
}
