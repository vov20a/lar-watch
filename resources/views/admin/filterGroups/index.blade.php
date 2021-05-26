@extends('admin.layouts.layout')
@section('title','AdminLTE|FilterGroups')
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
                        <h1 class="m-0 text-dark">Список групп фильтров</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                            <li class="breadcrumb-item active">GroupFilters</li>
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
                        <a href="{{ route('filter-groups.create') }}" class="btn btn-primary mb3">Добавить
                            группу</a>
                    </div>
                    <div class="box-body">
                        @if (count($groups))
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">#</th>
                                        <th>Наименование</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groups as $item)
                                    <tr>
                                        <td style="width: 30px">{{ $item->id }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>
                                            <a href="{{ route('filter-groups.edit', ['filter_group' => $item->id]) }}"
                                                class="btn btn-info btn-sm" style="float: left; margin-right:3px;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form
                                                action="{{ route('filter-groups.destroy', ['filter_group' => $item->id]) }}"
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
                            <h3 class="box-title">Фильтров пока нет...</h3>
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix">
            {{ $groups->links() }}
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
