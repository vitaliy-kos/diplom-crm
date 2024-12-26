@extends('layouts.login')

@section('content')
<section class="login-content">
    <div class="container h-100">
        <div class="row align-items-center justify-content-center h-100">
            <div class="col-md-5">
                <div class="card p-3">
                    <div class="card-body">
{{--                        <div class="auth-logo">--}}
{{--                            <img src="{{ asset('/assets/images/develop-black.svg') }}"--}}
{{--                                 class="img-fluid rounded-normal sidebar-light-img" alt="logo">--}}
{{--                        </div>--}}
                        <h3 class="mb-3 font-weight-bold text-center">Вход в систему</h3>
                        <p class="text-center text-secondary mb-4">Нобходимо авторизоваться, чтобы продолжить</p>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-secondary">Логин</label>
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Введите логин" autocomplete="email" required autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-2">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label class="text-secondary">Пароль</label>
                                        </div>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                               placeholder="Введите пароль" autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-12 mt-2">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Запомнить меня') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-4">Авторизоваться</button>

{{--                            @if (Route::has('password.request'))--}}
{{--                                <div class="col-lg-12 mt-2 text-center">--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Забыли пароль?') }}</a>--}}
{{--                                </div>--}}
{{--                            @endif--}}

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
