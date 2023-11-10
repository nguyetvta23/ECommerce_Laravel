@extends('Auth.layouts.master')
@section('title')
    Giỏ hàng
@endsection
@section('content')
    @push('scripts')
        <script>
            const renderCartTable = async () => {
                const response = await callApiCart();
                const {
                    data,
                    subtotal,
                    total,
                    tax,
                    totalNoTax
                } = response;
                if (data.length == 0) {
                    $('.empty-cart').show()
                    $('.section-bg-color').hide()
                } else {
                    $('.empty-cart').hide()
                    $('.section-bg-color').show()
                }
                let content = ``;
                for (let key in data) {
                    content += `<tr>
                                    <td class="pro-thumbnail"><a href="{{ url('chi-tiet-san-pham') }}/${data[key].options.slug}"><img class="img-fluid"
                                                src="{{ asset('uploads') }}/${data[key].options.image}"
                                                alt="Product" /></a></td>
                                    <td class="pro-title"><a href="{{ url('chi-tiet-san-pham') }}/${data[key].options.slug}">${data[key].name + ' - Size: ' + data[key].options.sizeName}</a></td>
                                    <td class="pro-price" id="price" data-price="${data[key].price}"><span>${data[key].price.toLocaleString('en-US')}</span></td>
                                    <td class="pro-quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="${data[key].qty}">
                                        </div>
                                    </td>
                                    <td class="pro-subtotal"><span>${(data[key].price * data[key].qty).toLocaleString('en-US') }</span></td>
                                    <td class="pro-remove" data-id="${key}"><a href="#"><i class="fa fa-trash-o"></i></a></td>
                                </tr>`
                }
                $('.cart-content').html(content);
                $('.subtotal-amount').text(subtotal)
                $('.total-amount').text(total)
                $('.tax').text(tax)

                $(".pro-qty").prepend('<span class="dec qtybtn">-</span>');
                $(".pro-qty").append('<span class="inc qtybtn">+</span>');
                $(".qtybtn").on("click", function() {
                    var $button = $(this);
                    var oldValue = $button.parent().find("input").val();
                    if ($button.hasClass("inc")) {
                        var newVal = parseFloat(oldValue) + 1;
                    } else {
                        // Don't allow decrementing below zero
                        if (oldValue > 0) {
                            var newVal = parseFloat(oldValue) - 1;
                        } else {
                            newVal = 0;
                        }
                    }
                    $button.parent().find("input").val(newVal);
                    $button.parent().parent().next().html(
                        `<span>${(newVal * $('#price').data('price')).toLocaleString()}</span>`)
                });

                $('.pro-remove').click(function(e) {
                    e.preventDefault();
                    let id = $(this).data('id');
                    $.ajax({
                        type: "delete",
                        url: `{{ url('api/cart') }}/${id}`,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log(response);
                            renderCart();
                            renderCartTable();
                            toastr.success('',
                                'Xóa giỏ hàng thành công')
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
            }
            renderCartTable();
            $('.cart-update').click(function(e) {
                e.preventDefault();
                $('.cart-content tr').each(function() {
                    let qty = $(this).children('.pro-quantity').children().children('input').val();
                    let id = $(this).children('.pro-remove').data('id');
                    $.ajax({
                        type: "post",
                        url: `{{ url('api/cart') }}/${id}`,
                        data: {
                            _method: "PUT",
                            _token: "{{ csrf_token() }}",
                            id,
                            qty,
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.isError) {
                                toastr.error(response.message)
                            } else {
                                toastr.success(response.message)
                            }
                            renderCart();
                            renderCartTable();
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                })
            });
        </script>
    @endpush
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area bg-img" data-bg="assets/Auth/img/banner/breadcrumb-banner.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap text-center">
                            <nav aria-label="breadcrumb">
                                <h1 class="breadcrumb-title">GIỎ HÀNG</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">TRANG CHỦ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">GIỎ HÀNG</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- cart main wrapper start -->
        <div class="cart-main-wrapper section-padding">
            <div class="container">
                <h5 class="title text-center empty-cart">Giỏ hàng trống!</h5>
                <div class="section-bg-color">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Cart Table Area -->
                            <div class="cart-table table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="pro-thumbnail">ẢNH SẢN PHẨM</th>
                                            <th class="pro-title">TÊN SẢN PHẨM</th>
                                            <th class="pro-price">GIÁ</th>
                                            <th class="pro-quantity">SỐ LƯỢNG</th>
                                            <th class="pro-subtotal">TỔNG TIỀN</th>
                                            <th class="pro-remove">XÓA</th>
                                        </tr>
                                    </thead>
                                    <tbody class="cart-content">

                                    </tbody>
                                </table>
                            </div>
                            <!-- Cart Update Option -->
                            <div class="cart-update-option d-block d-md-flex justify-content-between">
                                <div class="apply-coupon-wrapper">
                                </div>
                                <div class="cart-update">
                                    <a href="#" class="btn">CẬP NHẬT GIỎ HÀNG</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 ml-auto">
                            <!-- Cart Calculation Area -->
                            <div class="cart-calculator-wrapper">
                                <div class="cart-calculate-items">
                                    <h3>TỔNG TIỀN </h3>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <td>Tổng tiền hàng</td>
                                                <td class="subtotal-amount"></td>
                                            </tr>
                                            <tr>
                                                <td>Thuế</td>
                                                <td class="tax"></td>
                                            </tr>
                                            <tr class="total">
                                                <td>Tổng tiền thanh toán</td>
                                                <td class="total-amount"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <a href="{{ route('checkout') }}" class="btn d-block">Tiến hành thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- cart main wrapper end -->
    </main>
@endsection
