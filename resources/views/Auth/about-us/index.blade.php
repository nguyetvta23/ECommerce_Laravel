@extends('Auth.layouts.master')
@section('title')
    Về chúng tôi
@endsection
@push('styles')
    
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('Auth/about-us/assets/css/style.css')}}">

@endpush
@section('content')
<!-- breadcrumb area start -->
<div class="breadcrumb-area bg-img" data-bg="assets/img/banner/breadcrumb-banner.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap text-center">
                    <nav aria-label="breadcrumb">
                        <h1 class="breadcrumb-title">Về chúng tôi</h1>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Về chúng tôi</li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->
    <main>
        <!-- Repair-make-area Start -->
        <div class="repair-make-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="repair-service-inner">
                            <h3>Kingdom Sneakers</h3>
                            <h2>Giày và phụ kiện <br> chính hãng</h2>
                            <p> Kingdom Sneakers là hệ thống cửa hàng cung cấp các sản phẩm Giày bóng đá chính hãng NIKE, ADIDAS, PUMA, MIZUNO, ASICS, KAMITO...Tất cả sản phẩm
                                đều được nhập khẩu từ các nhà phân phối chính hãng tại Việt Nam với tem, nhãn, hộp đầy đủ.</p>
                            <div class="make-apoinment-button">
                                <a href="/product_list" class="default-btn border-radius">Xem ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="repair-image pt--30">
                            <img src="{{asset('Auth/about-us/assets/images/banner/banner-01.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team -->
        <section id="team" class="pb-5">
            <div class="container">
                <h5 class="section-title h2">Về Kingdom Sneakers</h5>
                <div class="row">
                    <!-- Team member -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" >
                            <div class="mainflip flip-0">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <p><img class=" img-fluid" src="{{asset('Auth/about-us/assets/images/team/vo-thi-anh-nguyet.jpg')}}" alt="card image"></p> <br>
                                            <h4 class="card-title">Võ Thị Ánh Nguyệt</h4>
                                            <p class="card-text">PS11782 - Thành viên</p> <br>
                                            <a href="" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="backside">
                                    <div class="card">
                                        <div class="card-body text-center mt-4">
                                            <h4 class="card-title">Về Ánh Nguyệt</h4>
                                            <p class="card-text">
                                                Là một trong 2 thành viên nữ của nhóm, Nguyệt luôn dùng sự tích cực và nhiệt tình của bản thân để kéo các thành viên gần lại với nhau. 
                                                Ở mỗi cuộc họp, Nguyệt đảm nhận vị trí báo cáo và nói nhiều nhất nhóm! <br>
                                                <span class="text-success"> "Chúc Nguyệt luôn giữ được sự tích cực và nhiệt tình của bản thân mình nhé!"</span>
                                            </p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.facebook.com/nguyet.vo.2310">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-skype"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-google"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./Team member -->
                    <!-- Team member -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <p><img class=" img-fluid" src="{{asset('Auth/about-us/assets/images/team/nguyen-thanh-duc.jpg')}}" alt="card image"></p> <br>
                                            <h4 class="card-title">Nguyễn Thành Đức</h4>
                                            <p class="card-text">PS14316 - Trưởng nhóm</p> <br>
                                            <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="backside">
                                    <div class="card">
                                        <div class="card-body text-center mt-4">
                                            <h4 class="card-title">Về Nguyễn Thành Đức</h4>
                                            <p class="card-text">
                                                Với kiến thức về lập trình tốt, Đức luôn là kim chỉ nam của cả nhóm khi gặp những vấn đề khó khăn về kĩ thuật. Trưởng nhóm luôn là 
                                                người kiên nhẫn hỗ trợ các bạn fix bug và chia sẻ những kinh nghiệm của bản thân
                                                <span class="text-success">"Chúc Đức trở thành một senior trong lĩnh vực đã chọn và chinh phục thành công tất cả ngọn núi nhé!"</span>
                                            </p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-skype"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-google"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./Team member -->
                    <!-- Team member -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <p><img class=" img-fluid" src="{{asset('Auth/about-us/assets/images/team/nguyen-thi-hoang-yen.jpg')}}" alt="card image"></p> <br>
                                            <h4 class="card-title">Nguyễn Thị Hoàng Yến</h4>
                                            <p class="card-text">PS11064 - Thành viên</p> <br>
                                            <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="backside">
                                    <div class="card">
                                        <div class="card-body text-center mt-4">
                                            <h4 class="card-title">Về Hoàng Yến</h4>
                                            <p class="card-text">
                                                Yến là thành viên nữ thứ hai của nhóm, luôn là người nhẹ nhàng lắng nghe nhóm và âm thầm hoàn thành các nhiệm vụ của bản thân và kiểm tra tỉ mĩ những lỗi nhỏ của website.
                                                Ở mỗi cuộc họp Yến đều có mặt, yên lặng lắng nghe mọi người. <br>
                                            <span class="text-success">"Chúc Yến thành công trong tất cả khía cạnh cuộc sống và luôn vui vẻ nhé!"</span>                                            </p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-skype"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-google"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./Team member -->
                    <!-- Team member -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <p><img class=" img-fluid" src="{{asset('Auth/about-us/assets/images/team/pham-thanh-khuong.jpg')}}" alt="card image"></p> <br>
                                            <h4 class="card-title">Phạm Thanh Khương</h4>
                                            <p class="card-text">PS14734 - Thành viên</p> <br>
                                            <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="backside">
                                    <div class="card">
                                        <div class="card-body text-center mt-4">
                                            <h4 class="card-title">Về Thanh Khương</h4>
                                            <p class="card-text">
                                                Khương là chàng trai có chất nghệ sĩ, có khiếu thẩm mĩ và luôn hăng hái trong mọi hoạt động của nhóm. Quan tâm những điều nhỏ của nhóm và 
                                                hỗ trợ các thành viên trong nhiều khía cạnh khác nhau. <br>
                                                <span class="text-success">"Chúc Khương tìm được hướng đi đúng với đam mê của bản thân và phát triển vượt bật!"</span>
                                            </p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-skype"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-google"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./Team member -->
                    <!-- Team member -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <p><img class=" img-fluid" src="{{asset('Auth/about-us/assets/images/team/nguyen-le-thanh-dat.jpg')}}" alt="card image"></p> <br>
                                            <h4 class="card-title">Nguyễn Lê Thành Đạt</h4>
                                            <p class="card-text">PS13413 - Thành viên</p> <br>
                                            <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="backside">
                                    <div class="card">
                                        <div class="card-body text-center mt-4">
                                            <h4 class="card-title">Về Thành Đạt</h4>
                                            <p class="card-text">
                                                Đạt là thành viên hăng hái và nhiệt tình, luôn có mặt khi mọi người cần. Với tài ngoại giao tốt, Đạt và Đức là người 
                                                tìm hiểu những công nghệ mang tính định hướng ngay từ đầu để vạch ra hướng đi của nhóm. <br>
                                                <span class="text-success">"Hi vọng Đạt giữ sức khỏe để có sức phát triển vượt bật trong ngành IT đã chọn!" </span>
                                            </p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-skype"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-google"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./Team member -->
                    <!-- Team member -->
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                            <div class="mainflip">
                                <div class="frontside">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <p><img class=" img-fluid" src="{{asset('Auth/about-us/assets/images/team/pham-tien-thuong.jpg')}}" alt="card image"></p> <br>
                                            <h4 class="card-title">Phạm Tiền Thưởng</h4>
                                            <p class="card-text">PS11578 - Thành viên</p> <br>
                                            <a href="https://www.fiverr.com/share/qb8D02" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="backside">
                                    <div class="card">
                                        <div class="card-body text-center mt-4">
                                            <h4 class="card-title">Về Tiền Thưởng</h4>
                                            <p class="card-text">
                                                Chàng trai bí ẩn của nhóm! Tuy chỉ nghe tiếng, không thấy mặt nhưng vẫn luôn họp đầy đủ 
                                                cùng các thành viên. Luôn cố gắng hoàn thành nhiệm vụ được giao và luôn nhẹ nhàng với mọi người. Nhiệt tình lên bạn tôi!!
                                                <span class="text-success">"Chúc Tiền Thưởng thành công trong cuộc sống và phát triển ở lĩnh vực đã chọn nha!"</span>
                                            </p>
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-skype"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a class="social-icon text-xs-center" target="_blank" href="https://www.fiverr.com/share/qb8D02">
                                                        <i class="fa fa-google"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./Team member -->

                </div>
            </div>
        </section>
        <!-- Team -->
        <!-- FAQ area Start -->
        <div class="faq-area section-ptb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h4>Câu hỏi thường gặp?</h4>
                            <h2>FAQ</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <!-- single-faq Start -->
                        <div class="single-faq text-center">
                            <div class="title-content">
                                <h4>Chính sách đổi trả hàng của Kingdom Sneakers như thế nào?</h4>
                                <i class="icofont-question"></i>
                            </div>
                            <p>Chúng tôi có quy định chi tiết và rõ ràng về đổi trả hàng để quý khách an tâm mua sắm, quý khách hàng có thể tham khảo <a href="{{route('chinhsachdoitra')}}">Tại đây!</a></p>
                        </div>
                        <!-- single-faq Start -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <!-- single-faq Start -->
                        <div class="single-faq text-center">
                            <div class="title-content">
                                <h4>Tôi muốn biết cách lựa chọn size giày khi mua online như thế nào?</h4>
                                <i class="icofont-question"></i>
                            </div>
                            <p>Để thuận tiện mua sắm online, chúng tôi có những hướng dẫn chi tiết về cách thức lựa chọn size, quý khách có thể 
                                tham khảo <a href="{{route('hdsize')}}">Tại đây!</a>
                            </p>
                        </div>
                        <!-- single-faq Start -->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <!-- single-faq Start -->
                        <div class="single-faq text-center">
                            <div class="title-content">
                                <h4>Cách thức thanh toán online tại cửa hàng như thế nào?</h4>
                                <i class="icofont-question"></i>
                            </div>
                            <p>
                                Cửa hàng Kingdom Sneakers cung cấp nhiều cách thức thanh toán khi mua hàng online, để biết thêm chi tiết, quý khách vui lòng tham khảo <a href="{{route('baomat')}}">Tại đây!</a>
                            </p>
                        </div>
                        <!-- single-faq Start -->
                    </div>
                </div>
            </div>
        </div>
        <!-- FAQ area End -->
    
    <!-- Repair-make-area End -->
    </main>
@endsection
@push('scripts')
    <!-- jQuery JS -->
    <script src="{{asset('Auth/about-us/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <!-- Popper JS -->
    <script src="{{asset('Auth/about-us/assets/js/popper.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('Auth/about-us/assets/js/bootstrap.min.js')}}"></script>
    <!-- Plugins JS -->
    <script src="{{asset('Auth/about-us/assets/js/plugins.js')}}"></script>
    <!-- Ajax Mail -->
    <script src="assets/js/ajax-mail.js"></script>
    <!-- Main JS -->
    {{-- <script src="{{asset('Auth/about-us/assets/js/main.js')}}"></script> --}}

@endpush