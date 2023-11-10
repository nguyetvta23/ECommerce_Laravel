@extends('Auth.layouts.master')
@section('title')
    Danh sách yêu thích
@endsection
@section('content')
<main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area bg-img" data-bg="{{URL::asset('Auth/img/banner/breadcrumb-banner.jpg')}}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap text-center">
                            <nav aria-label="breadcrumb">
                                <h1 class="breadcrumb-title"> danh sách YÊU THÍCH</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Yêu thích</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- wishlist main wrapper start -->
        <div class="wishlist-main-wrapper section-padding">
            <div class="container custom-container">
                <!-- Wishlist Page Content Start -->
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Wishlist Table Area -->
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="pro-thumbnail">Hình ảnh</th>
                                    <th class="pro-title">Sản phẩm</th>
                                    <th class="pro-price">Giá</th>
                                    <th class="pro-quantity">Trạng thái</th>
                                    <th class="pro-subtotal">Thêm vào giỏ hàng</th>
                                    <th class="pro-remove">Xóa</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="{{URL::asset('Auth/img/product/product-5.jpg')}}"
                                                                                alt="Product"/></a></td>
                                    <td class="pro-title"><a href="#">element snowboard</a></td>
                                    <td class="pro-price"><span>$295.00</span></td>
                                    <td class="pro-quantity"><span class="text-success">Còn hàng</span></td>
                                    <td class="pro-subtotal"><a href="cart.html" class="sqr-btn text-black">Mua ngay</a></td>
                                    <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td class="pro-thumbnail"><a href="#"><img class="img-fluid" src="{{URL::asset('Auth/img/product/product-6.jpg')}}"
                                                                                alt="Product"/></a></td>
                                    <td class="pro-title"><a href="#">raygun snowboard</a></td>
                                    <td class="pro-price"><span>$275.00</span></td>
                                    <td class="pro-quantity"><span class="text-success">Còn hàng</span></td>
                                    <td class="pro-subtotal"><a href="cart.html" class="sqr-btn text-black">Mua ngay</a></td>
                                    <td class="pro-remove"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Wishlist Page Content End -->
            </div>
        </div>
        <!-- wishlist main wrapper end -->
    </main>
@endsection