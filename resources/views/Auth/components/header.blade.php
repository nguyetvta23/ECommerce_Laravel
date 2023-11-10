<!-- Start Header Area -->
<header class="header-area">
    <!-- main header start -->
    <div class="main-header d-none d-lg-block">
        <!-- header top start -->
        <div class="header-top theme-bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="welcome-message">
                            <p>Chào mừng đến với cửa hàng Kingdom Sneakers</p>
                        </div>
                    </div>
                    <div class="col-lg-6 text-right">
                        <div class="header-top-settings">
                            <ul class="nav align-items-center justify-content-end">
                                <li class="curreny-wrap">
                                    Hotline: 0978261116
                                </li>
                                <li class="language">
                                    Email: kingdomsneakers80@gmail.com
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header top end -->

        <!-- header middle area start -->
        <div class="header-main-area sticky">
            <div class="container">
                <div class="row align-items-center position-relative">
                    <!-- start logo area -->
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="/">
                                <img src="{{ URL::asset('Auth/img/logo/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- start logo area -->

                    <!-- main menu area start -->
                    <div class="col-lg-8 position-static">
                        <div class="main-menu-area">
                            <div class="main-menu">
                                <!-- main menu navbar start -->
                                <nav class="desktop-menu" id="desktop-menu">
                                    <ul>
                                        <li ><a href="{{ route('home') }}">Trang chủ</a>
                                        </li>
                                        <li><a href="/product_list">Cửa hàng <i class="fa fa-angle-down"></i></a>

                                        <li><a href="javascript:void(0)">Danh mục <i class="fa fa-angle-down"></i> </a>
                                            <ul class="dropdown">
                                                @foreach ($categories as $category)
                                                <li><a href="{{ route('categoryProduct', ['id' => $category->id]) }}">{{ $category->m_title }}<i class="fa fa-angle-right"></i></a>
                                                    @if (count($category->children) > 0)
                                                    <ul class="dropdown">
                                                        @foreach ($category->children as $sub)
                                                        <li><a href="{{ route('categoryProduct', ['id' => $sub->id]) }}">{{ $sub->m_title }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('blog-list') }}">Tin tức</a>
                                        </li>
                                        <li><a href="{{ route('contact-auth') }}">Liên hệ</a></li>
                                        <li><a href="{{ route('about-us')}}">Về chúng tôi</a></li>
                                    </ul>
                                </nav>
                                <!-- main menu navbar end -->
                            </div>
                        </div>
                    </div>
                    <!-- main menu area end -->

                    <!-- mini cart area start -->
                    <div class="col-lg-2">
                        <div class="header-configure-wrapper">
                            <div class="header-configure-area">
                                <ul class="nav justify-content-end">
                                    <li>
                                        <a href="#" class="offcanvas-btn">
                                            <i class="ion-ios-search-strong"></i>
                                        </a>
                                    </li>
                                    <li class="user-hover">
                                        <a href="#">
                                            <i class="ion-ios-gear-outline"></i>
                                        </a>
                                        @if (Route::has('login'))
                                        @auth
                                        @if (Auth::user()->role == 1)
                                        <ul class="dropdown-list">
                                            <li><a href="{{ route('profile') }}">Tài khoản của bạn</a></li>
                                            <li><a href="{{ route('admintrator') }}">Chuyển admin</a></li>
                                            <!-- <li><a href="">Thông tin đơn hàng</a></li> -->
                                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Đăng
                                                    xuất</a></li>
                                            <form action="{{ route('logout') }}" method="post" id="logout-form">
                                                @csrf
                                            </form>
                                        </ul>
                                        @else
                                        <ul class="dropdown-list">
                                            <li><a href="{{route('profile')}}">Tài khoản của bạn</a></li>
                                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Đăng
                                                    xuất</a></li>
                                            <form action="{{ route('logout') }}" method="post" id="logout-form">
                                                @csrf
                                            </form>
                                        </ul>
                                        @endif
                                        @else
                                        <ul class="dropdown-list">
                                            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                            <li><a href="{{ route('register') }}">đăng ký</a></li>
                                        </ul>
                                        @endif
                                        @endif
                                    </li>
                                    <li>
                                        <a href="#" class="minicart-btn">
                                            <i class="ion-bag"></i>
                                            <div class="notification"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- mini cart area end -->
                </div>
            </div>

        </div>
        <!-- header middle area end -->
    </div>
    <!-- main header start -->

    <!-- mobile header start -->
    <div class="mobile-header d-lg-none d-md-block sticky">
        <!--mobile header top start -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="mobile-main-header">
                        <div class="mobile-logo">
                            <a href="index.html">
                                <img src="{{ URL::asset('Auth/img/logo/logo.png') }}" alt="Brand Logo">
                            </a>
                        </div>
                        <div class="mobile-menu-toggler">
                            <div class="mini-cart-wrap">
                                <a href="cart.html">
                                    <i class="ion-bag"></i>
                                </a>
                            </div>
                            <div class="mobile-menu-btn">
                                <div class="off-canvas-btn">
                                    <i class="ion-navicon"></i>
                                </div>
                            </div>
                        </div>
                        <!-- main menu area end -->

                        <!-- mini cart area start -->
                        <div class="col-lg-2">
                            <div class="header-configure-wrapper">
                                <div class="header-configure-area">
                                    <ul class="nav justify-content-end">
                                        <li>
                                            <a href="#" class="offcanvas-btn">
                                                <i class="ion-ios-search-strong"></i>
                                            </a>
                                        </li>
                                        <li class="user-hover">
                                            <a href="#">
                                                <i class="ion-ios-gear-outline"></i>
                                            </a>
                                            @if (Route::has('login'))
                                                @auth
                                                    @if (Auth::user()->role == 1)
                                                        <ul class="dropdown-list">
                                                            <li><a href="{{ route('admintrator') }}">chuyển admin</a></li>
                                                            <!-- <li><a href="">Thông tin đơn hàng</a></li> -->
                                                            <li><a href="{{ route('logout') }}"
                                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Đăng
                                                                    xuất</a></li>
                                                            <form action="{{ route('logout') }}" method="post"
                                                                id="logout-form">
                                                                @csrf
                                                            </form>
                                                        </ul>
                                                    @else
                                                        <ul class="dropdown-list">
                                                            <li><a href="/profile">Tài khoản</a></li>
                                                            <li><a href="">Thông tin Đơn hàng</a></li>
                                                            <li><a href="{{ route('logout') }}"
                                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Đăng
                                                                    xuất</a></li>
                                                            <form action="{{ route('logout') }}" method="post"
                                                                id="logout-form">
                                                                @csrf
                                                            </form>
                                                        </ul>
                                                    @endif
                                                @else
                                                    <ul class="dropdown-list">
                                                        <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                                        <li><a href="{{ route('register') }}">đăng ký</a></li>
                                                    </ul>
                                                @endif
                                                @endif
                                            </li>
                                            <li>
                                                <a href="#" class="minicart-btn">
                                                    <i class="ion-bag"></i>
                                                    <div class="notification"></div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- mini cart area end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile header top start -->
    </div>
    <!-- mobile header end -->
