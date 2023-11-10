@extends('Auth.layouts.master')
@section('title')
    Liên hệ
@endsection
@section('content')
        <!-- main wrapper start -->
        <main>
            <!-- breadcrumb area start -->
            <div class="breadcrumb-area bg-img" data-bg="assets/img/banner/breadcrumb-banner.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="breadcrumb-wrap text-center">
                                <nav aria-label="breadcrumb">
                                    <h1 class="breadcrumb-title">Liên hệ</h1>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb area end -->
    
            <!-- contact wrapper area start -->
            <div class="contact-area section-padding">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="contact-message">
                                <h2 class="contact-title">Để lại lời nhắn</h2>
                                <form id="contact-form" action="https://htmldemo.net/juan/juan/assets/php/mail.php" method="post" class="contact-form">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <input name="email_address" placeholder="Email *" type="text" required>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                            <input name="phone" placeholder="Số điện thoại *" type="text" required>
                                        </div>
                                        <div class="col-12">
                                            <div class="contact2-textarea text-center">
                                                <textarea placeholder="Nội dung *" name="message" class="form-control2" required=""></textarea>
                                            </div>
                                            <div class="contact-btn">
                                                <button class="btn" type="submit">Gửi</button>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <p class="form-messege"></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-info pt-0">
                                <h2 class="contact-title">contact us</h2>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4494440061744!2d106.62649791432106!3d10.853380092269354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752bee0b0ef9e5%3A0x5b4da59e47aa97a8!2zQ8O0bmcgVmnDqm4gUGjhuqduIE3hu4FtIFF1YW5nIFRydW5n!5e0!3m2!1svi!2s!4v1653369213468!5m2!1svi!2s"
                                width="600" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                <ul>
                                    <li><i class="fa fa-map-marker"></i> Địa chỉ: Tòa nhà Innovation - Lô 24 Công viên phần mềm Quang Trung, P. Tân Chánh Hiệp, Q. 12, Tp. Hồ Chí Minh</li>
                                    <li><i class="fa fa-phone"></i> 097xxxxxxxx </li>
                                    <li><i class="fa fa-envelope-o"></i> kingdomsneakers@gmail.com</li>
                                </ul>
                                <div class="working-time">
                                    <h3>Giờ làm việc</h3>
                                    <p class="pb-0"><span>Thứ 2 – Chủ nhật:</span>08AM – 22PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- contact wrapper area end -->
        </main>
        <!-- main wrapper end -->
@endsection