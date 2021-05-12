@extends('admin.layouts.layout')
@section('title', 'AdminLTE|Orders')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Добавить заказ</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a>
                                </li>
                                <li class="breadcrumb-item active">Добавить</li>
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
                            <form action="{{ route('orders.store') }}" method="POST" class="needs-validation" novalidate>
                                @csrf
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="user_id">Имя заказчика</label>
                                        <select class="form-control  @error('user_id')  is-invalid @enderror" name="user_id"
                                            id="user_id" required>
                                            @foreach ($users as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                            <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Телефон</label>
                                        <input type="tel" name='phone'
                                            class="form-control @error('phone')  is-invalid @enderror" id="quantity"
                                            placeholder="Телефон" pattern="^[0-9-]+$" value="{{ old('phone') }}" required>
                                        <div class="invalid-feedback">Please enter a valid title.</div>
                                        @error('phone')
                                            <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="products">Товары</label>
                                        <select name="products[]" id="products"
                                            class="form-control select2  @error('user_id')  is-invalid @enderror"
                                            multiple="multiple" data-placeholder="Выбор товаров" style="width: 100%;"
                                            required>
                                            @foreach ($products as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Please click here and select from these products.
                                        </div>
                                        @error('user_id')
                                            <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group  has-feedback">
                                        <label for="quantity">Кол-во для каждого товара,шт.</label>
                                        <input type="text" name='quantity'
                                            class="form-control @error('quantity')  is-invalid @enderror" id="quantity"
                                            placeholder="Количество для каждого товара" pattern="^[0-9]{1,}$" required>
                                        <div class="invalid-feedback">Please enter a number for products.</div>
                                        @error('quantity')
                                            <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="currency">Валюта</label>
                                        <select class="form-control  @error('currency')  is-invalid @enderror"
                                            name="currency" id="currency" required>
                                            @foreach ($currencies as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                        @error('currency')
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
                                    <button type="submit" class="btn btn-success">Добавить</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
