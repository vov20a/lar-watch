@extends('layouts.layout')
@section('title', 'Авторизация')
@section('content')

    <!-- login -->
    <div class="container login-form">
        <div class="row">
            <div class="col-md-4 text-center col-md-offset-4">
                <div class="module form-module " id="auth">
                    <h3>Авторизация</h3>
                    <form action="{{ route('login') }}" method="post" data-toggle="validator">
                        @csrf
                        <div class="form-group has-feedback">
                            <input type=" email" name="email" class="form-control @error('email')  is-invalid @enderror"
                                placeholder="Email" value="{{ old('email') }}" required>
                            <div class="help-block with-errors"></div>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            @error('email')
                                <div class="alert-danger invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group has-feedback">
                            <input type="password" name="password"
                                class="form-control @error('password')  is-invalid @enderror" placeholder="Password"
                                required>
                            <div class="help-block with-errors"></div>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            @error('password')
                                <div class="alert-danger invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                        </div>
                    </form>

                    <div class="form-group">
                        <button class="btn-block btn-flat"><a id="auth-link" href="#">I forgot my
                                password</a></button>
                        <button class="btn-block btn-flat"><a href="{{ route('register.create') }}">Register a new
                                membership</a></button>
                    </div>
                </div>
                <div class="module form-module " id="forgot">
                    <h3>Восстановление пароля</h3>
                    <form action="{{ route('forgot') }}" method="post" data-toggle="validator">
                        @csrf
                        <div class="form-group has-feedback">
                            <input type=" email" name="email" class="form-control @error('email')  is-invalid @enderror"
                                placeholder="Email" value="{{ old('email') }}" required>
                            <div class="help-block with-errors"></div>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            @error('email')
                                <div class="alert-danger invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Восстановить пароль</button>
                        </div>
                    </form>

                    <div class="form-group">
                        <button class="btn-block btn-flat"><a id="forgot-link" href="#">Return to
                                login</a></button>
                        <button class="btn-block btn-flat"><a href="{{ route('register.create') }}">Register a new
                                membership</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //login -->
@endsection
