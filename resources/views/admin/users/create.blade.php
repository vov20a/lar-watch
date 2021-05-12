@extends('admin.layouts.layout')
@section('title','AdminLTE|Users')
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
                        <h1 class="m-0 text-dark">Добавить пользователя</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Users</a>
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
                        <form action="{{ route('users.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <div class="form-group">
                                <label for="name">Имя пользователя</label>
                                <input type="text" name='name' class="form-control @error('name')  is-invalid @enderror"
                                    id="name" placeholder="Имя пользователя" value="{{ old("name") }}" required>
                                <div class="invalid-feedback">Please enter a valid name.</div>
                                @error('name')
                                <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name='email'
                                    class="form-control @error('email')  is-invalid @enderror" id="email"
                                    placeholder="Email пользователя" value="{{ old("email") }}" required>
                                <div class="invalid-feedback">Please enter a valid email.</div>
                                @error('email')
                                <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name='password'
                                    class="form-control @error('password')  is-invalid @enderror" id="password"
                                    placeholder="Password" required>
                                <div class="invalid-feedback">Please enter a password.</div>
                                @error('password')
                                <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="is_admin">Роль</label>
                                <select name="is_admin" class="form-control @error('is_admin')  is-invalid @enderror">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                                @error('is_admin')
                                <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                @enderror
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
