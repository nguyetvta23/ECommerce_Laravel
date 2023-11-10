@extends('Auth.layouts.master')
@push('scripts')
    <script>
        //Sản phẩm yêu thích FE của Yến
        $(document).ready(function() {
            $('.ion-android-favorite-outline').click(function(event) {
                event.preventDefault();
                var idProduct = $(this).data('id');
                var listproductStorage = localStorage.getItem('product');
                var josnListproductStorage = JSON.parse(listproductStorage);
                if (josnListproductStorage && josnListproductStorage.length > 0) {
                    var result = josnListproductStorage.find(item => item.id === idProduct);
                    if (result) {
                        toastr.error('', "Sản phẩm này đã được chọn");
                    } else {
                        $.ajax({
                            type: "post",
                            url: "/product-favourite",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'idProduct': idProduct,
                            },
                            success: function(response) {
                                let clientsArr = JSON.parse(localStorage.getItem('product')) ||
                                    [];
                                clientsArr.push(response.data);
                                localStorage.setItem('product', JSON.stringify(clientsArr));
                                toastr.success('',
                                    'Chọn sản phẩm yêu thích thành công')
                            },
                            error: function(error) {
                                toastr.error('', error);
                            }
                        });
                    }
                } else {
                    $.ajax({
                        type: "post",
                        url: "/product-favourite",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'idProduct': idProduct,
                        },
                        success: function(response) {
                            let clientsArr = JSON.parse(localStorage.getItem('product')) || [];
                            clientsArr.push(response.data);
                            localStorage.setItem('product', JSON.stringify(clientsArr));
                            toastr.success('',
                                'Chọn sản phẩm yêu thích thành công')
                        },
                        error: function(error) {
                            toastr.error('', error);
                        }
                    });
                }

            });
        });

        $('.cart-info').submit(function(e) {
            e.preventDefault();
            let data = new FormData(this);
            data.append('quantity', $('input[name=quantity]').val())
            $.ajax({
                type: "post",
                url: "{{ url('api/cart') }}",
                data,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    renderCart();
                    $("input[name=quantity]").val(1);
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

        $('.nice-select.size').change(function(e) {
            e.preventDefault();
            $('input[name=sizeId]').val(this.value);
            $('.add-cart').removeClass('disabled');
        });
    </script>
@endpush
@section('title')
    Chi tiết sản phẩm
@endsection
@section('content')
    <style>
        .disabled {
            pointer-events: none;
            cursor: not-allowed;
        }
    </style>
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area bg-img" data-bg="{{ URL::asset('Auth/img/banner/breadcrumb-banner.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap text-center">
                            <nav aria-label="breadcrumb">
                                <h1 class="breadcrumb-title">Cửa hàng</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                    <li class="breadcrumb-item"><a href="shop.html">Cửa hàng</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- product details wrapper start -->
        <div class="product-details-wrapper section-padding">
            <div class="container custom-container">
                <div class="row">
                    <div class="col-12">
                        <!-- product details inner end -->
                        <div class="product-details-inner">
                            <div class="row">
                                @foreach ($showproductdetailget as $showdetail)
                                    <div class="col-lg-5">
                                        <div class="product-large-slider mb-20">
                                            @if (json_decode($showdetail->m_picture))
                                                @foreach (json_decode($showdetail->m_picture) as $showimg)
                                                    <div class="pro-large-img img-zoom">
                                                        <img src="{{ asset('uploads') }}/{{ $showimg }}"
                                                            alt="" />
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="pro-nav slick-row-5">
                                            @if (json_decode($showdetail->m_picture))
                                                @foreach (json_decode($showdetail->m_picture) as $showimg)
                                                    <div class="pro-nav-thumb"><img
                                                            src="{{ asset('uploads') }}/{{ $showimg }}"
                                                            alt="" /></div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="product-details-des">
                                            <h3 class="pro-det-title" data-idmaloai="{{ $showdetail->id }}">
                                                {{ $showdetail->m_product_name }}</h3>
                                            <div class="pro-review">
                                                <span><a href="#"></a></span>
                                            </div>
                                            <div class="price-box">
                                                <div class="regular-price">
                                                    {{ number_format($showdetail->m_original_price) }} <sup>&#8363;</sup>
                                                </div>
                                                <div class="old-price"><del>{{ number_format($showdetail->m_price) }}
                                                        <sup>&#8363;</sup></del></div>
                                            </div>
                                            <p>{!! $showdetail->m_short_description !!}</p>
                                            <div class="quantity-cart-box d-flex align-items-center mb-20">
                                                <div class="quantity">
                                                    <div class="pro-qty"><input name="quantity" type="text"
                                                            value="1"></div>
                                                </div>
                                                <a href="#" class="btn btn-default add-cart disabled">Thêm vào giỏ
                                                    hàng</a>
                                                <form action="" method="post" class="cart-info">
                                                    @csrf
                                                    <input type="hidden" name="productId" value="{{ $showdetail->id }}">
                                                    <input type="hidden" name="sizeId">
                                                </form>
                                            </div>

                                            <div class="availability mb-20">
                                                <h5 class="cat-title">Size :</h5>
                                                <select class="nice-select size">
                                                    <option value="">Chọn size</option>
                                                    @foreach ($showsize as $shows)
                                                        <option value="{{ $shows->id }}">{{ $shows->m_size }} -
                                                            Số lượng: {{ $shows->m_quanti }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            {{-- <div class="availability mb-20">
                                        <h5 class="cat-title">Tình trạng:</h5>
                                        @if (isset($showdetail->updatedsoluong->m_quanti) && $showdetail->updatedsoluong->sum('m_quanti') > 0)
                                        <span>Còn hàng</span>
                                        @else
                                        <span style="color:red">Hết hàng</span>
                                        @endif
                                    </div> --}}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- product details inner end -->

                        <!-- product details reviews start -->
                        <div class="product-details-reviews section-padding">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="product-review-info">
                                        <ul class="nav review-tab">
                                            <li>
                                                <a class="active" data-toggle="tab" href="#tab_one">Mô tả</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#tab_two">Thông tin</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#tab_three">Bình luận</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content reviews-tab">
                                            @foreach ($showproductdetailget as $showdetail)
                                                <div class="tab-pane fade show active" id="tab_one">
                                                    <div class="tab-one">
                                                        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla augue nec est tristique auctor. Ipsum metus feugiat sem, quis fermentum turpis eros eget velit. Donec ac tempus ante. Fusce ultricies massa massa. Fusce aliquam, purus eget sagittis vulputate, sapien libero hendrerit est, sed commodo augue nisi non neque.</p> -->
                                                        <div class="review-description">
                                                            <div class="tab-thumb">
                                                                @if (json_decode($showdetail->m_picture))
                                                                    <img src="{{ asset('uploads') }}/{{ json_decode($showdetail->m_picture)[0] }}"
                                                                        alt="">
                                                                @endif
                                                            </div>
                                                            <div class="tab-des">
                                                                <h3>Thông tin sản phẩm :</h3>
                                                                <ul>
                                                                    <li>Thuộc sản phẩm :
                                                                        {{ $showdetail->showdanhmuc->m_title }}</li>
                                                                    <li>{{ $showdetail->m_product_name }}</li>
                                                                    <li>Giá mặc định :
                                                                        {{ number_format($showdetail->m_price) }} VNĐ</li>
                                                                    <li>Giá giảm :
                                                                        {{ number_format($showdetail->m_original_price) }}
                                                                        VNĐ</li>
                                                                    <li>
                                                                        @if (isset($showdetail->updatedsoluong->m_quanti) && $showdetail->updatedsoluong->sum('m_quanti') > 0)
                                                                            <span>Còn hàng</span>
                                                                        @else
                                                                            <span>Hết hàng</span>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <p>{!! $showdetail->m_description !!}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="tab-pane fade" id="tab_two">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td>Lượng tồn kho</td>
                                                            <td>
                                                                @foreach ($showsize as $shows)
                                                                    - {{ $shows->m_quanti }}
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kích thước</td>
                                                            <td>
                                                                @foreach ($showsize as $shows)
                                                                    - {{ $shows->m_size }}
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="tab-pane fade" id="tab_three">
                                                <!-- <form action="#" class="review-form"> -->
                                                @foreach ($showproductdetailget as $showprd)
                                                    <h5>{{ $showprd->showcountcomment->count() }} Đánh giá:</h5>
                                                @endforeach
                                                @foreach ($showcomment as $showcm)
                                                    <!-- <span>{{ $showcm->showiduser->name }}</span> -->
                                                    <div class="total-reviews">
                                                        <div class="rev-avatar">
                                                            @if ($showcm->showiduser->m_avatar)
                                                                <img src="{{ asset('uploads') }}/{{ $showcm->showiduser->m_avatar }}"
                                                                    alt="">
                                                            @else
                                                                <img src="{{ URL::asset('Auth/img/about/avatar.jpg') }}"
                                                                    alt="">
                                                            @endif
                                                        </div>
                                                        <div class="review-box" data-idbl="{{ $showcm->idbl }}">
                                                            <div class="ratings">
                                                                @for ($i = 1; $i <= $showcm->ratings; $i++)
                                                                    <span class="good"><i class="fa fa-star"></i></span>
                                                                @endfor
                                                            </div>
                                                            <div class="post-author">
                                                                <p><span>{{ $showcm->showiduser->name }} -</span>
                                                                    {{ $showcm->updated_at->diffForHumans() }}</p>
                                                            </div>
                                                            <p>
                                                                {{ $showcm->m_content }}
                                                            </p>
                                                            @Auth
                                                                @if ($showcm->m_id_user == Auth::user()->id)
                                                                    <button class="btn" id="deletebl"
                                                                        data-iddelete="{{ $showcm->idbl }}"
                                                                        style="float:right">Xóa đánh giá</button>
                                                                @endif
                                                            @endauth
                                                            <!-- admin trả lời nếu có -->
                                                            @if ($showcm->answer_cmt)
                                                                <hr>
                                                                <div class="post-author">
                                                                    <p><span>{{ $showcm->showiduser->name }} trả lời
                                                                            -</span>
                                                                        {{ $showcm->updated_at->diffForHumans() }}</p>
                                                                </div>
                                                                <p>
                                                                    {{ $showcm->answer_cmt }}
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <!-- <div class="form-group row">
                                                                    <div class="col">
                                                                        <label class="col-form-label"><span class="text-danger">*</span> Họ và tên</label>
                                                                        <input type="text" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col">
                                                                        <label class="col-form-label"><span class="text-danger">*</span> Email</label>
                                                                        <input type="email" class="form-control" required>
                                                                    </div>
                                                                </div> -->
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Nội dung</label>
                                                        <textarea class="form-control" id="m_content" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col">
                                                        <label class="col-form-label"><span class="text-danger">*</span>
                                                            Đánh giá</label>
                                                        <!-- &nbsp;&nbsp;&nbsp; Tệ&nbsp;
                                                                        <input type="radio" value="1" name="rating" id="rating">
                                                                        &nbsp;
                                                                        <input type="radio" value="2" name="rating" id="rating">
                                                                        &nbsp;
                                                                        <input type="radio" value="3" name="rating" id="rating">
                                                                        &nbsp;
                                                                        <input type="radio" value="4" name="rating" id="rating">
                                                                        &nbsp;
                                                                        <input type="radio" value="5" name="rating" id="rating">
                                                                        &nbsp;Rất tốt -->
                                                        <select class="form-control" id="rating" style="width:100px">
                                                            <option value="1">1 sao</option>
                                                            <option value="2">2 sao</option>
                                                            <option value="3">3 sao</option>
                                                            <option value="4">4 sao</option>
                                                            <option value="5">5 sao</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    @if (Route::has('login'))
                                                        @Auth
                                                            <button class="sqr-btn" type="submit" id="btnsubmitcomment"
                                                                data-id="{{ Auth::user()->id }}">Tiếp tục</button>
                                                        @else
                                                            <button class="sqr-btn" type="submit"
                                                                onclick="alert('Vui lòng kiểm tra đăng nhập hoặc bạn chưa mua sản phẩm này!')">Tiếp
                                                                tục</button>
                                                        @endif
                                                        @endif
                                                    </div>
                                                    <!-- </form> end of review-form -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- product details reviews end -->

                            <!-- featured product area start -->
                            <section class="Related-product">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="section-title text-center">
                                                <h2 class="title">Sản phẩm liên quan</h2>
                                                <p class="sub-title"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="product-carousel-4 mbn-50 slick-row-15 slick-arrow-style">
                                                <!-- product single item start -->
                                                @foreach ($showproductrelated as $showrelated)
                                                    <div class="product-item mb-50">
                                                        <div class="product-thumb">
                                                            <a
                                                                href="{{ route('productdetails', $showrelated->m_product_slug) }}">
                                                                @if (json_decode($showrelated->m_picture))
                                                                    <img src="{{ asset('uploads') }}/{{ json_decode($showrelated->m_picture)[0] }}"
                                                                        alt="">
                                                                @endif
                                                            </a>
                                                        </div>
                                                        <div class="product-content">
                                                            <h5 class="product-name">
                                                                <a
                                                                    href="{{ route('productdetails', $showrelated->m_product_slug) }}">{{ Str::length($showrelated->m_product_name) > 30 ? Str::substr($showrelated->m_product_name, 0, 30) . '...' : $showrelated->m_product_name }}</a>
                                                            </h5>
                                                            <div class="price-box">
                                                                <span
                                                                    class="price-regular">{{ number_format($showrelated->m_price) }}
                                                                    <sup>&#8363;</sup></span>
                                                                <span class="price-old"><del>{{ number_format($showrelated->m_original_price) }}
                                                                        <sup>&#8363;</sup></del></span>
                                                            </div>
                                                            <div class="product-action-link">
                                                                <a href="#" data-toggle="tooltip" title="Yêu thích"><i
                                                                        class="ion-android-favorite-outline" data-id={{$showrelated->id}}></i></a>
                                                                <a href="#" data-toggle="tooltip" style="display: none"
                                                                    title="Thêm vào giỏ hàng"><i class="ion-bag"></i></a>
                                                                <a href="#" data-toggle="modal"
                                                                    data-target="#quick_view{{ $showrelated->id }}"> <span
                                                                        data-toggle="tooltip" title="Xem nhanh"><i
                                                                            class="ion-ios-eye-outline"></i></span> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <!-- product single item start -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- featured product area end -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- product details wrapper end -->
        </main>
        <!-- main wrapper end -->
        <!-- Quick view modal start -->
        @foreach ($showproductrelated as $showrelated)
            <div class="modal" id="quick_view{{ $showrelated->id }}">
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
                                            @if (json_decode($showrelated->m_picture))
                                                @foreach (json_decode($showrelated->m_picture) as $showimg)
                                                    <div class="pro-large-img img-zoom">
                                                        <img src="{{ asset('uploads') }}/{{ $showimg }}"
                                                            alt="" />
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="pro-nav slick-row-5">
                                            @if (json_decode($showrelated->m_picture))
                                                @foreach (json_decode($showrelated->m_picture) as $showimg)
                                                    <div class="pro-nav-thumb"><img
                                                            src="{{ asset('uploads') }}/{{ $showimg }}"
                                                            alt="" /></div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="product-details-des">
                                            <h3 class="pro-det-title">{{ $showrelated->m_product_name }}</h3>
                                            <div class="pro-review">
                                                <span><a href="#"></a></span>
                                            </div>
                                            <div class="price-box">
                                                <span
                                                    class="price-regular">{{ number_format($showrelated->m_original_price) }}
                                                    <sup>&#8363;</sup></span>
                                                <span class="price-old"><del>{{ number_format($showrelated->m_price) }}
                                                        <sup>&#8363;</sup></del></span>
                                            </div>
                                            <p>{!! $showrelated->m_short_description !!}</p>
                                            <div class="quantity-cart-box d-flex align-items-center mb-20">
                                                <div class="quantity">
                                                    <div class="pro-qty"><input type="text" name="quantity"
                                                            value="1"></div>
                                                </div>
                                                <a href="#" class="btn btn-default add-cart disabled">Thêm vào giỏ
                                                    hàng</a>
                                                <form action="" method="post" class="cart-info">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <input type="hidden" name="productId" value="{{ $showrelated->id }}">
                                                    <input type="hidden" name="sizeId">
                                                </form>
                                            </div>
                                            <div class="availability mb-20">
                                                <h5 class="cat-title">Size: </h5>
                                                <select class="nice-select size" style="width: 100px">
                                                    <option value="">Chọn size</option>
                                                    @foreach ($showsize as $shows)
                                                        @if ($shows->m_quanti > 0)
                                                            <option value="{{ $shows->id }}"><b>{{ $shows->m_size }}</b>
                                                                - Số
                                                                lượng: {{ $shows->m_quanti }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $('#btnsubmitcomment').click(function(event) {
                var idmaloai = $('.pro-det-title').data('idmaloai');
                var idbl = $('.review-box').data('idbl');
                var iduser = $(this).data('id');
                var noi_dung = $('#m_content').val();
                var rating = $('#rating').val();
                var _token = $('input[name="_token"]').val();
                // alert(idmaloai);
                // alert(iduser);
                // alert(noi_dung);
                // alert(rating);
                // alert(_token);
                $.ajax({
                    url: '{{ route('postcomment') }}',
                    method: 'post',
                    data: {
                        idmaloai: idmaloai,
                        idbl: idbl,
                        iduser: iduser,
                        noi_dung: noi_dung,
                        rating: rating,
                        _token: _token
                    },
                    success: function(data) {
                        if (data) {
                            alert('Đánh giá thành công!');
                            window.location.reload(true);
                        } else {
                            alert('Đánh giá thất bại!');
                        }
                    }
                })
            });
        </script>
        <script>
            $(document).on('click', '#deletebl', function() {
                var iddelete = $(this).data('iddelete');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ route('showdelete') }}',
                    method: 'post',
                    data: {
                        iddelete: iddelete,
                        _token: _token
                    },
                    success: function(data) {
                        if (data) {
                            alert('Bạn đã xóa đánh giá!');
                            window.location.reload(true);
                        } else {
                            alert('Xóa đánh giá thất bại');
                        }
                    }
                })
            })
        </script>

    @endsection
