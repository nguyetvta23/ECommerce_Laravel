@push('scriptsPrev')
    <script>
        const callApiCart = async () => {
            return await $.ajax({
                type: "get",
                url: "{{ url('api/cart') }}",
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        const renderCart = async () => {
            const response = await callApiCart();
            const {
                data,
                subtotal,
                count,
            } = response;
            if (data.length == 0) {
                $('.minicart-content-box').hide();
                $('.minicart-inner-content .empty-cart').show();
            } else {
                $('.minicart-content-box').show();
                $('.minicart-inner-content .empty-cart').hide();
            }
            let content = ``;
            for (let key in data) {
                content += `<li class="minicart-item">
                            <div class="minicart-thumb">
                                <a href="{{ url('chi-tiet-san-pham') }}/${data[key].options.slug}">
                                    <img src="{{ asset('uploads') }}/${data[key].options.image}" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h3 class="product-name">
                                    <a href="{{ url('chi-tiet-san-pham') }}/${data[key].options.slug}">${data[key].name + ' - Size: ' + data[key].options.sizeName}</a>
                                </h3>
                                <p>
                                    <span class="cart-quantity">${data[key].qty}<strong>&times;</strong></span>
                                    <span class="cart-price">${data[key].price.toLocaleString()}</span>
                                </p>
                            </div>
                            <button class="minicart-remove" data-id="${data[key].rowId}"><i class="ion-android-close"></i></button>
                        </li>`
            }
            $('.minicart-list').html(content);
            $('.total-price').text(subtotal);
            $('.total-all').text(subtotal);
            $('.notification').text(count)

            $('.minicart-remove').click(function(e) {
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
                        toastr.success('',
                            'Xóa giỏ hàng thành công')
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        }
        renderCart()
    </script>
@endpush
<!-- Start Footer Area Wrapper -->
<footer class="footer-wrapper">
    <!-- footer main area start -->
    <div class="footer-widget-area section-padding">
        <div class="container">
            <div class="row mtn-40">
                <!-- footer widget item start -->
                <div class="col-xl-5 col-lg-3 col-md-6">
                    <div class="widget-item mt-40">
                        <h5 class="widget-title">Liên hệ</h5>
                        <div class="widget-body">
                            <ul class="location-wrap">
                                <li><i class="ion-ios-location-outline"></i>Tòa nhà Innovation - Lô 24 Công viên phần mềm
                                    Quang Trung,
                                    P. Tân Chánh Hiệp, Q. 12, Tp. Hồ Chí Minh</li>
                                <li><i class="ion-ios-email-outline"></i>Email: <a
                                        href="mailto:yourmail@gmail.com">kingdomsneakers08@gmail.com</a></li>
                                <li><i class="ion-ios-telephone-outline"></i>Số điện thoại: <a
                                        href="%2b0025425456554.html">0978261116</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- footer widget item end -->

                <!-- footer widget item start -->
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="widget-item mt-40">
                        <h5 class="widget-title">Hạng Mục</h5>
                        <div class="widget-body">
                            <ul class="useful-link">
                                <!-- <li><a href="#">Ecommerce</a></li> -->
                                <li><a href="/product_list">Cửa hàng</a></li>
                                <li><a href="/profile">Tài khoản</a></li>
                                <li><a href="{{ route('list-favourite') }}">Sản phẩm yêu thích</a></li>

                                <li><a href="{{ route('blog-list') }}">Tin tức</a></li>
                                <li><a href="{{ route('tuyendung') }}">Tuyển dụng</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- footer widget item end -->

                <!-- footer widget item start -->
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <div class="widget-item mt-40">
                        <h5 class="widget-title">Thông Tin</h5>
                        <div class="widget-body">
                            <ul class="useful-link">
                                <li><a href="/">Trang chủ</a></li>
                                <li><a href="#">Giới thiệu</a></li>
                                <li><a href="{{ route('hdsize') }}">Hướng dẫn chọn size</a></li>
                                <li><a href="{{ route('chinhsachdoitra') }}">Chính Sách Đổi Trả</a></li>

                                <li><a href="{{ route('baomat') }}">Chính Sách Bảo Mật</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- footer widget item end -->

                <!-- footer widget item start -->
                <!-- <div class="col-xl-2 col-lg-3 offset-xl-1 col-md-6">
                    <div class="widget-item mt-40">
                        <h5 class="widget-title">Liên hệ</h5>
                        <div class="widget-body">
                            <ul class="useful-link">
                               
                                
                                
                                

                            </ul>
                        </div>
                    </div>
                </div> -->
                <!-- footer widget item end -->
            </div>
        </div>
    </div>
    <!-- footer main area end -->

    <!-- footer bottom area start -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-2 order-md-1">
                    <div class="copyright-text text-center text-md-left">
                        <p>&copy; 2022 <b>Phát triển</b> Bởi <a href="https://hasthemes.com/"><b>Kingdom Sneakers
                                    Team</b></a></p>
                    </div>
                </div>
                <!-- <div class="col-md-6 order-1 order-md-2">
                    <div class="footer-social-link text-center text-md-right">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <!-- footer bottom area end -->
</footer>
<!-- End Footer Area Wrapper -->

<!-- offcanvas search form start -->
<div class="offcanvas-search-wrapper">
    <div class="offcanvas-search-inner">
        <div class="offcanvas-close">
            <i class="ion-android-close"></i>
        </div>
        <div class="container">
            <div class="offcanvas-search-box">
                <form class="d-flex bdr-bottom w-100" action="{{ route('search') }}" method="get">
                    @csrf
                    <input type="text" name="keywork" placeholder="Tìm kiếm ...">
                    <button class="search-btn"><i class="ion-ios-search-strong"></i>Tìm kiếm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas search form end -->

<!-- offcanvas mini cart start -->
<div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <h5 class="title text-center empty-cart">Giỏ hàng trống!</h5>
            <div class="minicart-close">
                <i class="ion-android-close"></i>
            </div>
            <div class="minicart-content-box">
                <div class="minicart-item-wrapper">
                    <ul class="minicart-list">

                    </ul>
                </div>

                <div class="minicart-pricing-box">
                    <ul>
                        <li>
                            <span>Tổng</span>
                            <span><strong class="total-price"></strong></span>
                        </li>
                        <li class="total">
                            <span>Thành tiền</span>
                            <span><strong class="total-all"></strong></span>
                        </li>
                    </ul>
                </div>

                <div class="minicart-button">
                    <a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i>Giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas mini cart end -->
<!-- Scroll to top start -->
<div class="scroll-top not-visible">
    <i class="fa fa-angle-up"></i>
</div>
<!-- Scroll to Top End -->
