@extends('admin.layouts.layout')
@section('title','AdminLTE|Orders')
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
                        <h1 class="m-0 text-dark">Список заказов</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Orders</li>
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
                        <a href="{{ route('orders.create') }}" class="btn btn-primary mb3">Добавить
                            заказ</a>
                    </div>
                    <div class="box-body">
                        @if (count($orders))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">#</th>
                                        <th>Заказчик</th>
                                        <th>Телефон</th>
                                        <th>Status</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Note</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>
                                            @if (!$order->status)
                                            <span class="btn-danger" style="padding: 0 5px;">В работе</span>
                                            @else
                                            <span class="btn-success" style="padding: 0 5px;">Выполнен</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- {{ $order->created_at }} --}}
                                            {{ Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d.m.Y') }}
                                            {{-- {{ $order->getOrderCreate() }} --}}
                                        </td>
                                        <td>
                                            {{-- {{ $order->updated_at }} --}}
                                            {{ Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('d.m.Y') }}
                                            {{-- {{ $order->getOrderUpdate() }} --}}
                                        </td>
                                        <td>{{ $order->note }}</td>
                                        <td>
                                            <a href="{{ route('orders.show', ['order' => $order->id]) }}"
                                                class="btn btn-info btn-sm" style="float: left; margin-right:3px;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('orders.destroy', ['order' => $order->id]) }}"
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
                            <h3 class="box-title">Заказов пока нет...</h3>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix">
            {{ $orders->links() }}
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
