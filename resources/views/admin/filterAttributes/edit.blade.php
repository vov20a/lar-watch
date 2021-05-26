@extends('admin.layouts.layout')
@section('title', 'AdminLTE|FilterAttributes')
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
                            <h1 class="m-0 text-dark">Редактирование атрибута фильтра</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('filter-groups.index') }}">Filter's
                                        Attributes</a>
                                </li>
                                <li class="breadcrumb-item active">{{ $attr->value }}</li>
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
                        <form action="{{ route('filter-attributes.update', ['filter_attribute' => $attr->id]) }}"
                            method="POST" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="value">Наименование атрибута</label>
                                    <input type="text" name='value'
                                        class="form-control @error('tivaluetle')  is-invalid @enderror" id="value"
                                        value="{{ $attr->value }}" required>
                                    <div class="invalid-feedback">Please enter a valid title.</div>
                                    @error('value')
                                        <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="attribute_group_id">Атрибуты</label>
                                    <select class="form-control  @error('attribute_group_id')  is-invalid @enderror"
                                        name="attribute_group_id" id="attribute_group_id" required>
                                        @foreach ($groups as $k => $v)
                                            <option value="{{ $k }}" @php
                                                if ($k == $attr->attribute_group_id) {
                                                    echo ' selected';
                                                }
                                            @endphp>{{ $v }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('attribute_group_id')
                                        <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-success">Сохранить</button>
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
