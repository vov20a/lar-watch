@extends('layouts.layout')
@section('title', 'Восстановление пароля')
@section('content')
    <!-- login -->
    <div class="container">
        <div class="row text-center col-md-offset-3">
            <div class="col-md-6 module form-module " id="auth">
                <h3>Новый пароль</h3>
                <form action="{{ route('create.password') }}" method="post" data-toggle="validator">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control @error('password')  is-invalid @enderror"
                            placeholder="Введите новый пароль" required>
                        <div class="help-block with-errors"></div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        @error('password')
                            <div class="alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password_confirmation"
                            class="form-control  @error('password_confirmation')  is-invalid @enderror"
                            placeholder="Подтвердите пароль" required>
                        <div class="help-block with-errors"></div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        @error('password_confirmation')
                            <div class="alert-danger invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="hash" value="{{ $hash }}">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- //login -->
@endsection
