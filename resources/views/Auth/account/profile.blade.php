@extends('Auth.layouts.master')
@section('title')
    Tài khoản
@endsection
@push('styles')
    <link href="{{asset('Auth/css/toast.css')}}" rel="stylesheet" type="text/css">
@endpush
@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script src="{{asset('admin/assets/libs/tablesaw/tablesaw.js')}}"></script>
<script src="{{asset('admin/assets/js/pages/tablesaw.init.js')}}"></script>
<script src="{{asset('admin/assets/js/vendor.min.js')}}"></script>
<script src="{{asset('admin/assets/js/app.min.js')}}"></script>

<!-- javascript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

@endpush
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
                                    <h1 class="breadcrumb-title">Tài khoản</h1>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Tài khoản</li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- breadcrumb area end -->
            <!-- my account wrapper start -->
            <div class="my-account-wrapper section-padding">
                <div class="container custom-container">
                    @if(Session::has('alert_success'))
                        <div class="alert alert-success w-50 mr-0" style="margin-top: 10px;">
                            {!! Session::get('alert_success') !!}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- My Account Page Start -->
                            <div class="myaccount-page-wrapper">
                                <!-- My Account Tab Menu Start -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-4">
                                        <div class="myaccount-tab-menu nav" role="tablist">
                                            <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                                Tài khoản</a>
                                            <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i>Lịch sử mua hàng</a>
                                            {{-- <a href="#download" data-toggle="tab"><i class="fa fa-cloud-download"></i> Lịch sử mua hàng</a> --}}
                                            <a href="{{route('list-favourite')}}"><i class="fa fa-heart"></i> Sản phẩm yêu thích</a>
                                            <a href="#address-edit" data-toggle="tab"><i class="fa fa-user"></i> Thông tin tài khoản</a>
                                            <a href="#account-info" data-toggle="tab"><i class="fa fa-key"></i>Đổi mật khẩu</a>
                                            <a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Đăng xuất</a>
                                        </div>
                                    </div>
                                    <!-- My Account Tab Menu End -->
            
                                    <!-- My Account Tab Content Start -->
                                    <div class="col-lg-9 col-md-8">
                                        <div class="tab-content" id="myaccountContent">
                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h3>Tài khoản</h3>
                                                    <div class="welcome">
                                                        <p>Xin chào, <strong>{{Auth::user()->name}}</strong> (Nếu không phải <strong>{{Auth::user()->name}} !</strong><a href="{{route('logout')}}" class="text-primary"> Đăng xuất</a></p>
                                                    </div>
<p class="mb-0">Bạn có thể kiểm tra thông tin cá nhân, đơn hàng và chỉnh sửa</p>
                                                </div>
                                            </div>
                                            <!-- Single Tab Content End -->
        
                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade" id="orders" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h3>Đơn hàng</h3>
                                                    <div class="myaccount-table table-responsive text-center">
                                                        <table class="table table-bordered">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Ngày</th>
                                                                    <th>Trạng thái</th>
                                                                    <th>Tổng</th>
                                                                    <th>Thao tác</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($order as $item)
                                                                <tr>
                                                                    <td>{{$item->id}}</td>
                                                                    <td>{{date('d-m-Y',strtotime($item->created_at))}}</td>
                                                                    @if ($item->m_status==0)
                                                                        <td >Đang xử lý</td>
                                                                    @elseif($item->m_status==1)
                                                                        <td>Đang vận chuyển</td>
                                                                    @elseif($item->m_status==2)
                                                                        <td>Hoàn thành</td>
                                                                    @elseif($item->m_status==3)
                                                                        <td>Đã hủy</td>
                                                                    @endif
                                                                    <td>{{$item->m_total_price}}</td>
                                                                    <td>
@if ($item->m_status==0)
                                                                            <a href="/profile/chi-tiet-don-hang/{{$item->id}}" value="show" class="btn rounded">Chi tiết</a>
                                                                            <a  class="btn bg-danger text-light rounded" href="/profile/huy-don-hang/{{$item->id}}">Hủy</a>
                                                                        @else
                                                                            <a href="/profile/chi-tiet-don-hang/{{$item->id }}" value="show" class="btn rounded">Chi tiết</a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Single Tab Content End -->
            
                                        
            
                                            
            
                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h3>Thông tin</h3>
                                                    <div class="account-details-form">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="first-name" class="required">Tên hiển thị</label>
                                                                        <input type="text" value="{{Auth::user()->name}}" id="idMK" placeholder="{{Auth::user()->name}}" />
                                                                        <ul class="parsley-errors-list text-danger name">
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="single-input-item">
                                                                        <label for="last-name" class="required">Số điện thoại</label>
                                                                        <input type="text" value="{{Auth::user()->phone}}" id="phone" placeholder="{{Auth::user()->phone}}" />
                                                                        <ul class="parsley-errors-list text-danger phone">
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label for="display-name" class="required">Địa chỉ</label>
                                                                <input type="text" value="{{Auth::user()->m_address}}" id="address" placeholder="{{Auth::user()->m_address}}" />
                                                                <ul class="parsley-errors-list text-danger m_address">
                                                                </ul>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <label for="email" class="required">Địa chỉ email</label>
                                                                <input type="email" value="{{Auth::user()->email}}" id="email" placeholder="{{Auth::user()->email}}"/>
                                                                <ul class="parsley-errors-list text-danger email">
                                                                </ul>
                                                            </div>
                                                            <div class="single-input-item">
                                                                <button type="submit" id="update_profile" class="check-btn sqr-btn ">Lưu</button>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Single Tab Content End -->
            
                                            <!-- Single Tab Content Start -->
                                            <div class="tab-pane fade" id="account-info" role="tabpanel">
                                                <div class="myaccount-content">
                                                    <h3>Đổi mật khẩu</h3>
                                                    <div class="account-details-form">
                                                            <fieldset>
                                                                <div class="single-input-item">
                                                                    <label for="exampleInputEmail1">Tên tài khoản</label>
                                                        <input type="text"  id="idadmin" data-id="{{Auth::user()->id}}" value="{{Auth::user()->name}}" Readonly>
                                                                </div>
                                                                <div class="single-input-item">
                                                                    <label for="current-pwd" class="required">Mật khẩu hiện tại</label>
                                                                    <input type="password" name="matkhaucu" id="matkhaucu" placeholder="Mật khẩu hiện tại" /><i onclick="showPass()" style="margin-left: -30px; 
                                                                    cursor: pointer;" class="fa fa-eye"></i>
                                                                    <ul class="parsley-errors-list text-danger matkhaucu">
                                                                    </ul>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="single-input-item">
                                                                            <label for="new-pwd" class="required">Mật khẩu mới</label>
                                                                            <input type="password" name="matkhaumoi" id="matkhaumoi" placeholder="Mật khẩu mới" />
                                                                            <ul class="parsley-errors-list text-danger matkhaumoi">
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="single-input-item">
                                                                            <label for="confirm-pwd" class="required">Xác nhận mật khẩu</label>
                                                                            <input type="password" name="xacnhanmatkhau" id="xacnhanmatkhau" placeholder="Xác nhận mật khẩu" />
                                                                            <ul class="parsley-errors-list text-danger xacnhanmatkhau">
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="single-input-item">
                                                                    <button type="submit" id="luumk" class="check-btn sqr-btn ">Lưu</button>
                                                                </div>
                                                            </fieldset>
                                                    </div>
                                                </div>
                                            </div> <!-- Single Tab Content End -->
                                        </div>
                                    </div> <!-- My Account Tab Content End -->
                                </div>
                            </div> <!-- My Account Page End -->
                        </div>
</div>
                </div>
            </div>
            <!-- my account wrapper end -->
        </main>
        <!-- main wrapper end -->
        {{-- @if(Session::has('alert_success'))
    <div class="alert alert-success" style="margin-top: 10px;">
        {!! Session::get('alert_success') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif --}}
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script src="{{asset('admin/assets/libs/tablesaw/tablesaw.js')}}"></script>
<script src="{{asset('admin/assets/js/pages/tablesaw.init.js')}}"></script>
<script src="{{asset('admin/assets/js/vendor.min.js')}}"></script>
<script src="{{asset('admin/assets/js/app.min.js')}}"></script>

<!-- javascript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
<script>
    jQuery(document).ready(function($) {
        // đổi mật khẩu
        $('#luumk').click(function(e){
            e.preventDefault();
            var id = $('#idadmin').data('id');
            var matkhaucu = $('#matkhaucu').val();
            var matkhaumoi = $('#matkhaumoi').val();
            var xacnhanmatkhau = $('#xacnhanmatkhau').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{route("doimatkhauuser")}}',
                method:'post',
                data:{
                    id:id,matkhaucu:matkhaucu,matkhaumoi:matkhaumoi,xacnhanmatkhau:xacnhanmatkhau,_token:_token
                },
                success: function(data){
                    if(data = 'thanhcong'){
                        alertify.success('Cập nhật thành công!');
                    }
                },
                error: function(error) {
                    console.error(error);
                    ["matkhaucu", "matkhaumoi", "xacnhanmatkhau"
                    ].map((item) => {
                        $(`.${item}`).empty();
                    })
                    let validate = error.responseJSON.errors;
                    for (const key in validate) {
                        console.log("key", key);
                        let content = '';
                        validate[key].map((item) => {
                            content += `<li>${item}</li>`
                        })
                        $(`.${key}`).html(content)
                    }
                    alertify.error('Cập nhật mật khẩu thất bại! Vui lòng kiểm tra lại !')
                }
            })
        });
    });
</script>
<script>
    jQuery(document).ready(function($) {
        // đổi thông tin
        $('#update_profile').click(function(e){
            e.preventDefault();
            var name = $('#idMK').val();
            var phone = $('#phone').val();
            var m_address = $('#address').val();
            var email = $('#email').val();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:'{{route("doithongtinuser")}}',
                method:'post',
                data:{
                    name:name,phone:phone,m_address:m_address,email:email,_token:_token
                },
                success: function(data){
                    if(data = 'success'){
                        alertify.success('Cập nhật thành công');
                    }
                },
                error: function(error){
                    console.log(error);
                    ["name", "email", "phone", "m_address"
                    ].map((item) => {
                        $(`.${item}`).empty();
                    })
                    let validate = error.responseJSON.errors;
                    for (const key in validate) {
                        console.log("key", key);
                        let content = '';
                        validate[key].map((item) => {
                            content += `<li>${item}</li>`
                        })
                        $(`.${key}`).html(content)
                    }
                    alertify.error('Cập nhật thông tin thất bại!');
                }
            })
        });
    });
</script>
<script>
    function showPass() {
    var x = document.getElementById("matkhaucu");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    }
</script>
@endpush