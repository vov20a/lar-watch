@extends('layouts.layout')
@section('title', 'Регистрация')
@section('content')

    <!-- login -->
    <div class="container register-form">
        <div class="row">
            <div class="col-md-4 text-center col-md-offset-4">
                <h3>Регистрация</h3>
                <form action="{{ route('register.store') }}" method="post" data-toggle="validator">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type=" text" name="name" class="form-control @error('name')  is-invalid @enderror"
                            placeholder=" Name" value="{{ old('name') }}" required>
                        <div class="help-block with-errors"></div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        @error('name')
                            <div class="alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group has-feedback">
                        <input type="email" name="email" class="form-control @error('email')  is-invalid @enderror"
                            placeholder=" Email" value="{{ old('email') }}" required>
                        <div class="help-block with-errors"></div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        @error('email')
                            <div class="alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control @error('password')  is-invalid @enderror"
                            placeholder="Password" required>
                        <div class="help-block with-errors"></div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        @error('password')
                            <div class="alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password_confirmation"
                            class="form-control  @error('password_confirmation')  is-invalid @enderror"
                            placeholder="Retype password" required>
                        <div class="help-block with-errors"></div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        @error('password_confirmation')
                            <div class="alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                </form>
                <a href="{{ route('login.create') }}" class="text-center">I already have a membership</a>
            </div>
        </div>
    </div>
    <!-- //login -->

@endsection
