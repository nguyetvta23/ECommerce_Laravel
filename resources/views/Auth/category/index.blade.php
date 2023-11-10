@extends('Auth.layouts.master')
@section('title')
Danh mục sản phẩm
@endsection
@push('cssAuth')
<style>
    .active-favourite {
        color: #fff !important;
        background-color: #e3a51e !important;
    }
</style>
@endpush
@push('scripts')
<script>
    //Sản phẩm yêu thích FE của Yến
    $(document).ready(function() {
        $('.ion-android-favorite-outline').click(function(event) {
            event.preventDefault();
            var idProduct = $(this).data('id');
            $("#product-favourite-" + idProduct).addClass("active-favourite");
            $.ajax({
                type: "post",
                url: "/product-favourite",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'idProduct': idProduct,
                },
                success: function(response) {
                    // console.log(response);
                    // toastr.success('',
                    //     'Chọn sản phẩm yêu thích thành công')
                    if (response.status == 200) {
                        toastr.success('',
                            response.message)
                    } else {
                        toastr.error('',
                            response.message)
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });
    });

    $('.cart-info').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "{{ url('api/cart') }}",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                renderCart();
                toastr.success('',
                    'Thêm giỏ hàng thành công')
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    $('.add-cart').click(function(e) {
        e.preventDefault();
        $(this).next('.cart-info').submit();
    });
</script>
@endpush
@section('content')
<!-- main wrapper start -->
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area bg-img" data-bg="{{ URL::asset('Auth/img/banner/breadcrumb-banner.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap text-center">
                        <nav aria-label="breadcrumb">
                            <h1 class="breadcrumb-title"> Sản phẩm của danh mục</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- sidebar area start -->
                <div class="col-lg-3 order-2">
                    <div class="sidebar-wrapper">
                        <!-- single sidebar start -->

                        <div class="sidebar-single">
                            <div class="sidebar-title">
                                <h3>Danh mục </h3>
                            </div>
                            <div class="sidebar-body">
                                <ul class="color-list">
                                    @foreach($categories as $cate)
                                        <li><a href="{{URL::to('/product_list/'.$cate->id)}}">{{$cate->m_title}} <span>({{$cate->tongproduct->count()}})</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- single sidebar end -->

                        <!-- single sidebar start -->
                        <form action="{{route('locgia')}}" method="get">
                            @csrf
                            <div class="sidebar-single">
                                <div class="sidebar-title">
                                    <h3>Lọc theo giá</h3>
                                </div>
                                <div class="sidebar-body">

                                    <div class="price-range-wrap">
                                        <div class="price-range" data-min="0" data-max="2000000"></div>
                                        <div class="range-slider">
                                            <form action="#">
                                                <div class="price-input">
                                                    <label for="amount">giá: </label>
                                                    <input type="text" id="minamount" name="minamount">
                                                    <input type="text" id="maxamount" name="maxamount">
                                                </div>
                                                <button class="filter-btn">lọc</button>
                                                <br>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="sidebar-single">
                            <div class="sidebar-banner">
                                <a href="#">
                                    <img src="{{ URL::asset('Auth/img/banner/banner_left.jpg') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 order-1">
                    <div class="shop-product-wrapper">
                        <div class="shop-top-bar">
                            <div class="row">
                                <div class="col-xl-5 col-lg-4 col-md-3 order-2 order-md-1">
                                    <div class="top-bar-left">
                                        <div class="product-view-mode">
                                            <a class="active" href="#" data-target="grid-view"><i class="fa fa-th"></i></a>
                                            <a href="#" data-target="list-view"><i class="fa fa-list"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-7 col-lg-8 col-md-9 order-1 order-md-2">
                                    <div class="top-bar-right">
                                        <div class="product-short">
                                            <p>Sắp xếp : </p>
                                            <select class="nice-select sortne" id="sortne" name="sortne">
                                                <option value="{{Request::url()}}?danhsach=sanphamaz">Tên (A - Z)</option>
                                                <option value="{{Request::url()}}?danhsach=sanphamza">Tên (Z - A)</option>
                                                <option value="{{Request::url()}}?danhsach=giathapdencao">Giá (Thấp &gt; Cao)</option>
                                                <option value="{{Request::url()}}?danhsach=giacaodenthap">Giá (Cao &gt; Thấp)</option>
                                                <option value="{{Request::url()}}?danhsach=moicapnhat">Mới cập nhật</option>
                                            </select>
                                        </div>
                                        <div class="product-amount">
                                            <p>đang xem 1-16 sản phẩm</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- shop product top wrap start -->

                        <!-- product item list start -->
                        <div class="shop-product-wrap grid-view row mbn-50">
                            @foreach ($showproduct as $key => $showprd)
                            <div class="col-lg-4 col-sm-6">
                                <!-- product grid item start -->
                                <div class="product-item mb-53">
                                    <div class="product-thumb">
                                        <a href="{{ route('productdetails', $showprd->m_product_slug) }}">
                                            @if (json_decode($showprd->m_picture))
                                            <img src="{{ asset('uploads') }}/{{ json_decode($showprd->m_picture)[0] }}" alt="">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h5 class="product-name">
                                            <a href="{{ route('productdetails', $showprd->m_product_slug) }}">{{ Str::length($showprd->m_product_name) > 30 ? Str::substr($showprd->m_product_name, 0, 30) . '...' : $showprd->m_product_name }}</a>
                                        </h5>
                                        <div class="price-box">
                                            <span class="price-regular">{{ number_format($showprd->m_original_price, 0, ',', '.') }}VND</span>
                                            <span class="price-old"><del>{{ number_format($showprd->m_price, 0, ',', '.') }}VND</del></span>
                                        </div>
                                        <div class="product-action-link">
                                            <a href="javascript:void(0);" data-id="{{$showprd->id}}" id="product-favourite-{{$showprd->id}}" data-toggle="tooltip" title="Yêu Thích"><i data-id="{{$showprd->id}}" class="ion-android-favorite-outline product-{{$showprd->id}}"></i></a>
                                            @if(isset($list_favourite))
                                            @foreach($list_favourite as $item)
                                            @if($item->id_product == $showprd->id)
                                            <a href="javascript:void(0);" class="active-favourite" data-id="{{$showprd->id}}" id="product-favourite-{{$showprd->id}}" data-toggle="tooltip" title="Yêu Thích"><i data-id="{{$showprd->id}}" class="ion-android-favorite-outline product-{{$showprd->id}}"></i></a>
                                            @elseif($item->id_product != $showprd->id)
                                            <a href="javascript:void(0);" data-id="{{$showprd->id}}" id="product-favourite-{{$showprd->id}}" data-toggle="tooltip" title="Yêu Thích"><i data-id="{{$showprd->id}}" class="ion-android-favorite-outline product-{{$showprd->id}}"></i></a>
                                            @else
                                            <a href="javascript:void(0);" data-id="{{$showprd->id}}" id="product-favourite-{{$showprd->id}}" data-toggle="tooltip" title="Yêu Thích"><i data-id="{{$showprd->id}}" class="ion-android-favorite-outline product-{{$showprd->id}}"></i></a>
                                            @endif
                                            @endforeach
                                            @endif

                                            <!-- <a href="#" class="add-cart" data-toggle="tooltip" title="Thêm Vào Giỏ"><i class="ion-bag"></i></a> -->
                                            <form action="" method="post" class="cart-info">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="productId" value="{{ $showprd->id }}">
                                            </form>
                                            <a href="#" data-toggle="modal" data-target="#quick_view{{ $showprd->id }}">
                                                <span data-toggle="tooltip" title="Xem Nhanh"><i class="ion-ios-eye-outline"></i></span> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    jQuery(document).ready(function($) {
        $('.sortne').change(function() {
            var url = $(this).val();
            if (url) {
                window.location = url;
            }
            return false;
        });
        locdanhsach();

        function locdanhsach() {
            var url = window.location.href;
            $('select[name="sortne"]').find('option[value="' + url + '"]').attr("selected", true);
        }
    });
</script>
@endsection
