@extends('admin.layouts.layout')
@section('title','AdminLTE|Users')
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
                        <h1 class="m-0 text-dark">Список пользователей</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                        <a href="{{ route('users.create') }}" class="btn btn-primary mb3">Добавить
                            пользователя</a>
                    </div>
                    <div class="box-body">
                        @if (count($users))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Роль</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->is_admin)
                                            admin
                                            @else
                                            user
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                                class="btn btn-info btn-sm" style="float: left; margin-right:3px;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('users.destroy', ['user' => $user->id]) }}"
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
                            <h3 class="box-title">Пользователей пока нет...</h3>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix">
            {{ $users->links() }}
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
