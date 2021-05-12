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
                            <h1 class="m-0 text-dark">Редактирование пользователя</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a>
                                </li>
                                <li class="breadcrumb-item active">{{ $user->name }}</li>
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
                            <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST"
                                class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="name">Имя пользователя</label>
                                    <input type="text" name='name' class="form-control @error('name')  is-invalid @enderror"
                                        id="name" value="{{ $user->name }}" required>
                                    <div class="invalid-feedback">Please enter a valid name.</div>
                                    @error('name')
                                        <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name='email'
                                        class="form-control @error('email')  is-invalid @enderror" id="email"
                                        value="{{ $user->email }}" required>
                                    <div class="invalid-feedback">Please enter a valid email.</div>
                                    @error('email')
                                        <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="is_admin">Роль</label>
                                    <select name="is_admin" class="form-control @error('ia_admin')  is-invalid @enderror">
                                        <option value="0" <?php if ($user->is_admin == 0) {
                                            echo ' selected="" ';
                                            } ?>> user</option>
                                        <option value="1" <?php if ($user->is_admin == 1) {
                                            echo ' selected="" ';
                                            } ?>>admin</option>
                                    </select>
                                    @error('is_admin')
                                        <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="box-footer" style="padding-bottom: 50px">
                                    <button id="btn_product" type="submit" class="btn btn-success">Сохранить</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h3 style="padding-bottom: 20px">Заказы пользователя</h3>
                    <div class="box">
                        <div class="box-body">
                            @if (count($user->orders))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Телефон</th>
                                                <th>Статус</th>
                                                <th>Дата создания</th>
                                                <th>Дата изменения</th>
                                                <th>Действия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->orders as $order)
                                                @php
                                                    $class = $order->status ? 'success' : '';
                                                @endphp
                                                <tr class="{{ $class }}">
                                                    <td>{{ $order->id }} </td>
                                                    <td>{{ $order->phone }} </td>
                                                    <td>
                                                        @if ($order->status) "Завершен"
                                                        @else "Новый" @endif
                                                    </td>
                                                    <td> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d.m.Y') }}
                                                    </td>
                                                    <td> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $order->updated_at)->format('d.m.Y') }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('orders.show', ['order' => $order->id]) }}"
                                                            class="btn btn-info btn-sm"
                                                            style="float: left; margin-right:3px;">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-danger">Пользователь ничего не заказывал</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
