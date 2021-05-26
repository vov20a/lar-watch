@extends('admin.layouts.layout')
@section('title','AdminLTE|Currencies')
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
                        <h1 class="m-0 text-dark">Редактирование валюты</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('currencies.index') }}">Currencies</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $currency->title }}</li>
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
                    <form action="{{ route('currencies.update',['currency'=>$currency->id]) }}" method="POST"
                        class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                {{-- <label for="title">Наименование валюты</label> --}}
                                <label for="title">Название</label>
                                <input type="text" name="title"
                                    class="form-control  @error('title') is-invalid @enderror" id="title"
                                    value="{{ $currency->title }}" required>
                                <div class="invalid-feedback">Please enter a valid title.</div>
                                @error('title')
                                <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="code">Код</label>
                                <input type="text" name='code' class="form-control @error('code')  is-invalid @enderror"
                                    id="code" value="{{ $currency->code }}" required>
                                <div class="invalid-feedback">Please enter a valid code.</div>
                                @error('code')
                                <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="base">Статус</label>
                                <input type="text" name='base' class="form-control @error('base')  is-invalid @enderror"
                                    id="base" value="{{ $currency->base }}" pattern="^[01]?$" required>
                                <div class="invalid-feedback">Please enter a valid status:0 or 1.</div>
                                @error('base')
                                <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="value">Курс</label>
                                <input type="text" name='value'
                                    class="form-control @error('value')  is-invalid @enderror" id="value"
                                    value="{{ $currency->value }}" pattern="^[0-9.]+$" required>
                                <div class="invalid-feedback">Допускаются только цифры и точка.</div>
                                @error('value')
                                <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="symbol_left">Symbol_left</label>
                                <input type="text" name='symbol_left'
                                    class="form-control @error('symbol_left')  is-invalid @enderror" id="symbol_left"
                                    value="{{ $currency->symbol_left }}">
                                @error('symbol_left')
                                <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group ">
                                <label for="symbol_right">Symbol_right</label>
                                <input type="text" name='symbol_right'
                                    class="form-control @error('symbol_right')  is-invalid @enderror" id="symbol_right"
                                    value="{{ $currency->symbol_right }}">
                                @error('symbol_right')
                                <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="box-footer">
                            <button id="btn_product" type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
