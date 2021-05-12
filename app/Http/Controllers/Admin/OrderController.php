<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(session()->all()['_flash']['new'] = 'Vova');
        // dd(session()->all()['_previous']['url']);
        // session()->forget('success-status');

        $orders = Order::with('user')->orderBy('id', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id')->all();
        $products = Product::pluck('title', 'id')->all();
        $currencies = Currency::pluck('code', 'id')->all();
        // dd($currencies);
        return view('admin.orders.create', compact('users', 'products', 'currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'quantity' => 'required|integer',
            'note' => 'nullable|string',
            'phone' => 'string',
            'currency' => 'string',
        ]);
        // dd($request->currency);
        $data = $request->all();
        //достаем валюту с коэффициентом
        $currency = Currency::find($request->currency);
        $order = Order::create([
            'user_id' => $request->user_id,
            'note' => $request->note,
            'phone' => $request->phone,
            'currency_id' => $currency->id,
        ]);
        // dd($data['quantity']);
        $products = $request->products;
        $prod = [];
        foreach ($products as $k => $v) {
            $prod[$k] = Product::find($v);
        }
        // dd($currency->value);
        //сохраняем данные в таб order_product attach([1 => ['expires' => true], 2, 3]);
        for ($i = 0; $i < count($products); $i++) {
            $order->products()->syncWithoutDetaching([
                $products[$i] => [
                    'qty' => $data['quantity'],
                    'title' => $prod[$i]->title,
                    'price' => $prod[$i]->price * $currency->value,
                ],
            ]);
        }
        return redirect()
            ->route('orders.index')
            ->with('success', 'Заказ добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //показывает flash-message при изменении status
        if ($request->status == '1') {
            return redirect()->back()->with('success', 'Заказ завершен');
        } else if ($request->status == '2') {
            return redirect()->back()->with('success', 'Заказ в работе');
        }
        $data = DB::select(
            'SELECT orders.id as order_id,orders.status,orders.note,orders.created_at,orders.updated_at,orders.phone,
            currencies.code, currencies.value, currencies.symbol_left, currencies.symbol_right,
            users.name,
            order_product.product_id, order_product.title, order_product.qty, order_product.price
            FROM orders
            JOIN currencies ON currencies.id=orders.currency_id
            JOIN users ON users.id=orders.user_id
            JOIN order_product ON order_product.order_id=orders.id
            WHERE orders.id=? ',
            [$id]
        );
        $qtys = 0;
        $sum = 0;
        foreach ($data as $item) {
            $qtys += $item->qty;
            $sum += $item->qty * $item->price;
        }
        // dd($data);
        // $data = DB::select(
        //     'select orders.*, users.name,
        //         SUM(order_product.qty) as num, ROUND(SUM(order_product.qty*order_product.price),2) AS sum
        //         FROM orders
        //         JOIN users ON orders.user_id=users.id
        //         JOIN order_product ON orders.id=order_product.order_id
        //         WHERE order_id = ?
        //         GROUP BY order_id',
        //     [$id]
        // );

        return view('admin.orders.show', compact('data', 'qtys', 'sum', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        //удаляем все связанные данные
        $order->products()->sync([]);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Заказ удален');
    }
    public function status(Request $request)
    {
        if ($request->method() == 'POST') {
            $order = Order::where('id', '=', $request->id)->firstOrFail();
            if ($order->status) {
                $status = 2;
                $order->status = 0;
                $order->save();
            } else {
                $status = 1;
                $order->status = 1;
                $order->save();
            }
            //current url-....../admin/orders/show.blade.php
            // echo (session()->all()['_previous']['url']);
            // die;
            return response()->json([
                'status' => $status,
                'http' => session()->all()['_previous']['url']
            ]);
        }
        // return redirect()->back();
    }
}
