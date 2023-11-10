@extends('Auth.layouts.master')
@section('title')
    Danh sách sản phẩm
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
                        if (response.status == 200) {
                            toastr.success('', response.message)
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
                    if (!response.isError) {
                        renderCart();
                        $("input[name=quantity]").val(1);
                        toastr.success('',
                            'Thêm giỏ hàng thành công')
                    } else {
                        toastr.error('', response.message)
                    }
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
        $('.nice-select.size').change(function(e) {
            e.preventDefault();
            $('input[name=sizeId]').val(this.value);
            $('.add-cart').removeClass('disabled');
        });
    </script>
@endpush
@section('content')
    <style>
        .disabled {
            pointer-events: none;
            cursor: not-allowed;
        }
    </style>
    <!-- main wrapper start -->
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area bg-img" data-bg="{{ URL::asset('Auth/img/banner/breadcrumb-banner.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap text-center">
                            <nav aria-label="breadcrumb">
                                <h1 class="breadcrumb-title"> Danh sách Sản phẩm</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">sản phẩm</li>
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
                                        @foreach ($categories as $cate)
                                            <li><a href="{{ URL::to('/product_list/' . $cate->id) }}">{{ $cate->m_title }}
                                                    <span>({{ $cate->tongproduct->count() }})</span></a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <!-- single sidebar end -->

                            <!-- single sidebar start -->
                            <form action="{{ route('locgia') }}" method="get">
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
                                                    <div class="price-input d-flex">
                                                        <label for="amount">Giá: </label>
                                                        <input type="text" id="minamount" name="minamount">
                                                        <input type="text" id="maxamount" name="maxamount">
                                                    </div>
                                                    <button class="filter-btn mb-3">Lọc</button>
                                                    <br>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- single sidebar end -->

                            <!-- single sidebar start -->
                            <div class="sidebar-single">
                                <div class="sidebar-banner">
                                    <a
                                        href="http://127.0.0.1:8000/chi-tiet-san-pham/giay-tennis-nam-reebok-royal-techque-t-gz5684.html">
                                        <img src="{{ URL::asset('Auth/img/banner/banner_left.jpg') }}" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- single sidebar end -->
                        </div>
                    </div>
                    <!-- sidebar area end -->

                    <!-- shop main wrapper start -->
                    <div class="col-lg-9 order-1">
                        <div class="shop-product-wrapper">
                            <!-- shop product top wrap start -->
                            <div class="shop-top-bar">
                                <div class="row">
                                    <div class="col-xl-5 col-lg-4 col-md-3 order-2 order-md-1">
                                        <div class="top-bar-left">
                                            <div class="product-view-mode">
                                                <a class="active" href="#" data-target="grid-view"><i
                                                        class="fa fa-th"></i></a>
                                                <a href="#" data-target="list-view"><i class="fa fa-list"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7 col-lg-8 col-md-9 order-1 order-md-2">
                                        <div class="top-bar-right">
                                            <div class="product-short">
                                                <p>Sắp xếp : </p>
                                                <select class="nice-select sortne" id="sortne" name="sortne">
                                                    <option value="{{ Request::url() }}?danhsach=sanphamaz">Tên (A - Z)
                                                    </option>
                                                    <option value="{{ Request::url() }}?danhsach=sanphamza">Tên (Z - A)
                                                    </option>
                                                    <option value="{{ Request::url() }}?danhsach=giathapdencao">Giá (Thấp
                                                        &gt; Cao)</option>
                                                    <option value="{{ Request::url() }}?danhsach=giacaodenthap">Giá (Cao
                                                        &gt; Thấp)</option>
                                                    <option value="{{ Request::url() }}?danhsach=moicapnhat">Mới cập nhật
                                                    </option>
                                                </select>
                                                <button class="btn btn-sm-primary ml-3" id="locsanpham">lọc</button>

                                            </div>
                                            <!-- <div class="product-amount">
                                                                                        <button class="btn btn-primary" id="locsanpham">lọc</button>
                                                                                    </div> -->
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
                                                        <img src="{{ asset('uploads') }}/{{ json_decode($showprd->m_picture)[0] }}"
                                                            alt="">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="product-content">
                                                <h5 class="product-name text-left">
                                                    <a
                                                        href="{{ route('productdetails', $showprd->m_product_slug) }}">{{ Str::length($showprd->m_product_name) > 40 ? trim(Str::substr($showprd->m_product_name, 0, 40)) . '...' : $showprd->m_product_name }}</a>
                                                </h5>
                                                <div class="price-box">
                                                    <div class="price-regular">
                                                        {{ number_format($showprd->m_original_price) }} <sup>&#8363;</sup>
                                                    </div>
                                                    <div class="price-old"><del>{{ number_format($showprd->m_price) }}
                                                            <sup>&#8363;</sup></del></div>
                                                </div>
                                                <div class="product-action-link">
                                                    <a href="javascript:void(0);" data-id="{{ $showprd->id }}"
                                                        id="product-favourite-{{ $showprd->id }}" data-toggle="tooltip"
                                                        title="Yêu Thích"><i data-id="{{ $showprd->id }}"
                                                            class="ion-android-favorite-outline product-{{ $showprd->id }}"></i></a>
                                                    <a href="#" title="Thêm Vào Giỏ Hàng" style="display: none"><i
                                                            class="ion-bag"></i></a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#quick_view{{ $showprd->id }}">
                                                        <span data-toggle="tooltip" title="Xem Nhanh"><i
                                                                class="ion-ios-eye-outline"></i></span> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product grid item end -->

                                        <!-- product list item start -->
                                        <div class="product-list-item mb-30">
                                            <div class="product-thumb">
                                                <a href="{{ route('productdetails', $showprd->m_product_slug) }}">
                                                    @if (json_decode($showprd->m_picture))
                                                        <img src="{{ asset('uploads') }}/{{ json_decode($showprd->m_picture)[0] }}"
                                                            alt="">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="product-content-list">
                                                <h5 class="product-name">
                                                    <a
                                                        href="{{ route('productdetails', $showprd->m_product_slug) }}">{{ $showprd->m_product_name }}</a>
                                                </h5>
                                                <div class="price-box">
                                                    <div class="price-regular">
                                                        {{ number_format($showprd->m_original_price) }} <sup>&#8363;</sup>
                                                    </div>
                                                    <div class="price-old"><del>{{ number_format($showprd->m_price) }}
                                                            <sup>&#8363;</sup></del></div>
                                                </div>
                                                <p>{!! $showprd->m_short_description !!}</p>
                                                <div class="product-link-2 position-static">
                                                    <a href="#" data-toggle="tooltip" title="Yêu Thích"><i
                                                            class="ion-android-favorite-outline"></i></a>
                                                    <a href="#" data-toggle="tooltip" title="Thêm Vào Giỏ"><i
                                                            class="ion-bag"></i></a>
                                                    <a href="#" data-toggle="modal"
                                                        data-target="#quick_view{{ $showprd->id }}">
                                                        <span data-toggle="tooltip" title="Xem Nhanh"><i
                                                                class="ion-ios-eye-outline"></i></span> </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product list item start -->
                                        {{-- add to cart --}}
                                    </div>
                                @endforeach
                            </div>
                            <!-- shop main wrapper end -->
                        </div>
                        <br>
                        <div>{{ $showproduct->appends(request()->all())->links() }}</div>
                    </div>
                </div>
                <br>

                <!-- page main wrapper end -->
    </main>
    <!-- main wrapper end -->
    <!-- Quick view modal start -->
    @foreach ($showproduct as $key => $showprd)
        <div class="modal" id="quick_view{{ $showprd->id }}">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- product details inner end -->
                        <div class="product-details-inner">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="product-large-slider mb-20">
                                        @if (json_decode($showprd->m_picture))
                                            @foreach (json_decode($showprd->m_picture) as $showimg)
                                                <div class="pro-large-img img-zoom">
                                                    <img src="{{ asset('uploads') }}/{{ $showimg }}"
                                                        alt="" />
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="pro-nav slick-row-5">
                                        @if (json_decode($showprd->m_picture))
                                            @foreach (json_decode($showprd->m_picture) as $showimg)
                                                <div class="pro-nav-thumb"><img
                                                        src="{{ asset('uploads') }}/{{ $showimg }}"
                                                        alt="" /></div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="product-details-des">
                                        <h3 class="pro-det-title">{{ $showprd->m_product_name }}</h3>
                                        <div class="pro-review">
                                            <span><a href="#">1 bình luận</a></span>
                                        </div>
                                        <div class="price-box">
                                            <span class="price-regular">{{ number_format($showprd->m_original_price) }}
                                                <sup>&#8363;</sup></span>
                                            <span class="price-old"><del>{{ number_format($showprd->m_price) }}
                                                    <sup>&#8363;</sup></del></span>
                                        </div>
                                        <p>{!! $showprd->m_short_description !!}</p>
                                        <div class="quantity-cart-box d-flex align-items-center mb-20">
                                            <div class="quantity">
                                                <div class="pro-qty"><input type="text" value="1"
                                                        name="quantity"></div>
                                            </div>
                                            <a href="#" class="btn btn-default add-cart disabled">Thêm vào giỏ
                                                hàng</a>
                                            <form action="" method="post" class="cart-info">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="productId" value="{{ $showprd->id }}">
                                                <input type="hidden" name="sizeId">
                                            </form>
                                        </div>
                                        <div class="availability mb-20">
                                            <h5 class="cat-title">Size: </h5>
                                            <select class="nice-select size" style="width: 100px">
                                                <option value="">Chọn size</option>
                                                @foreach ($showprd->updatedsoluong1 as $shows)
                                                    @if ($shows->m_quanti > 0)
                                                        <option value="{{ $shows->id }}"><b>{{ $shows->m_size }}</b>
                                                            - Số
                                                            lượng: {{ $shows->m_quanti }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- product details inner end -->
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Quick view modal end -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        jQuery(document).ready(function($) {
            $('#locsanpham').click(function() {
                var url = $('.sortne').val();
                // alert(url);
                if (url) {
                    window.location = url;
                }
                return false;
            });
            locdanhsach();

            function locdanhsach() {
                var url = window.location.href;
                $('ul[class="list"]').find('option[value="' + url + '"]').attr("selected", true);
            }
        });
    </script>
@endsection
