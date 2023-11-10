@extends('Auth.layouts.master')
@section('title')
    Đăng nhập
@endsection
@section('content')
<!-- main wrapper start -->
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area bg-img" data-bg="assets/img/banner/breadcrumb-banner.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap text-center">
                        <nav aria-label="breadcrumb">
                            <h1 class="breadcrumb-title">Đăng nhập</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->
    @if(Session::has('error'))
    <div class="alert alert-success" style="margin-top: 10px;">
        {!! Session::get('error') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-padding">
        <div class="container">
            <div class="member-area-from-wrap">
                <div class="row">
                    <!-- Login Content Start -->
                    <div class="col-lg-10 mx-auto">
                        <div class="login-reg-form-wrap">
                            <h2>Đăng nhập</h2>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="single-input-item">
                                    <label for="">{{ __('Email     ') }}</label>
                                    <input class="@error('email') is-invalid @enderror" id="email" type="emai" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Email/Tên đăng nhập"/>
                                    @error('email')
                                        <span class="invalid-feedback input-group-text" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="single-input-item">
                                    <label for="">{{__('Mật khẩu ')}}</label>
                                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" autocomplete="current-password" /><i onclick="showPass()" style="margin-left: -30px; 
                                    cursor: pointer;" class="fa fa-eye"></i>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="single-input-item">
                                    <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                        <div class="remember-meta">
                                            <div class="custom-control">
                                                <input style="width: 20px" class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="rememberMe">{{ __('Ghi nhớ tài khoản!') }}</label>
                                            </div>
                                        </div>
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}" class="forget-pwd">Quên mật khẩu</a>
                                        @endif
                                        
                                    </div>
                                </div>
                                <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                    <div class="single-input-item">
                                        <button type="submit" class="btn">  {{ __('Đăng nhập') }}</button>
                                    </div>
                                    <p>Chưa có tài khoản? <a href="{{route('register')}}" class="forget-pwd">Đăng ký</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Login Content End -->
                    </div>
            </div>
        </div>
    </div>
    <!-- login register wrapper end -->
</main>
@push('scripts')
<script>
    function showPass() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    }
</script>
@endpush
<!-- main wrapper end -->
{{-- <div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="col-md-6 mt-5">
            <div style="background-color: rgba(0,0,0,0.5) !important;" class="card">
                <div class="card-header bg-warning">{{ __('Đăng nhập') }}</div>

                <div class="card-body">
                    <form  method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 input-group form-group">
                            <label for="email" class="col-md-4 col-form-label text-light text-md-end">{{ __('Email     ') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control input-group-prepend @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback input-group-text" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 input-group form-group">
                            <label for="password" class="text-light col-md-4 col-form-label text-md-end">{{ __('Mật khẩu') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label text-light" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-warning mx-auto">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="text-light btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('Quên mật khẩu') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="text-center text-light">
                        <p>Chưa có tài khoản? <a class="text-decoration-none" href="{{ route('register') }}">Đăng ký</a></p>
                        <p>hoặc</p>
                        <a class="btn btn-primary btn-lg btn-block" style="background-color: #3b5998" href="#!"
                        role="button">
                        <i class="bi bi-facebook"></i> Continue with Facebook</a>
                        <a class="btn btn-primary btn-lg btn-block" style="background-color: #55acee" href="#!"
                        role="button">
                        <i class="bi bi-google"></i> Continue with Google</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
{{-- @extends('layouts.app')
@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Đăng nhập</h3>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
                                    autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Ghi nhớ tài khoản?
                                    </label>
                                </div>
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Đăng nhập</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection --}}