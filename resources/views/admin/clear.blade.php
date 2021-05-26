@extends('admin.layouts.layout')
@section('title', 'AdminLTE|Cleaning')
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
                            <h1 class="m-0 text-dark">Cleaning</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item active">Cleaning</li>
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
                                <table class="table table-bordered table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Наименование</th>
                                            <th>Описание</th>
                                            <th>Очистка</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Cookie filter</td>
                                            <td>Срок действия 1 неделя</td>
                                            <td>
                                                <form action="{{ route('clear') }}" method="post" class="float-left">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" name='filter'
                                                        value="filter" onclick="return confirm('Подтвердите очистку')">
                                                        <i class="fas fa-cut"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cookie currency</td>
                                            <td>Срок действия 1 неделя</td>
                                            <td>
                                                <form action="{{ route('clear') }}" method="post" class="float-left">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" name='currency'
                                                        value="currency" onclick="return confirm('Подтвердите очистку')">
                                                        <i class="fas fa-cut"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cookie recentlyViewed</td>
                                            <td>Срок действия 1 неделя</td>
                                            <td>
                                                <form action="{{ route('clear') }}" method="post" class="float-left">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        name='recentlyViewed' value="recentlyViewed"
                                                        onclick="return confirm('Подтвердите очистку')">
                                                        <i class="fas fa-cut"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Cache menu</td>
                                            <td>Срок действия 1 неделя</td>
                                            <td>
                                                <form action="{{ route('clear') }}" method="post" class="float-left">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" name='menu'
                                                        value="menu" onclick="return confirm('Подтвердите очистку')">
                                                        <i class="fas fa-cut"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
