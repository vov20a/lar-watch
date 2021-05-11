@if (!empty(session('cart')))
<div class="table-responsive">
    <table class="table table-hover table-striped cart-table">
        <thead>
            <tr>
                <th>Фото</th>
                <th>Наименование</th>
                <th>Количество</th>
                <th>Цена</th>
                <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
            </tr>
        </thead>
        <tbody>
            @foreach (session('cart') as $item)
            <tr>
                <td><img src="{{ asset('uploads/' . $item['img']) }}" alt="" style="max-height: 40px;">
                </td>
                <td>{{ $item['title'] }} </td>
                <td>{{ $item['qty'] }} </td>
                <td>{{ round($item['price'], 2) }} </td>
                <td><span data-id="{{ $item['id'] }} " class="glyphicon glyphicon-remove text-danger del-item"
                        style="color: #fa1818;cursor: pointer;" aria-hidden="true"></span>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2">Итого: </td>
                <td id="cart-qty">{{ session('cart_qty')[0] }} </td>
            </tr>
            <tr>
                <td colspan="3">На сумму: </td>
                <td id="cart-sum">
                    {{ session('cart_currency')->symbol_left }}{{ round(session('cart_sum')[0], 2) }}{{ session('cart_currency')->symbol_right }}
                </td>
            </tr>
        </tbody>
    </table>
</div>


@else
<h3>Корзина пуста</h3>
@endif
