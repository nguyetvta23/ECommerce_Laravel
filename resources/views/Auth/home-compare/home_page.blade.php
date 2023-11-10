@extends('Auth.layouts.master')
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
                    if (!response.isError) {
                        renderCart();
                        $("input[name=quantity]").val(1);
                        toastr.success('', 'Thêm giỏ hàng thành công')
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
@section('title')
    TRANG CHỦ
@endsection

@section('content')
    <style>
        .disabled {
            pointer-events: none;
            cursor: not-allowed;
        }
    </style>
    <main>
        <!-- hero slider section start -->
        <section class="hero-slider">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
                            @foreach ($sliders as $slider)
                                <!-- single slider item start -->
                                <div class="hero-single-slide">
                                    <div class="hero-slider-item bg-img"
                                        data-bg="{{ asset('uploads') }}/{{ $slider->m_images }}">
                                        <div class="hero-slider-content slide-1">
                                            <h5 class="slide-subtitle">{{ $slider->m_subtitle }}!</h5>
                                            <h2 class="slide-title">{{ $slider->m_title }}</h2>
                                            <p class="slide-desc">{!! $slider->m_description !!}</p>
                                            <a href="{{ $slider->m_link }}" class="btn btn-hero">XEM NGAY</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- single slider item end -->
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- hero slider section end -->

        <!-- service features start -->
        <section class="service-policy-area">
            <div class="container">
                <div class="row">
                    <!-- single policy item start -->
                    <div class="col-lg-4">
                        <div class="service-policy-item mt-30 bg-1">
                            <div class="policy-icon">
                                <img src="{{ URL::asset('Auth/img/icon/policy-1.png') }}" alt="policy icon">
                            </div>
                            <div class="policy-content">
                                <h5 class="policy-title">MIỄN PHÍ VẬN CHUYỂN</h5>
                                <p class="policy-desc">Giao hàng miễn phí cho các đơn hàng nội thành </p>
                            </div>
                        </div>
                    </div>
                    <!-- single policy item start -->

                    <!-- single policy item start -->
                    <div class="col-lg-4">
                        <div class="service-policy-item mt-30 bg-2">
                            <div class="policy-icon">
                                <img src="{{ URL::asset('Auth/img/icon/policy-2.png') }}" alt="policy icon">
                            </div>
                            <div class="policy-content">
                                <h5 class="policy-title">HỖ TRỢ TRỰC TUYẾN</h5>
                                <p class="policy-desc">Hỗ trợ trực tuyến 24 giờ một ngày</p>
                            </div>
                        </div>
                    </div>
                    <!-- single policy item start -->

                    <!-- single policy item start -->
                    <div class="col-lg-4">
                        <div class="service-policy-item mt-30 bg-3">
                            <div class="policy-icon">
                                <img src="{{ URL::asset('Auth/img/icon/policy-3.png') }}" alt="policy icon">
                            </div>
                            <div class="policy-content">
                                <h5 class="policy-title">CHÍNH SÁCH ĐỔI TRẢ</h5>
                                <p class="policy-desc">Đổi trả miễn phí trong 5 ngày</p></p>
                            </div>
                        </div>
                    </div>
                    <!-- single policy item start -->
                </div>
            </div>
        </section>
        <!-- service features end -->

        <!-- our product area start -->
        <section class="our-product section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2 class="title">Sản Phẩm Của Chúng Tôi</h2>
                            <!-- <p class="sub-title">Lorem ipsum dolor sit amet consectetur adipisicing</p> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-carousel-4 mbn-50 slick-row-15 slick-arrow-style">
                            <!-- product single item start -->
                            @foreach ($myProducts as $myProductItem)
                                <div class="product-item mb-50">
                                    <div class="product-thumb">
                                        <a href="{{ route('productdetails', $myProductItem->m_product_slug) }}">
                                            @if (json_decode($myProductItem->m_picture))
                                                <img src="{{ asset('uploads') }}/{{ json_decode($myProductItem->m_picture)[0] }}"
                                                    alt="">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="product-content">
                                        <h5 class="product-name text-left">
                                            <a
                                                href="{{ route('productdetails', $myProductItem->m_product_slug) }}">{{ Str::length($myProductItem->m_product_name) > 40 ? trim(Str::substr($myProductItem->m_product_name, 0, 40)) . '...' : $myProductItem->m_product_name  }}</a>
                                        </h5>
                                        <div class="price-box">
                                            <div class="price-regular">
                                                {{ number_format($myProductItem->m_original_price) }}
                                                <sup>&#8363;</sup>
                                            </div>
                                            <div class="price-old">
                                                <del>{{ number_format($myProductItem->m_price) }}
                                                    <sup>&#8363;</sup></del>
                                            </div>
                                        </div>
                                        <div class="product-action-link">
                                            <a href="javascript:void(0);" data-id="{{ $myProductItem->id }}"
                                                id="product-favourite-{{ $myProductItem->id }}" data-toggle="tooltip"
                                                title="Yêu Thích"><i data-id="{{ $myProductItem->id }}"
                                                    class="ion-android-favorite-outline product-{{ $myProductItem->id }}"></i></a>
                                            <!-- <a href="#" data-toggle="tooltip" title="Yêu Thích"><i class="ion-android-favorite-outline"></i></a> -->
                                            <a href="#" data-toggle="tooltip" title="Thêm Vào Giỏ"
                                                style="display: none"><i class="ion-bag"></i></a>
                                            <a href="#" data-toggle="modal"
                                                data-target="#quick_view{{ $myProductItem->id }}"> <span
                                                    data-toggle="tooltip" title="Xem Nhanh"><i
                                                        class="ion-ios-eye-outline"></i></span> </a>
                                            <!-- <a href="{{ route('productdetails', $myProductItem->m_product_slug) }}"><span data-toggle="tooltip" title="Xem Nhanh"><i class="ion-ios-eye-outline"></i></span> </a> -->
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- our product area end -->

        <!-- banner statistic area start -->
        <div class="banner-statistics">
            <div class="container">
                <div class="row no-gutters mtn-30">
                    <div class="col-md-6">
                        <div class="img-container mt-30">
                            <a href="product-details.html">
                                <img src="{{ URL::asset('Auth/img/banner/banner-1.jpg') }}" alt="banner-image">
                            </a>
                            <div class="banner-text">
                                <h5 class="banner-subtitle"></h5>
                                <h3 class="banner-title"><br></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="img-container mt-30">
                            <a href="product-details.html">
                                <img src="{{ URL::asset('Auth/img/banner/banner-2.jpg') }}" alt="banner-image">
                            </a>
                            <div class="banner-text">
                                <h5 class="banner-subtitle"></h5>
                                <h3 class="banner-title"><br></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- banner statistic area end -->

        <!-- top seller area start -->
        <section class="top-seller-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2 class="title">Sản phẩm bán chạy</h2>
                            {{-- <p class="sub-title"></p> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-5 col-md-5">
                        <div class="product-banner">
                            <a href="/product_list">
                                <img src="{{ URL::asset('Auth/img/banner/banner-3.jpg') }}" alt="product banner">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-7 col-md-7">
                        <div class="top-seller-carousel slick-row-15 mtn-30">
                            @foreach ($myProductSells as $myProductSellItem)
                                <div class="slide-item">
                                    <div class="pro-item-small mt-30">
                                        <div class="product-thumb">
                                            <a href="{{ route('productdetails', $myProductSellItem->m_product_slug) }}">
                                                @if (json_decode($myProductItem->m_picture))
                                                    <img src="{{ asset('uploads') }}/{{ json_decode($myProductSellItem->m_picture)[0] }}"
                                                        alt="">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="pro-small-content">
                                            <h6 class="product-name">
                                                <a
                                                    href="{{ route('productdetails', $myProductSellItem->m_product_slug) }}">{{ $myProductSellItem->m_product_name }}</a>
                                            </h6>
                                            <div class="price-box">
                                                <div class="price-regular">
                                                    {{ number_format($myProductSellItem->m_original_price) }}
                                                    <sup>&#8363;</sup>
                                                </div>
                                                <div class="price-old">
                                                    <del>{{ number_format($myProductSellItem->m_price) }}
                                                        <sup>&#8363;</sup></del>
                                                </div>
                                            </div>
                                            <div class="product-link-2">
                                                <a href="javascript:void(0);" data-id="{{ $myProductSellItem->id }}"
                                                    id="product-favourite-{{ $myProductSellItem->id }}"
                                                    data-toggle="tooltip" title="Yêu Thích"><i
                                                        data-id="{{ $myProductSellItem->id }}"
                                                        class="ion-android-favorite-outline product-{{ $myProductSellItem->id }}"></i></a>
                                                {{-- <a href="#" data-toggle="tooltip" title="Thêm vào giỏ hàng"><i
                                                        class="ion-bag"></i></a> --}}
                                                <a href="#" data-toggle="modal"
                                                    data-target="#quick_view{{ $myProductSellItem->id }}"> <span
                                                        data-toggle="tooltip" title="Xem Nhanh"><i
                                                            class="ion-ios-eye-outline"></i></span> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- product item start -->


                            <!-- lưu ý chỉ có 6 hoặc 8 sản phẩm ở đây thôi nhé -->


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- top seller area end -->

        <!-- latest blog area start -->
        <section class="latest-blog-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2 class="title">Tin Tức</h2>
                            <p class="sub-title">Tổng hợp tin tức sớm nhất</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="blog-carousel-active slick-row-15">
                            @foreach ($blogs as $blogItem)
                                <!-- blog single item start -->
                                <div class="blog-post-item">
                                    <div class="blog-thumb">
                                        <a href="{{ route('blog-detail', $blogItem->m_slug) }}">
                                            <img src="{{ asset('uploads/post') }}/{{ $blogItem->m_image }}"
                                                alt="{{ $blogItem->m_image }}">
                                        </a>
                                    </div>
                                    <div class="blog-content">
                                        <h5 class="blog-title">
                                            <a href="{{ route('blog-detail', $blogItem->m_slug) }}">
                                                {{ Str::length($blogItem->m_title) > 65 ? trim(Str::substr($blogItem->m_title, 0, 65)) . '...' : $blogItem->m_title }}
                                            </a>
                                        </h5>
                                        <ul class="blog-meta">
                                            <li><span>Tác giả: </span>{{ $blogItem->user->name }}</li>
                                            <li><span>Thời gian: </span>{{ $blogItem->created_at->format('d/m/Y') }}</li>
                                        </ul>
                                        <a href="{{ route('blog-detail', $blogItem->m_slug) }}" class="read-more">Đọc
                                            ngay...</a>
                                    </div>
                                </div>
                            @endforeach
                            <!-- blog single item start -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- latest blog area end -->

        <!-- brand area start -->
        <div class="brand-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="brand-active-carousel">
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ URL::asset('Auth/img/brand/br1.png') }}" alt="brand image">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ URL::asset('Auth/img/brand/br2.png') }}" alt="brand image">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ URL::asset('Auth/img/brand/br3.png') }}" alt="brand image">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ URL::asset('Auth/img/brand/br4.png') }}" alt="brand image">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="#">
                                    <img src="{{ URL::asset('Auth/img/brand/br5.png') }}" alt="brand image">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- brand area end -->
    </main>

    <!-- Quick view modal start -->
    @foreach ($myProducts as $key => $myProductItem)
        <div class="modal" id="quick_view{{ $myProductItem->id }}">
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
                                        @if (json_decode($myProductItem->m_picture))
                                            @foreach (json_decode($myProductItem->m_picture) as $showimg)
                                                <div class="pro-large-img img-zoom">
                                                    <img src="{{ asset('uploads') }}/{{ $showimg }}"
                                                        alt="" />
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="pro-nav slick-row-5">
                                        @if (json_decode($myProductItem->m_picture))
                                            @foreach (json_decode($myProductItem->m_picture) as $showimg)
                                                <div class="pro-nav-thumb"><img
                                                        src="{{ asset('uploads') }}/{{ $showimg }}"
                                                        alt="" /></div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="product-details-des">
                                        <h3 class="pro-det-title">{{ $myProductItem->m_product_name }}</h3>
                                        <div class="pro-review">
                                            <span><a href="#">1 bình luận</a></span>
                                        </div>
                                        <div class="price-box">
                                            <div class="price-regular">
                                                {{ number_format($myProductItem->m_original_price) }}
                                                <sup>&#8363;</sup>
                                            </div>
                                            <div class="price-old">
                                                <del>{{ number_format($myProductItem->m_price) }}
                                                    <sup>&#8363;</sup></del>
                                            </div>
                                        </div>
                                        <p>{!! $myProductItem->m_short_description !!}</p>
                                        <div class="quantity-cart-box d-flex align-items-center mb-20">
                                            <div class="quantity">
                                                <div class="pro-qty"><input type="text" name="quantity"
                                                        value="1"></div>
                                            </div>
                                            <a href="" class="btn btn-default add-cart disabled">Thêm vào giỏ
                                                hàng</a>
                                            <form action="" method="post" class="cart-info">
                                                @csrf
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="productId" value="{{ $myProductItem->id }}">
                                                <input type="hidden" name="sizeId">
                                            </form>
                                        </div>
                                        <div class="availability mb-20">
                                            <h5 class="cat-title">Size: </h5>
                                            <select class="nice-select size" style="width: 100px">
                                                <option value="">Chọn size</option>
                                                @foreach ($myProductItem->updatedsoluong1 as $shows)
                                                    @if ($shows->m_quanti > 0)
                                                        <option value="{{ $shows->id }}"><b>{{ $shows->m_size }}</b>
                                                            - Số lượng: {{ $shows->m_quanti }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            {{-- @if ($myProductItem->m_buy > 0)
                                                <span>Còn hàng</span>
                                            @else
                                                <span style="color:red">Hết hàng</span>
                                            @endif --}}
                                        </div>
                                        <div class="share-icon">
                                            <h5 class="cat-title">Chia sẻ:</h5>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
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
@endsection
