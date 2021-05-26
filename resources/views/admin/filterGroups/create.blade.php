@extends('admin.layouts.layout')
@section('title', 'AdminLTE|FilterGroups')
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
                            <h1 class="m-0 text-dark">Добавить группу фильтра</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('filter-groups.index') }}">FilterGroups</a>
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
                        <form action="{{ route('filter-groups.store') }}" method="POST" class="needs-validation"
                            novalidate>
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    {{-- <label for="title">Наименование валюты</label> --}}
                                    <label for="title">Название группы</label>
                                    <input type="text" name="title"
                                        class="form-control  @error('title') is-invalid @enderror" id="title"
                                        placeholder="Вставте название группы" required>
                                    <div class="invalid-feedback">Please enter a valid title.</div>
                                    @error('title')
                                        <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">Добавить</button>
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
