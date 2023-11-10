@extends('Auth.layouts.master')

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
                                <h1 class="breadcrumb-title">Quên mật khẩu</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Quên mật khẩu</li>
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
                        <div class="col-lg-6 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                
                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email: ') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                
                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Gửi') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Register Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- login register wrapper end -->
    </main>

@endsection
