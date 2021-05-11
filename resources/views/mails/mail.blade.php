<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <p>Вы сделали заказ №{{ $order_id }} на сайте "Luxury Watches"</p>
    <table style="border: 1px solid #ddd; border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background: #f9f9f9;">
                <th style="padding: 8px; border: 1px solid #ddd;">Наименование</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Кол-во</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Цена</th>
                <th style="padding: 8px; border: 1px solid #ddd;">Сумма</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $item['title'] }}
                </td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $item['qty'] }}
                </td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $item['price'] }}
                </td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $item['price'] * $item['qty'] }}
                </td>
            </tr>
            @endforeach

            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">Итого:</td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $cart_qty[0] }}
                </td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;">На сумму:</td>
                <td></td>
                <td></td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ session('cart_currency')->symbol_left }}{{ $cart_sum[0] }}{{ session('cart_currency')->symbol_right }}
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>
