@extends('admin.index')
@section('title')
    Tài khoản
@endsection
@section('content')
<link href="{{asset('admin/assets/libs/tablesaw/tablesaw.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admin/assets/css/app.min.css')}}" id="app-stylesheet" rel="stylesheet" type="text/css">
@if(Session::has('alert_success'))
    <div class="alert alert-success" style="margin-top: 10px;">
        {!! Session::get('alert_success') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="row">
    <div class="col-12">
    <section class="content-info">
    <div class="row">
        <div class="col-sm-8">
            <div class="bg-picture card-box">
                <div class="profile-info-name">
                    @if(Auth::user()->m_avatar == null)
                    <img src="{{asset('admin/assets/images/profile.jpg')}}" class="rounded-circle avatar-xl img-thumbnail float-left mr-3" alt="profile-image">
                    @else
                    <img src="{{asset('uploads/avatar')}}/{{Auth::user()->m_avatar}}" class="rounded-circle avatar-xl img-thumbnail float-left mr-3" alt="profile-image">
                    @endif
                    <div class="profile-info-detail overflow-hidden">
                        <h4 class="m-0"><strong></strong>{{Auth::user()->name}}</h4>
                        <p class="text-muted"><strong>Vai trò : </strong>
                            <i> 
                                @if(Auth::user()->role == 1) 
                                    admintrator
                                @else if(Auth::user()->role == 2)
                                    Nhân viên
                                @endif
                            </i></p>
                        <p class="font-13"><strong>Số điện thoại: </strong>{{Auth::user()->phone}}</p>
                        <p class="font-13"><strong>Địa chỉ: </strong>{{Auth::user()->m_address}}</p>

                        <ul class="social-list list-inline mt-3 mb-0">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-purple text-purple"><i class="mdi mdi-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                            </li>
                        </ul>

                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
            <!--/ meta -->
            <div class="card-box">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Đổi mật khẩu</span>            
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Đổi thông tin</span> 
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade show active" id="home1">
                            <center> - Đổi mật khẩu - </center>
                        <form method="post" action="{{route('profile.update', Auth::user()->id)}}">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên tài khoản</label>
                                <input type="text" class="form-control" idid="matkhaumoi"="idadmin" data-id="{{Auth::user()->id}}" value="{{Auth::user()->name}}" Readonly>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mật khẩu cũ</label>
                                <input type="password" class="form-control showPass" id="matkhaucu" name="matkhaucu" placeholder="Nhập mật khẩu cũ của bạn">
                                <input class="mt-2" type="checkbox" onclick="showPass()"> Hiện mật khẩu
                                <ul class="parsley-errors-list matkhaucu">
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mật khẩu mới</label>
                                <input type="password" class="form-control showPass" id="matkhaumoi" name="matkhaumoi" placeholder="Nhập mật khẩu mới">
                                <ul class="parsley-errors-list matkhaumoi">
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Xác nhận mật khẩu mới</label>
                                <input type="password" class="form-control showPass" id="xacnhanmatkhau" name="xacnhanmatkhau" placeholder="Xác nhận mật khẩu mới">
                                <ul class="parsley-errors-list xacnhanmatkhau">
                                </ul>
                            </div>
                            <button type="submit" id="btnluumk" class="btn btn-primary">Lưu mật khẩu</button>
                        </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="profile1">
                        <center> - Đổi Thông tin - </center>
                        <form action="{{route('profile.update', Auth::user()->id)}}" method="post" role="form" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label for="exampleInputEmail1">Họ và Tên</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{Auth::user()->name}}">
                                @error('name')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{Auth::user()->email}}" placeholder="Nhập địa chỉ email">
                                @error('email')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số điện thoại</label>
                                <input type="number" class="form-control" id="phone" name="phone" value="{{Auth::user()->phone}}" min="0" placeholder="Nhập số điện thoại">
                                @error('phone')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="m_address" value="{{Auth::user()->m_address}}" placeholder="Nhập địa chỉ">
                                @error('address')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Avatar</label>
                                <input type="file" class="form-control" id="avatar" name="avatar" placeholder="Chọn hình ảnh avatar">
                                @if(Auth::user()->m_avatar)
                                    <img src="{{asset('uploads/avatar')}}/{{Auth::user()->m_avatar}}" alt="" width="100px" height="100px" style="margin:5px">
                                @endif
                            </div>
                            <button type="submit" id="btnthongtin" class="btn btn-primary">Lưu Thông Tin</button>
                        </form>
                        </div>
                    </div>
            </div>

        </div>
        <div class="col-sm-4">
            <div class="card-box">
                <div class="dropdown float-right">
                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="mdi mdi-dots-vertical"></i>
                    </a>
                </div>

                <h4 class="header-title mt-0 mb-3">Thành Viên thuộc hệ thống</h4>

                <ul class="list-group mb-0 user-list">
                    @foreach($thanhvien as $tv)
                    <li class="list-group-item">
                        <a href="#" class="user-list-item">
                            <div class="user avatar-sm float-left mr-2">
                                <img src="{{asset('uploads/avatar')}}/{{$tv->m_avatar}}" alt="" class="img-fluid rounded-circle">
                            </div>
                            <div class="user-desc">
                                <h5 class="name mt-0 mb-1">{{$tv->name}}</h5>
                                <p class="desc text-muted mb-0 font-12">
                                    @if($tv->role = 1)
                                        admintrator
                                    @else
                                        nhân viên
                                    @endif
                                </p>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    </section>
    </div>
</div>
<!-- form-delete -->
<form method="POST" action="" id="form-delete">
    @method('DELETE')
    @csrf
</form> 
@endsection
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />
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

</script> -->
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
        $('.btndelete').click(function(ev) {
            ev.preventDefault();
            var _href = $(this).attr('href');
            $('form#form-delete').attr('action',_href);
            alertify.confirm('Bạn muốn xóa sản phẩm này ?', function(result){
                if(result){
                    $('form#form-delete').submit();
                }
            })
        });
    });
</script>
<script>
    jQuery(document).ready(function($) {
        // đổi mật khẩu
        $('#btnluumk').click(function(e){
            e.preventDefault();
            var id = $('#idadmin').data('id');
            var matkhaucu = $('#matkhaucu').val();
            var matkhaumoi = $('#matkhaumoi').val();
            var xacnhanmatkhau = $('#xacnhanmatkhau').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{route("doimatkhauadmin")}}',
                method:'post',
                data:{
                    id:id,matkhaucu:matkhaucu,matkhaumoi:matkhaumoi,xacnhanmatkhau:xacnhanmatkhau,_token:_token
                },
                success: function(data){
                    if(data = 'thanhcong'){
                        alertify.success('Cập nhật mật khẩu thành công');
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