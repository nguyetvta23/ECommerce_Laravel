@extends('Auth.layouts.master')
@section('title')
    SO SÁNH
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
                                <h1 class="breadcrumb-title">SO SÁNH SẢN PHẨM</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">TRANG CHỦ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">SO SÁNH</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- compare main wrapper start -->
        <div class="compare-page-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Compare Page Content Start -->
                        <div class="compare-page-content-wrap">
                            <div class="compare-table table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                    <tr>
                                        <td class="first-column">SẢN PHẨM</td>
                                        <td class="product-image-title">
                                            <a href="product-details.html" class="image">
                                                <img class="img-fluid" src="{{URL::asset('Auth/img/product/product-1.jpg')}}" alt="Compare Product">
                                            </a>
                                            <a href="#" class="category">Silver</a>
                                            <a href="product-details.html" class="title">Endeavor Daytrip</a>
                                        </td>
                                        <td class="product-image-title">
                                            <a href="product-details.html" class="image">
                                                <img class="img-fluid" src="{{URL::asset('Auth/img/product/product-2.jpg')}}" alt="Compare Product">
                                            </a>
                                            <a href="#" class="category">Gold</a>
                                            <a href="product-details.html" class="title">Compete Track Totes</a>
                                        </td>
                                        <td class="product-image-title">
                                            <a href="product-details.html" class="image">
                                                <img class="img-fluid" src="{{URL::asset('Auth/img/product/product-3.jpg')}}" alt="Compare Product">
                                            </a>
                                            <a href="#" class="category">Ring</a>
                                            <a href="product-details.html" class="title">Bess Yoga Shorts</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">MÔ TẢ</td>
                                        <td class="pro-desc">
                                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident nulla, explicabo iste a rerum pariatur.</p>
                                        </td>
                                        <td class="pro-desc">
                                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sit commodi obcaecati cumque consectetur alias incidunt?</p>
                                        </td>
                                        <td class="pro-desc">
                                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eius, facere. Fuga asperiores inventore iste tempora.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">GIÁ</td>
                                        <td class="pro-price">600.000 vnđ</td>
                                        <td class="pro-price">600.000 vnđ</td>
                                        <td class="pro-price">600.000 vnđ</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">MÀU</td>
                                        <td class="pro-color">Xanh</td>
                                        <td class="pro-color">Đỏ</td>
                                        <td class="pro-color">Trắng</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">TÌNH TRẠNG</td>
                                        <td class="pro-stock">Còn hàng</td>
                                        <td class="pro-stock">Hết hàng</td>
                                        <td class="pro-stock">Hết hàng</td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">Thêm sản phẩm</td>
                                        <td><a href="cart.html" class="btn">Thêm vào giỏ hàng</a></td>
                                        <td><a href="cart.html" class="btn disabled">Thêm vào giỏ hàng</a></td>
                                        <td><a href="cart.html" class="btn">Thêm vào giỏ hàng</a></td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">ĐÁNH GIÁ</td>
                                        <td class="pro-ratting">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </td>
                                        <td class="pro-ratting">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </td>
                                        <td class="pro-ratting">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-o"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="first-column">XÓA </td>
                                        <td class="pro-remove">
                                            <button><i class="fa fa-trash-o"></i></button>
                                        </td>
                                        <td class="pro-remove">
                                            <button><i class="fa fa-trash-o"></i></button>
                                        </td>
                                        <td class="pro-remove">
                                            <button><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Compare Page Content End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- compare main wrapper end -->
    </main>

@endsection