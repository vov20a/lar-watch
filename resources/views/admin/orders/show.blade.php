@extends('admin.layouts.layout')
@section('title','AdminLTE|Orders')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('admin.layouts.errors')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Заказ №{{ $id }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Список заказов</a></li>
                            <li class="breadcrumb-item active"> Заказ №{{ $id }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <td>Номер заказа</td>
                                        <td>{{ $id }}</td>
                                    </tr>
                                    <tr>
                                        <td>Заказчик</td>
                                        <td>{{ $data[0]->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Телефон</td>
                                        <td>{{ $data[0]->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Дата заказа</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data[0]->created_at)->format('d.m.Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Дата изменения</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data[0]->updated_at)->format('d.m.Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Кол-во позиций в заказе</td>
                                        <td>{{ $qtys }}</td>
                                    </tr>
                                    <tr>
                                        <td>Валюта</td>
                                        <td>{{ $data[0]->code }}</td>
                                    </tr>
                                    <tr>
                                        <td>Товары в заказе</td>
                                        <td>
                                            <select id="products" data-placeholder="" class="form-group select2 "
                                                multiple="multiple" style="width: 100%;">
                                                @foreach ($data as $k => $v)
                                                <option selected>{{ $v->title }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Сумма заказа</td>
                                        <td>{{ $data[0]->symbol_left }}{{ $sum }}{{ $data[0]->symbol_right }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Статус</td>
                                        <td>
                                            @if ($data[0]->status)
                                            <span class="text-success">Завершен</span>
                                            @else
                                            <span class="text-danger">Новый</span>
                                            @endif
                                            <span class=" btn-danger btn-sm " id="order_status" data-id={{ $id }}
                                                style="margin-left: 20px; cursor:pointer;">Change status</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Комментарий</td>
                                        <td>{{ $data[0]->note }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <h3>Детали заказа</h3>
                <div class="box">
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Наименование</th>
                                        <th>Цена ({{ $data[0]->code }})</th>
                                        <th>Кол-во</th>
                                        <th>Сумма ({{ $data[0]->code }})</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $product)
                                    <tr>
                                        <td>{{ $product->product_id }}</td>
                                        <td><a
                                                href="{{ route('products.edit', ['product' => $product->product_id]) }}">{{ $product->title }}</a>
                                        </td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->qty }}</td>
                                        <td>{{ $product->price * $product->qty }}</td>
                                    </tr>
                                    @endforeach
                                    <tr class="active">
                                        <td colspan="3"><b>Итого:</b></td>
                                        <td><b>{{ $qtys }}</b></td>
                                        <td><b>{{ $sum }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
