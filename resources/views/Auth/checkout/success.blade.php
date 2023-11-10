@extends('Auth.layouts.master')
@section('title')
Thanh toán
@endsection
@section('content')
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area bg-img" data-bg="assets/img/banner/breadcrumb-banner.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap text-center">
                        <nav aria-label="breadcrumb">
                        <h1 class="breadcrumb-title text-success">{{isset($message) ? $message : "Đơn hàng đã được đặt thành công!"}}</h1>
                        <h2 class="breadcrumb-title text-success">Cảm ơn bạn đã đặt hàng tại Kingdom Sneakers!</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Nhấn vào đây để tiếp tục mua hàng</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- checkout main wrapper start -->
    
    <!-- checkout main wrapper end -->
</main>
@endsection