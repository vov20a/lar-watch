@extends('admin.layouts.layout')
@section('title', 'AdminLTE|Products')
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
                            <h1 class="m-0 text-dark">Добавить товар</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a>
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
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data"
                            class="needs-validation" novalidate>
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title">Наименование товара</label>
                                    <input type="text" name='title'
                                        class="form-control @error('title')  is-invalid @enderror" id="title"
                                        placeholder="Наименование товара" value="{{ old('title') }}" required>
                                    <div class="invalid-feedback">Please enter a valid title.</div>
                                    @error('title')
                                        <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Категория товара</label>
                                    <div class="list-group list-group-root well">
                                        @include('admin.layouts.partials.select_product')
                                    </div>
                                    {{-- @error('category_id')
                                <div class="alert-danger invalid-feedback">{{ $message }}
                            </div>
                            @enderror --}}
                                </div>

                                <div class="form-group">
                                    <label for="price">Цена</label>
                                    <input type="text" name='price'
                                        class="form-control @error('price')  is-invalid @enderror" id="price"
                                        placeholder="Цена" pattern="^[0-9.]+$" required>
                                    <div class="invalid-feedback">Please enter float.</div>
                                    @error('price')
                                        <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="status">
                                        <input type="checkbox" name="status" id="status" checked>Статус</label>
                                </div>

                                <div class="form-group ">
                                    <label for="content">Контент</label>
                                    <textarea name="content" class="form-control @error('content') is-invalid @enderror"
                                        id="content" rows="7">{{ old('content') }}</textarea>
                                    @error('content')
                                        <div class="alert-danger invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="related_products">Связанные товары</label>
                                    <select name="related_products[]" id="related_products"
                                        class="form-control select2  @error('related_products')  is-invalid @enderror"
                                        multiple="multiple" data-placeholder="Выбор связанных товаров" style="width: 100%;"
                                        required>
                                        @foreach ($all_products as $k => $v)
                                            <option value="{{ $v->id }}">{{ $v->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please click here and select from these products.
                                    </div>
                                </div>
                                <div class="form-group box box-body box-solid file-upload">
                                    <label for="img">Изображение</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="img" name="img" class="form-control">
                                            <label class="custom-file-label" for="img">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    @include('admin.layouts.partials.admin_filter'/*, ['filter' => 222]*/)
                                </div>
                                <div class="form-group box box-body box-solid file-upload">
                                    <label for="img">Изображения галереи</label>
                                    @for ($i = 0; $i < 3; $i++)
                                        <div class="input-group" style="display: block">
                                            <div class="custom-file">
                                                <input type="file" id="preview{{ $i }}"
                                                    name="preview{{ $i }}" class="form-control">
                                                <label class="custom-file-label" for="preview{{ $i }}">Choose
                                                    galery{{ $i }}</label>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>

                            <div class="box-footer">
                                <button id="btn_product" type="submit" class="btn btn-success">Добавить</button>
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
