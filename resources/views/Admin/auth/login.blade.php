@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href=" {{ asset('admin/assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}" type="text/css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/assets/dist/css/adminlte.min.css')}}" type="text/css">


@endpush
@section('content')
    <body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>Kingdom Sneakers</b> Admin</a>
        </div>
        @if(Session::has('error'))
        <div class="alert alert-success" style="margin-top: 10px;">
            {!! Session::get('error') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!-- /.login-logo -->
        <div class="card col-md-12">
            <div class="card-body login-card-body">
            <p class="login-box-msg">Đăng nhập</p>
        
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Email/Tên đăng nhập">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                @error('email')
                    <span class="invalid-feedback input-group-text mb-2" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password"  placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('password')
                    <span class="invalid-feedback input-group-text mb-2" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="row">
                <div class="col-6">
                    <div class="icheck-primary">
                    <input type="checkbox" name="r"id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">
                        Ghi nhớ
                    </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <a href=""> <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button></a>
                </div>
                <!-- /.col -->
                </div>
            </form>
        
            {{-- <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                </a>
                <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div> --}}
            <!-- /.social-auth-links -->
            @if (Route::has('password.request'))
                <p class="mb-1">
                    <a href="{{ route('password.request') }}">Quên mật khẩu</a>
                </p>
            @endif
            
            <p class="mb-0">
                <a href="register.html" class="text-center">Đăng ký</a>
            </p>
            </div>
            <!-- /.login-card-body -->
        </div>
        </div>
        <!-- /.login-box -->
        
        <!-- jQuery -->
        <script src="{{asset('admin/assets/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('admin/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- AdminLTE App -->
        <script src="../../dist/js/adminlte.min.js"></script>
        <script src="{{asset('admin/assets/dist/js/adminlte.min.js')}}"></script>
    </body>
@endsection