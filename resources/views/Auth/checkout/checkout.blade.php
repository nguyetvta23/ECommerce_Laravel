@extends('Auth.layouts.master')
@push('scripts')
    <script>
        function showPass() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        let payMethod = "cash";
        let pro = "";
        let dis = "";
        let war = "";
        let totalGlobal = 0;
        let couponGlobal = 0;
        let shipGlobal = 0;
        // render cart info
        const renderCheckout = async () => {
            const response = await callApiCart();
            const {
                data,
                subtotal,
                count,
                total,
                tax,
            } = response;
            let content = ``;
            totalGlobal = total.replace(/,/g, '');
            for (let key in data) {
                content += `<tr>
                                <td><a href="{{ url('chi-tiet-san-pham') }}/${data[key].options.slug}">${data[key].name + ' - Size: ' + data[key].options.sizeName} <strong> × ${data[key].qty}</strong></a>
                                </td>7
                                <td>${(data[key].price * data[key].qty).toLocaleString('en-US') }</td>
                            </tr>`
            }
            $('.checkout-content').html(content)
            $('.tax').text(tax);
            $('.total-price').text(total);
        }

        renderCheckout()

        // handle change payment method
        $('input[name=paymentmethod]').change(function(e) {
            e.preventDefault();
            payMethod = $(this).val();
        });
        // submit checkout info
        $('#form-checkout').submit(function(e) {
            e.preventDefault();
            let data = new FormData(this);
            let total = $('.total-price:first').text().replace(/,/g, "");
            data.append('m_total_price', Number(totalGlobal));
            data.append('m_coupon', couponGlobal);
            $.ajax({
                type: "post",
                url: "{{ url('api/checkout') }}",
                data,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    if (response.IsError) {
                        toastr.error('', response.message)
                    } else {
                        const {
                            data
                        } = response;
                        $('input[name=txnRef]').val(data.id);
                        if (payMethod == 'cash') {
                            window.location.href = "{{ route('checkout-success') }}";
                        } else if (payMethod == 'momo') {
                            $('#momo-payment').submit();
                        } else {
                            $('#vnpay-payment').submit();
                        }
                    }

                },
                error: function(error) {
                    console.error(error);
                    ["m_name", "m_email", "m_desc", "m_phone", "province_nice-select",
                        "district_nice-select", "ward_nice-select",
                        "m_address"
                    ].map((item) => {
                        $(`.${item}`).empty();
                    })
                    let validate = error.responseJSON.errors;
                    for (const key in validate) {
                        let content = '';
                        validate[key].map((item) => {
                            content += `<li style="font-size: 14px" class="mt-1">${item}</li>`
                        })
                        $(`.${key}`).html(content)
                    }
                }
            });
        });

        $('select').change(function(e) {
            e.preventDefault();
            let result = '';
            let action = $(this).attr('id');
            let id = $(this).val();

            if (action == "province") {
                result = "district"
                $('#ward').html('<option value="">-- Chọn xã/phường/thị trấn --</option>');
                $('#ward').niceSelect('update');
            } else {
                result = 'ward'
            }
            if (action != "ward") {
                $.ajax({
                    type: "post",
                    url: "{{ route('checkout-location') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        action,
                        id,
                    },
                    success: function(response) {
                        $('#' + result).html(response);
                        $('#' + result).niceSelect('update');
                    },
                    error: function(error) {
                        console.error(error);
                    }

                });
            } else {
                let pro = $('#province').val();
                let dis = $('#district').val();
                let war = $('#ward').val();
                $.ajax({
                    type: "post",
                    url: "{{ route('checkout-delivery') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        pro,
                        dis,
                        war
                    },
                    success: function(response) {
                        shipGlobal = response.m_fee_ship.replace(/,/g, "");
                        $('.delivery').text(response.m_fee_ship);
                        $('.total-price').text((totalGlobal * 1 + shipGlobal * 1 - couponGlobal)
                            .toLocaleString());
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
        });

        $('#check-coupon').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{ route('checkout-coupon') }}",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    if (!response.data) {
                        $('.error-coupon').text(response.message);
                    } else {
                        $('#coupon_id').val(response.coupon_id);
                        $('.success-coupon').text(response.message);
                        if (response.data.coupon_method == 1) {
                            $('.coupon').text(response.data.coupon_value + "%");
                            couponGlobal = totalGlobal * Number(response.data.coupon_value) / 100;
                            $('.total-price').text((totalGlobal * 1 + shipGlobal * 1 - couponGlobal)
                                .toLocaleString());
                        } else {
                            $('.coupon').text(response.data.coupon_value.toLocaleString());
                            if (couponGlobal > totalGlobal) {
                                couponGlobal = totalGlobal
                            } else {
                                couponGlobal = response.data.coupon_value;
                            }
                            $('.total-price').text((totalGlobal * 1 + shipGlobal * 1 - couponGlobal)
                                .toLocaleString());
                        }
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    </script>
@endpush
@push('styles')
    <style>
        .momo::before {
            top: 10px !important
        }

        .momo::after {
            top: 11.5px !important
        }
    </style>
@endpush
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
                                <h1 class="breadcrumb-title">THANH TOÁN</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">TRANG CHỦ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">THANH TOÁN</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- checkout main wrapper start -->
        <div class="checkout-page-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- Checkout Login Coupon Accordion Start -->
                        <div class="checkoutaccordion" id="checkOutAccordion">
                            @if (!Auth::check())
                                <div class="card">
                                    <h5>Đã có tài khoản? <span data-toggle="collapse" data-target="#logInaccordion"
                                            aria-expanded="false" class="collapsed">Click
                                            Nhấn vào đây để đăng nhập</span></h5>
                                    <div id="logInaccordion" class="collapse" data-parent="#checkOutAccordion"
                                        style="">
                                        <div class="card-body">
                                            <p>Nếu bạn đã từng mua hàng trước đây vui lòng đăng nhập tài khoản bên dưới. Nếu
                                                bạn là khách hàng mới vui lòng đăng ký tài khoản mới hoặc tiếp tục đặt hàng
                                                và thanh toán.</p>
                                            <div class="login-reg-form-wrap mt-20">
                                                <div class="row">
                                                    <div class="col-lg-10 mx-auto">
                                                        <div class="login-reg-form-wrap">
                                                            <h2>Đăng nhập</h2>
                                                            <form method="POST" action="{{ route('login') }}">
                                                                @csrf
                                                                <div class="single-input-item">
                                                                    <label for="">{{ __('Email     ') }}</label>
                                                                    <input class="@error('email') is-invalid @enderror"
                                                                        id="email" type="emai" name="email"
                                                                        value="{{ old('email') }}" autocomplete="email"
                                                                        autofocus placeholder="Email/Tên đăng nhập" />
                                                                    @error('email')
                                                                        <span class="invalid-feedback input-group-text"
                                                                            role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>

                                                                <div class="single-input-item">
                                                                    <label for="">{{ __('Mật khẩu ') }}</label>
                                                                    <input id="password" type="password"
                                                                        class="@error('password') is-invalid @enderror"
                                                                        name="password" autocomplete="current-password" /><i
                                                                        onclick="showPass()"
                                                                        style="margin-left: -30px; 
                                                                    cursor: pointer;"
                                                                        class="fa fa-eye"></i>
                                                                    @error('password')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                    @enderror
                                                                </div>
                                                                <div class="single-input-item">
                                                                    <div
                                                                        class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                                                        <div class="remember-meta">
                                                                            <div class="custom-control">
                                                                                <input style="width: 20px"
                                                                                    class="form-check-input" type="checkbox"
                                                                                    name="remember" id="remember"
                                                                                    {{ old('remember') ? 'checked' : '' }}>
                                                                                <label class="form-check-label"
                                                                                    for="rememberMe">{{ __('Ghi nhớ tài khoản!') }}</label>
                                                                            </div>
                                                                        </div>
                                                                        @if (Route::has('password.request'))
                                                                            <a href="{{ route('password.request') }}"
                                                                                class="forget-pwd">Quên mật khẩu</a>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                                                    <div class="single-input-item">
                                                                        <button type="submit" class="btn">
                                                                            {{ __('Đăng nhập') }}</button>
                                                                    </div>
                                                                    <p>Chưa có tài khoản? <a href="{{ route('register') }}"
                                                                            class="forget-pwd">Đăng ký</a></p>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            <div class="card">
                                <h5>Bạn đã có mã giảm giá? <span data-toggle="collapse" data-target="#couponaccordion">Nhấn
                                        vào đây để nhập mã</span></h5>
                                <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                                    <div class="card-body">
                                        <div class="cart-update-option">
                                            <div class="apply-coupon-wrapper">
                                                <form action="" method="post" id="check-coupon"
                                                    class="d-block d-md-flex">
                                                    @csrf
                                                    <input type="text" placeholder="Nhập mã giảm giá của bạn"
                                                        name="coupon_code" required />
                                                    <button class="btn btn-sqr" type="submit">Áp dụng mã giảm giá</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="text-danger mt-1">
                                            <strong class="error-coupon"></strong>
                                        </div>
                                        <div class="text-success mt-1">
                                            <strong class="success-coupon"></strong>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Checkout Login Coupon Accordion End -->
                    </div>
                </div>
                <div class="row">

                    <!-- Checkout Billing Details -->
                    <div class="col-md-6 float-left" style="width: 600px;">
                        <form id="form-checkout" method="POST">
                            @csrf
                            <input type="hidden" name="coupon_id" id="coupon_id">
                            <div class="checkout-billing-details-wrap">
                                <h4 class="checkout-title">Thông tin liên hệ</h4>
                                <div class="billing-form-wrap">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="single-input-item">
                                                <label for="m_name" class="required">Họ và tên</label>
                                                <input type="text" id="m_name" name="m_name"
                                                    placeholder="Nhập họ và tên"
                                                    value="{{ Auth::check() ? Auth::user()->name : '' }}" />
                                                <ul class="m_name text-danger">
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-input-item">
                                        <label for="email" class="required">Email</label>
                                        <input type="text" id="email" name="m_email" placeholder="Nhập email"
                                            value="{{ Auth::check() ? Auth::user()->email : '' }}" />
                                        <ul class="m_email text-danger">
                                        </ul>
                                    </div>

                                    <div class="single-input-item">
                                        <label for="com-name">Số điện thoại</label>
                                        <input type="text" id="com-name" name="m_phone"
                                            placeholder="Nhập số điện thoại"
                                            value="{{ Auth::check() ? Auth::user()->phone : '' }}" />
                                        <ul class="m_phone text-danger">
                                        </ul>
                                    </div>

                                    <div class="single-input-item">
                                        <label for="province" class="required">Tỉnh/Thành phố</label>
                                        <select name="province nice-select" id="province">
                                            <option value="">-- Chọn tỉnh/thành phố --</option>
                                            @foreach ($province as $key => $prov)
                                                <option value="{{ $prov->id }}">{{ $prov->_name }}</option>
                                            @endforeach
                                        </select>
                                        <ul class="province_nice-select pt-1 text-danger">
                                        </ul>
                                    </div>
                                    <div class="single-input-item">
                                        <label for="district" class="required">Quận/Huyện</label>
                                        <select name="district nice-select" id="district">
                                            <option value="">-- Chọn quận/huyện --</option>
                                        </select>
                                        <ul class="district_nice-select pt-1 text-danger">
                                        </ul>
                                    </div>
                                    <div class="single-input-item">
                                        <label for="ward" class="required">Xã phường</label>
                                        <select name="ward nice-select" id="ward">
                                            <option value="">-- Chọn xã/phường/thị trấn --</option>
                                        </select>
                                        <ul class="ward_nice-select pt-1 text-danger">
                                        </ul>
                                    </div>

                                    <div class="single-input-item">
                                        <label for="street-address" class="required mt-20">Tên đường, số nhà</label>
                                        <input type="text" id="street-address" name="m_address"
                                            placeholder="Nhập tên đường, số nhà" />
                                        <ul class="m_address text-danger">
                                        </ul>
                                    </div>

                                    <div class="single-input-item">
                                        <h5 class="text-center">Thông tin bổ sung</h5>
                                        <label for="m_note">Ghi chú đơn hàng của bạn</label>
                                        <textarea name="m_note" id="ordernote" cols="30" rows="3"
                                            placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn."></textarea>
                                        <ul class="m_note text-danger">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="summary-footer-area">
                                <button type="submit" class="btn btn-sqr checkout-submit">ĐẶT HÀNG</button>
                            </div>
                        </form>
                    </div>


                    <!-- Order Summary Details -->
                    <div class="col-md-6 float-right">
                        <div class="order-summary-details">
                            <h4 class="checkout-title">Đơn hàng của bạn</h4>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody class="checkout-content">
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Phí vận chuyển</td>
                                                <td><strong class="delivery">0</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Thuế</td>
                                                <td><strong class="tax"></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Giảm giá</td>
                                                <td><strong class="coupon">0</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Tổng tiền thanh toán</td>
                                                <td><strong class="total-price" data-price="0"></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cashon" name="paymentmethod" value="cash"
                                                    class="custom-control-input" checked />
                                                <label class="custom-control-label" for="cashon">Trả tiền mặt khi
                                                    nhận hàng</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="momo" name="paymentmethod" value="momo"
                                                    class="custom-control-input" />
                                                <label class="custom-control-label momo" for="momo">
                                                    <img class="method-icon"
                                                        src="https://frontend.tikicdn.com/_desktop-next/static/img/icons/checkout/icon-payment-method-momo.svg"
                                                        width="32" height="32" alt="icon">
                                                    Thanh toán MoMo
                                                </label>
                                            </div>
                                        </div>
                                        <form action="{{ route('momo-payment') }}" id="momo-payment" method="post">
                                            @csrf
                                            <input type="hidden" name="txnRef">
                                            <input type="hidden" name="total_momo" id="total_momo"
                                                value="{{ str_replace(',', '', Cart::total(0)) }}">
                                        </form>
                                    </div>
                                    <div class="single-payment-method">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="vnpay" name="paymentmethod" value="vnpay"
                                                    class="custom-control-input" />
                                                <label class="custom-control-label momo" for="vnpay">
                                                    <img class="method-icon"
                                                        src="https://frontend.tikicdn.com/_desktop-next/static/img/icons/checkout/icon-payment-method-vnpay.png"
                                                        width="32" height="32" alt="icon">
                                                    Thanh toán VNPay
                                                </label>
                                            </div>
                                        </div>
                                        <form action="{{ route('vnpay-payment') }}" method="post" id="vnpay-payment">
                                            @csrf
                                            <input type="hidden" name="txnRef">
                                            <input type="hidden" name="total_vnpay" id="total_vnpay"
                                                value="{{ str_replace(',', '', Cart::total(0)) }}">
                                            <input type="hidden" name="redirect">
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- checkout main wrapper end -->
    </main>
@endsection
