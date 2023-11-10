@extends('Auth.layouts.master')
@section('title')
    Đăng ký
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
                                    <h1 class="breadcrumb-title">Đăng ký</h1>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Đăng ký</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <!-- breadcrumb area end -->
            <!-- login register wrapper start -->
            <div class="login-register-wrapper section-padding">
                <div class="container">
                    <div class="member-area-from-wrap">
                        <div class="row">
                            <!-- Register Content Start -->
                            <div class="col-lg-10 mx-auto">
                                <div class="login-reg-form-wrap signup-form">
                                    <h2>Đăng ký</h2>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="single-input-item row">                                            
                                            <label class="col-sm-2  col-form-label " for="">{{ __('Họ và tên') }}</label>
                                            <div class="col-sm-10">
                                                <input class="col-sm-12" id="name" type="text" name="name" value="{{ old('name') }}" 
                                                autocomplete="name" autofocus placeholder="Họ và tên" />
                                                @if ($errors->has('name'))
                                                    <span style="font-size: 12px;" role="alert" class="text-danger">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            
                                        </div>
                                        <div class="single-input-item row">
                                            <label class="col-sm-2 col-form-label" for="">{{ __('Email') }}</label>
                                            <div class="col-sm-10">
                                                <input id="email" class="col-sm-12" name="email" value="{{ old('email') }}" autocomplete="email"" type="text" placeholder="Email" />
                                                @if ($errors->has('email'))
                                                    <span style="font-size: 12px;" role="alert" class="text-danger">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="single-input-item row">
                                            <label class="col-sm-2 col-form-label"  for="">{{ __('Mật khẩu') }}</label>
                                            <div class="col-sm-10">
                                                <input id="password" class="col-sm-12 @error('password') is-invalid @enderror" name="password" autocomplete="new-password"" type="password" placeholder="Mật khẩu" />
                                                @if ($errors->has('password'))
                                                    <span style="font-size: 12px;" role="alert" class="text-danger">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="single-input-item row">
                                            <label class="col-sm-2 col-form-label" for="">{{ __('Xác nhận MK') }}</label>
                                            <div class="col-sm-10">
                                                <input id="password-confirm" class="col-sm-12" type="password" name="password_confirmation" autocomplete="new-password" placeholder="Mật khẩu"/>
                                                @if ($errors->has('password'))
                                                    <span style="font-size: 12px;" role="alert" class="text-danger">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="single-input-item">
                                            <div class="login-reg-form-meta">
                                                <div class="remember-meta">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="subnewsletter">
                                                        <label class="custom-control-label" for="subnewsletter">Tôi đã đọc và đồng ý với <a class="text-danger" href="{{route('quydinh')}}"><b>Quy định và hình thức thanh toán</b></a></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                            <div class="single-input-item">
                                                <button type="submit" class="btn">Đăng ký</button>
                                            </div>
                                            <p>Đã có tài khoản? <a href="{{route('login')}}" class="forget-pwd">Đăng nhập</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- Register Content End -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- login register wrapper end -->
        </main>
        <!-- main wrapper end -->
    {{-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div style="background-color: rgba(0,0,0,0.5) !important;" class="card">
                    <div class="card-header bg-warning">{{ __('Đăng ký') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-light text-md-end">{{ __('Họ và tên') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="text-light col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="text-light col-md-4 col-form-label text-md-end">{{ __('Mật khẩu') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class=" text-light col-md-4 col-form-label text-md-end">{{ __('Xác nhận mật khẩu') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-warning">
                                        {{ __('Đăng ký') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
{{-- @extends('app')
@section('content')
<main class="signup-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Đăng ký tài khoản</h3>
                    <div class="card-body">
                        <form action="{{ route('register.custom') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                                    required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email_address" class="form-control"
                                    name="email" required autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control"
                                    name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <div class="checkbox">
                                    <label><input type="checkbox" name="remember"> Ghi nhớ tài khoản?</label>
                                </div>
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block"> Đăng ký</button></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection --}}