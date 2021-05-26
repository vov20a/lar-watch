@extends('admin.layouts.layout')
@section('title','AdminLTE|Products')
@section('content')
@php
use Carbon\Carbon;
@endphp
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('admin.layouts.errors')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class=" container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Список товаров</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
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
                    <div style="margin-bottom: 10px;">
                        <a href="{{ route('products.create') }}" class="btn btn-primary mb3">Добавить
                            товар</a>
                    </div>
                    <div class="box-body">
                        @if (count($products))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">#</th>
                                        <th>Название</th>
                                        <th>Категория</th>
                                        <th>Цена</th>
                                        <th>Статус</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->category->title }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td>
                                            {{ Carbon::createFromFormat('Y-m-d H:i:s', $product->created_at)->format('d.m.Y / H:i') }}
                                        </td>
                                        <td>
                                            {{ Carbon::createFromFormat('Y-m-d H:i:s', $product->updated_at)->format('d.m.Y / H:i') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                                class="btn btn-info btn-sm" style="float: left; margin-right:3px;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                                method="post" class="float-left">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Подтвердите удаление')">
                                                    <i class="fas fa-cut"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @else
                        <div class="box-header with-border">
                            <h3 class="box-title">Товаров пока нет...</h3>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix">
            {{ $products->links() }}
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
