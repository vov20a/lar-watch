@extends('layouts.layout')
@section('title', 'Checkout : Luxure Watches')
@section('content')
<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                {!! $breadcrumbs !!}
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--prdt-starts-->
<div class="prdt">
    <div class="container">
        <div class="prdt-top">
            <div class="col-md-12">
                <div class="product-one cart row">
                    <div class="register-top heading">
                        <h2>Оформление заказа</h2>
                    </div>
                    <br>
                    @if (!empty(session('cart')))
                    <div class="table-responsive col-md-7 checkout-table">
                        <h3>Ваша корзина состоит из : <span>{{ count($arr) }} товар(ов)</span></h3>
                        <div class="overlay">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10%">Фото</th>
                                    <th style="width: 30%">Наименование</th>
                                    <th style="width: 10%">Коррекция</th>
                                    <th class="text-center" style="width: 20%">Количество(шт)</th>
                                    <th class="text-center" style="width: 20%">Цена</th>
                                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{ dd($arr) }} --}}
                                @foreach ($arr as $i => $item)
                                <tr>
                                    <td><a href="{{ route('products.single', ['slug' => $item['slug']]) }}"><img
                                                src="{{ asset('/uploads/' . $item['img']) }}" alt=""
                                                style="height: 40px"></a></td>
                                    <td><a
                                            href="{{ route('products.single', ['slug' => $item['slug']]) }}">{{ $item['title'] }}</a>
                                    </td>
                                    <td>
                                        <span data-id="{{ $item['id'] }}" data-qty="1" value="1"
                                            class="glyphicon glyphicon-plus text-danger value-plus"
                                            aria-hidden="true"></span>
                                        <span data-id="{{ $item['id'] }}" data-qty="-1" value="-1"
                                            class="glyphicon glyphicon-minus text-danger value-minus"
                                            aria-hidden="true"></span>
                                    </td>
                                    <td class="text-center quantity">{{ $item['qty'] }}</td>
                                    <td class="text-center">{{ round($item['price'], 2) }}</td>
                                    <td><span data-id="{{ $item['id'] }}"
                                            class="glyphicon glyphicon-remove text-danger del-item"
                                            aria-hidden="true"></span>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Количество:</td>
                                    <td></td>
                                    <td></td>
                                    @php
                                    $qty_total = 0;
                                    foreach ($arr as $item):
                                    $qty_total += $item['qty'];
                                    endforeach;
                                    @endphp
                                    <td id="qty_total" class="text-center">{{ $qty_total }}</td>
                                </tr>
                                <tr>
                                    <td>Сумма:</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center sum-total">
                                        {{ session('cart_currency')->symbol_left }}{{ round($arr_sum[0], 2) }}{{ session('cart_currency')->symbol_right }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-5 account-right">
                        <h3>Отправить сообщение</h3>
                        @if (auth()->check())
                        <form action="{{ route('send.mail') }}" method="POST" data-toggle="validator">
                            @csrf
                            <div class="box-body">
                                <div class="form-group  has-feedback">
                                    <label for="phone">Phone</label>
                                    <input type="tel" name='phone'
                                        class="form-control @error('phone')  is-invalid @enderror" id="phone"
                                        placeholder="Telephone" pattern="^[0-9-]{1,}$" required
                                        data-error="Допускаются только цифры и дефис" value="{{ old('phone') }}">
                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    @error('phone')
                                    <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class=" form-group">
                                    <label for=" note">Note</label>
                                    <textarea class="form-control" name="note" id="note" cols="10" rows="5"
                                        placeholder="Примечания"></textarea>
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">Отправить</button>
                            </div>
                        </form>
                        @else
                        <form action="{{ route('send.mail') }}" method="POST" data-toggle="validator">
                            @csrf
                            <div class="box-body">

                                <div class="form-group   has-feedback @error('name')  is-invalid @enderror">
                                    <label for="name">Name</label>
                                    <input type="text" name='name' value="{{ old('name') }}"
                                        class="form-control @error('name')  is-invalid @enderror" id="name"
                                        placeholder="Name" required>
                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    @error('name')
                                    <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group   has-feedback @error('email')  is-invalid @enderror">
                                    <label for="email">Email</label>
                                    <input type="email" name='email' value="{{ old('email') }}"
                                        class="form-control @error('email')  is-invalid @enderror" id="email"
                                        placeholder="Email" required>
                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    @error('email')
                                    <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('password')  is-invalid @enderror">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        required>
                                    @error('password')
                                    <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('password_confirmation')  is-invalid @enderror">
                                    <label>Confirmation</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Retype password" required>
                                    @error('password_confirmation')
                                    <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group  has-feedback">
                                    <label for="phone">Phone</label>
                                    <input type="tel" name='phone'
                                        class="form-control @error('phone')  is-invalid @enderror" id="phone"
                                        placeholder="Telephone" pattern="^[0-9-]{1,}$" required
                                        data-error="Допускаются только цифры и дефис" value="{{ old('phone') }}">
                                    <div class="help-block with-errors"></div>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    @error('phone')
                                    <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class=" form-group">
                                    <label for=" note">Note</label>
                                    <textarea class="form-control" name="note" id="note" cols="10" rows="5"
                                        placeholder="Примечания"></textarea>
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">Отправить</button>
                            </div>
                        </form>
                        @endif
                        <div class="clearfix"> </div>
                    </div>
                    @else
                    <h3>Корзина пуста</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!--product-end-->
<script>
    let symbol_left = "{{ session('cart_currency') ? session('cart_currency')->symbol_left : '' }}"
        let symbol_right = "{{ session('cart_currency') ? session('cart_currency')->symbol_right : '' }}"
        let value = "{{ session('cart_currency') ? session('cart_currency')->value : 1 }}"

</script>
@endsection
