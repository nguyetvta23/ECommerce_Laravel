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
    <!-- <main>
        <div class="breadcrumb-area bg-img" data-bg="{{ URL::asset('Auth/img/banner/breadcrumb-banner.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap text-center">
                            <nav aria-label="breadcrumb">
                                <h1 class="breadcrumb-title"> Danh sách Sản phẩm yêu thích</h1>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shop-main-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 order-1">
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
                                </div>
                            </div>
                            <div class="shop-product-wrap grid-view row mbn-50">


                            </div>
                        </div>
                    </div>
                </div>
    </main> -->
    <main>
        <div class="breadcrumb-area bg-img" data-bg="{{ URL::asset('Auth/img/banner/breadcrumb-banner.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap text-center">
                            <nav aria-label="breadcrumb">
                                <h1 class="breadcrumb-title"> Danh sách Sản phẩm yêu thích</h1>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shop-main-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 order-1">
                        <div class="shop-product-wrapper">
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
                                </div>
                            </div>
                            <div class="shop-product-wrap grid-view row mbn-50">
                                @foreach ($list_favourite as $key => $showprd)
                                    <div class="col-lg-3 col-sm-6">
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
                                                <h5 class="product-name">
                                                    <a
                                                        href="{{ route('productdetails', $showprd->m_product_slug) }}">{{ Str::length($showprd->m_product_name) > 30 ? Str::substr($showprd->m_product_name, 0, 30) . '...' : $showprd->m_product_name }}</a>
                                                </h5>
                                                <div class="price-box">
                                                    <div class="price-regular">
                                                        {{ number_format($showprd->m_original_price) }} <sup>&#8363;</sup>
                                                    </div>
                                                    <div class="price-old"><del>{{ number_format($showprd->m_price) }}
                                                            <sup>&#8363;</sup></del></div>
                                                </div>
                                                {{-- <div class="product-action-link">
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
                                                </div> --}}
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
                        </div>
                    </div>
                </div>
    </main>
@endsection
