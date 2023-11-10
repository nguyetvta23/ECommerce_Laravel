@extends('Auth.layouts.master')
@section('title')
Liên hệ
@endsection
@section('content')
<style>
    .panel-heading #myModalLabel:before {
        content: "";
        position: absolute;
        width: 40px;
        height: 3px;
        bottom: 0;
        left: 50%;
        margin-left: -20px;
        background: #ed1c24;
    }

    #newsletter-footer .signup #txtemail {
        border-radius: 20px 0 0 20px;
        background: #FFF;
        border: 1px solid #e1e1e1;
        height: 40px;
        padding-left: 20px;
        padding-right: 20px;
        font-size: 14px;
    }
    
#newsletter-footer .signup .input-group-btn .btn:hover {
    background: #222;
}
#newsletter-footer .signup .input-group-btn .btn {
    text-transform: uppercase;
    font-size: 14px;
    font-weight: bold;
    border-radius: 0 20px 20px 0;
    padding-left: 30px;
    padding-right: 30px;
    height: 40px;
    -webkit-transition: ease all .4s;
    -o-transition: ease all .4s;
    transition: ease all .4s;
}

</style>
<!-- main wrapper start -->
<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area bg-img" data-bg="assets/img/banner/breadcrumb-banner.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap text-center">
                        <nav aria-label="breadcrumb">
                            <h1 class="breadcrumb-title">TUYỂN DỤNG</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tuyển dụng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2>NHÂN VIÊN BÁN HÀNG</h2><br>
                    <div class="col-sm-4 col-md-3 pl-0"> Mô tả công việc </div>
                    <div class="col-sm-8 col-md-9">
                        <p><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif"><span style="line-height:150%">-<span style="font-stretch:normal; font-style:normal; font-variant:normal; font-weight:normal; line-height:normal">&nbsp;&nbsp;</span></span><span style="line-height:150%">Tư vấn sản phẩm cho khách, hỗ trợ khách thử sản phẩm</span></span><span style="font-family:Arial,Helvetica,sans-serif"><span style="line-height:150%"></span></span><span style="font-family:Arial,Helvetica,sans-serif"><span style="line-height:150%"><br> -<span style="font-stretch:normal; font-style:normal; font-variant:normal; font-weight:normal; line-height:normal">&nbsp;&nbsp;</span></span><span style="line-height:150%">Kiểm kê kho, đóng gói sản phẩm</span></span><span style="font-family:Arial,Helvetica,sans-serif"><span style="line-height:150%"></span></span><span style="font-family:Arial,Helvetica,sans-serif"><span style="line-height:150%"><br> -<span style="font-stretch:normal; font-style:normal; font-variant:normal; font-weight:normal; line-height:normal">&nbsp;&nbsp;</span></span><span style="line-height:150%">Sắp xếp, trưng bày sản phẩm</span></span><span style="font-family:Arial,Helvetica,sans-serif"><span style="line-height:150%"></span></span><span style="font-family:Arial,Helvetica,sans-serif"><span style="line-height:150%"><br> -<span style="font-stretch:normal; font-style:normal; font-variant:normal; font-weight:normal; line-height:normal">&nbsp;&nbsp;</span></span><span style="line-height:150%">Vệ sinh cửa hàng</span></span></span></p>
                    </div>
                    <hr>
                    <div class="col-sm-4 col-md-3 pl-0"> Quyền lợi được hưởng </div>
                    <div class="col-sm-8 col-md-9">
                        <p><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif"><span style="line-height:150%"><strong>MỨC LƯƠNG &amp; QUYỀN LỢI</strong><br> -&nbsp;&nbsp; &nbsp;Lương từ <strong>5.000.000</strong> đến <strong>6.000.000</strong><br> -&nbsp;&nbsp; &nbsp;Được thưởng chuyên cần hàng tháng, thưởng theo doanh thu cửa hàng, thưởng lễ, tết<br> -&nbsp;&nbsp; &nbsp;Được tham gia các khóa đào tạo nhằm nâng cao nghiệp vụ bán hàng, quản lý nhân viên<br> -&nbsp;&nbsp; &nbsp;Có cơ hội thăng tiến lên Ca trưởng, Giám sát</span></span></span></p>
                        <p><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif"><span style="line-height:150%"><br> <strong>THỜI GIAN VÀ ĐỊA ĐIỂM LÀM VIỆC</strong><br> -&nbsp;&nbsp; &nbsp; Làm việc theo ca xoay: + &nbsp;Ca sáng : <strong>8h30 - 15h30</strong><br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + &nbsp;Ca chiều: <strong>15h00 -&nbsp;22h00</strong><br> -&nbsp;&nbsp; &nbsp;Được nghỉ 2 ngày/ tháng,&nbsp;<br> -&nbsp;&nbsp; &nbsp;Sau 2 tháng thử việc, nhân viên bán hàng sẽ có 8 ngày phép/năm.<br> -&nbsp;&nbsp; &nbsp;Có thể đăng kí một trong các cửa hàng làm việc ở các quận sau đây: <strong>Quận 11, Quận Tân Bình, Quận Gò Vấp, Quận Phú Nhuận.</strong></span></span></span><span style="line-height:150%"></span></p>
                    </div>
                    <hr>
                    <div class="col-sm-4 col-md-3 pl-0"> Yêu cầu khác </div>
                    <div class="col-sm-8 col-md-9">
                        <p><span style="font-size:12px"><span style="font-family:Arial,Helvetica,sans-serif"><strong><span style="line-height:150%"></span></strong></span></span></p>
                        <p><strong><span style="font-size:13.0pt; line-height:150%; mso-ansi-language:EN-US; mso-bidi-font-family:Arial; mso-bidi-theme-font:minor-latin"></span></strong><span style="font-size:13.0pt; line-height:150%; mso-ansi-language:EN-US; mso-bidi-font-family:Arial; mso-bidi-theme-font:minor-latin"></span><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif"><span style="line-height:150%"><strong>YÊU CẦU CÔNG VIỆC</strong><br> -&nbsp;&nbsp; &nbsp;Độ tuổi: 18 đến 25 tuổi<br> -&nbsp;&nbsp; &nbsp;Giới tính: Nữ<br> -&nbsp;&nbsp; &nbsp;Ưu tiên rảnh toàn thời gian, có thể làm việc xoay ca<br> -&nbsp;&nbsp; &nbsp;Giọng nói dễ nghe<br> -&nbsp;&nbsp; &nbsp;Siêng năng, trung thực, có tinh thần học hỏi, cầu tiến<br> -&nbsp;&nbsp; &nbsp;Có trách nhiệm với công việc</span></span></span></p>
                        <p><span style="font-size:14px"><span style="font-family:Arial,Helvetica,sans-serif"><span style="line-height:150%"><br> <strong>THÔNG TIN LIÊN HỆ</strong><br> <strong>Công ty TNHH Phân Phối và Phát Triển Thương Mại Đăng Khoa</strong><br> <strong>Địa chỉ:</strong> 44 – 46 Hoàng Văn Thụ, phường 9, quận Phú Nhuận, TP.HCM<br> <strong>Email:</strong> <em>tuyendung@drake.vn</em><br> <strong>Điện thoại:</strong>&nbsp;<strong><a href="tel:02838896666" style="color: red;">0283.889.6666 </a></strong></span></span></span></p>
                    </div>
                    <hr>
                    <div class="col-sm-4 col-md-3 pl-0"> Mức lương </div>
                    <div class="col-sm-8 col-md-9">
                        <div class="money" style="    font-size: 20px;color: #2e42ae;font-weight: 500;"> 5.000.000 VNĐ ~ 6.000.000 VNĐ </div>
                    </div>
                    <hr>
                    <div class="panel panel-default panel-form " style="text-align: center; margin-top:50px;" role="document">
                        <div class="panel-heading" style="margin-bottom: 50px">
                            <h4 id="myModalLabel" style="display: inline-block;
                                position: relative;
                                padding-bottom: 10px;
                                margin: 0;
                                font-size: 24px;
                                color: #000;
                                font-weight: normal;
                                text-transform: uppercase;">NỘP ĐƠN TUYỂN DỤNG</h4>
                        </div>
                        <div class="panel-body">
                            <div id="comment_message"></div>
                            <form id="comment_form" style="text-align: left;">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="row"> <label class="col-sm-3" for="name">Họ tên</label>
                                                <div class="col-sm-9"> <input type="text" name="name" class="form-control" id="name"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row"> <label class="col-sm-3" for="telephone">Điện thoại</label>
                                                <div class="col-sm-9"> <input type="text" name="telephone" class="form-control" id="telephone"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row"> <label class="col-sm-3" for="email">Email</label>
                                                <div class="col-sm-9"> <input type="text" name="email" class="form-control" id="email"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row"> <label class="col-sm-3" for="address">Địa chỉ</label>
                                                <div class="col-sm-9"> <input type="text" name="address" class="form-control" id="address"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row"> <label class="col-sm-3" for="gender">Giới tính</label>
                                                <div class="col-sm-9"> <label class="radio-inline"> <input type="radio" name="gender" value="1"> Nam </label> <label class="radio-inline"> <input type="radio" name="gender" value="2"> Nữ </label> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row"> <label class="col-sm-3" for="date">Ngày sinh</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group date"> <input type="text" name="date_available" data-date-format="DD-MM-YYYY" id="input-date-available" class="form-control"> <span style="    position: relative;
    font-size: 0;
    white-space: nowrap;" class="input-group-btn"> <button class="btn btn-default" type="button" style="height: 36px;
    padding: 0 15px;
    line-height: 36px;"><i class="fa fa-calendar"></i></button> </span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="row"> <label class="col-sm-4" for="vitri">Vị trí ứng tuyển</label>
                                                <div class="col-sm-8"> <select class="vitri form-control" name="vitri">
                                                        <option value="">-- Chọn vị trí --</option>
                                                        <option value="NHÂN VIÊN BÁN HÀNG" selected="selected">NHÂN VIÊN BÁN HÀNG</option>
                                                    </select> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row"> <label class="col-sm-4" for="cv">Hồ sơ</label>
                                                <div class="col-sm-8"> <button type="button" id="button-upload" data-loading-text="Uploading.." class="btn btn-default btn-block"><i class="fa fa-upload"></i> Upload</button> <input type="hidden" name="cv" value="" id="file"> <span class="namefile"></span> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row"> <label class="col-sm-4" for="file">Thư xin việc</label>
                                                <div class="col-sm-8"> <textarea maxlength="300" name="comment" class="form-control" rows="8"></textarea> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><br>
                        <div class="panel-footer"> <button type="button" class="btn btn-default" id="button-refresh">Nhập lại</button> <button type="submit" id="button-comment" class="btn btn-primary">Gửi hồ sơ</button> </div>
                        <br>
                        <div class="bottom_buttons" style="text-align: left;"> <span class="tag_text">Tags:</span> <a href="https://drake.vn/index.php?route=recruit/home&amp;tag=DRAKE TUYỂN DỤNG" style=" color:red;">KINGDOMSNEAKER TUYỂN DỤNG</a> </div>
                    </div>
                </div>
            </div>
            <section id="newsletter-footer" class=" section-color">
                <div class="container page-builder-ltr">
                    <div class="row row_5uqt row-style ">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col_ugr5 col-style pl-0">
                            <div class="module newsleter-basic" style="margin-top: 50px;margin-bottom: 50px; padding: 40px; background-color: rgba(242,242,242,1);">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <div class="so-custom-default" style="width: 100%;">
                                            <div class="popup-title">
                                                <div class="modcontent">
                                                    <h3 style="    color: #222;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: normal;
    text-align: right;
    padding: 10px 0;">Đăng ký nhận tin</h3>
                                                    <p> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-12 col-xs-12 pull-left">
                                        <form method="post" name="signup" class="btn-group form-inline signup">
                                            <div class="input-group"> <input type="email" placeholder="Email của bạn" value="" class="form-control" id="txtemail" name="txtemail" size="55">
                                                <div class="input-group-btn"> <button class="btn btn-default" type="submit" onclick="return subscribe_newsletter();" name="submit"> Đăng ký </button> </div>
                                            </div>
                                            <div class="send-mail"> </div>
                                        </form>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    function subscribe_newsletter() {
                                        var emailpattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                                        var email = $('#txtemail').val();
                                        var d = new Date();
                                        var createdate = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
                                        var status = 0;
                                        var dataString = 'email=' + email + '&createdate=' + createdate + '&status=' + status;
                                        if (email != "") {
                                            if (!emailpattern.test(email)) {
                                                $('.show-error').remove();
                                                $('.send-mail').after('<span class="show-error" style="color: red;margin-left: 10px"> Invalid Email </span>')
                                                return false;
                                            } else {
                                                $.ajax({
                                                    url: 'index.php?route=extension/module/so_newletter_custom_popup/newsletter',
                                                    type: 'post',
                                                    data: dataString,
                                                    dataType: 'json',
                                                    success: function(json) {
                                                        $('.show-error').remove();
                                                        if (json.message == "Subscription Successfull") {
                                                            $('.send-mail').after('<span class="show-error" style="color: #003bb3;margin-left: 10px"> ' + json.message + '</span>');
                                                            setTimeout(function() {
                                                                var this_close = $('.popup-close');
                                                                this_close.parent().css('display', 'none');
                                                                this_close.parents().find('.so_newletter_custom_popup_bg').removeClass('popup_bg');
                                                            }, 3000);

                                                        } else {
                                                            $('.send-mail').after('<span class="show-error" style="color: red;margin-left: 10px"> ' + json.message + '</span>');
                                                        }
                                                        var x = document.getElementsByClassName('signup');

                                                        for (i = 0; i < x.length; i++) {
                                                            x[i].reset();
                                                        }
                                                    }
                                                });
                                                return false;
                                            }
                                        } else {
                                            alert("Email Is Require");
                                            $(email).focus();
                                            return false;
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- breadcrumb area end -->


</main>
@endsection