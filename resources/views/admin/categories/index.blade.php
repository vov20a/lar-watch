@extends('admin.layouts.layout')
@section('title','AdminLTE|Categories')
@section('content')
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
                        <h1 class="m-0 text-dark">Список категорий</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
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
                        <a href="{{ route('categories.create') }}" class="btn btn-primary mb3">Добавить
                            категорию</a>
                    </div>
                    <div class="box-body">
                        @if (count($categories))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">#</th>
                                        <th>Наименование</th>
                                        <th>Parent</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('admin.layouts.partials.tab_menu')
                                    {{-- </div> --}}
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="box-header with-border">
                            <h3 class="box-title">Категорий пока нет...</h3>
                        </div>
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