</header>
<!-- end Header Area -->

<!-- off-canvas menu start -->
<aside class="off-canvas-wrapper">
    <div class="off-canvas-overlay"></div>
    <div class="off-canvas-inner-content">
        <div class="btn-close-off-canvas">
            <i class="ion-android-close"></i>
        </div>

        <div class="off-canvas-inner">
            <!-- search box start -->
            <div class="search-box-offcanvas">
                <form>
                    <input type="text" placeholder="Tìm kiếm">
                    <button class="search-btn"><i class="ion-ios-search-strong"></i></button>
                </form>
            </div>
            <!-- search box end -->

            <!-- mobile menu start -->
            <div class="mobile-navigation">
                <!-- mobile menu navigation start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children"><a href="{{route('home')}}">Trang chủ</a>
                        </li>
                        <li class="menu-item-has-children"><a href="#">Cửa hàng</a></a>
                            <ul class="megamenu dropdown">
                                <li class="mega-title menu-item-has-children"><a href="#">column 01</a>
                                    <ul class="dropdown">
                                        <li><a href="shop.html">shop grid left
                                                sidebar</a></li>
                                        <li><a href="shop-grid-right-sidebar.html">shop grid right
                                                sidebar</a></li>
                                        <li><a href="shop-list-left-sidebar.html">shop list left sidebar</a></li>
                                        <li><a href="shop-list-right-sidebar.html">shop list right sidebar</a></li>
                                    </ul>
                                </li>
                                <li class="mega-title menu-item-has-children"><a href="#">column 02</a>
                                    <ul class="dropdown">
                                        <li><a href="product-details.html">product details</a></li>
                                        <li><a href="product-details-affiliate.html">product
                                                details
                                                affiliate</a></li>
                                        <li><a href="product-details-variable.html">product details
                                                variable</a></li>
                                        <li><a href="product-details-group.html">product details
                                                group</a></li>
                                    </ul>
                                </li>
                                <li class="mega-title menu-item-has-children"><a href="#">column 03</a>
                                    <ul class="dropdown">
                                        <li><a href="cart.html">cart</a></li>
                                        <li><a href="checkout.html">checkout</a></li>
                                        <li><a href="compare.html">compare</a></li>
                                        <li><a href="wishlist.html">wishlist</a></li>
                                    </ul>
                                </li>
                                <li class="mega-title menu-item-has-children"><a href="#">column 04</a>
                                    <ul class="dropdown">
                                        <li><a href="my-account.html">Tài khoản</a></li>
                                        <li><a href="login-register.html">login-register</a></li>
                                        <li><a href="contact-us.html">contact us</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children "><a href="">Tin tức</a>
                        </li>
                        <li class="menu-item-has-children "><a href="">Liên hệ</a>
                        </li>
                        <li><a href="">Về chúng tôi</a></li>
                    </ul>
                </nav>
                <!-- mobile menu navigation end -->
            </div>
            <!-- mobile menu end -->

            <!-- user setting option start -->
            <div class="mobile-settings">
                <ul class="nav">
                    <li>
                        <div class="dropdown mobile-top-dropdown">
                            <a href="#" class="dropdown-toggle" id="myaccount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Tài khoản
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="myaccount">
                                <a class="dropdown-item" href="/profile">Tài khoản</a>
                                <a class="dropdown-item" href="/login">Đăng nhập</a>
                                <a class="dropdown-item" href="/register">Đăng ký</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- user setting option end -->

            <!-- offcanvas widget area start -->
            <div class="offcanvas-widget-area">
                <div class="off-canvas-contact-widget">
                    <ul>
                        <li><i class="fa fa-mobile"></i>
                            <a href="#">0123456789</a>
                        </li>
                        <li><i class="fa fa-envelope-o"></i>
                            <a href="#">kingdomsneakers80@gmail.com</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- offcanvas widget area end -->
        </div>
    </div>
</aside>