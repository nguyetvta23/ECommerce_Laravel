@extends('admin.index')
@section('content')
<style>
    #container {
        display: flex;
    }

    a {
        color: #fff;
        text-decoration: none;
    }

    button:hover>a {
        color: #fff;
        text-decoration: none;
    }

    .avt {
        width: 40px;
        height: 40px;
        margin-right: 20px;
        border: none;
        border-radius: 40px;

    }

    .avt img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        overflow: hidden;
        border-radius: 40px;
        box-shadow: 2px 3px 4px gray;
    }
</style>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="page-title"> Quản lí bình luận <span class="badge badge-danger">@php echo count($d); @endphp</span>
                </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <table id="datatable" class="table table-bordered dt-responsive nowrap">
                    <thead style="text-align:center;">
                        <tr>
                            <th>KHÁCH HÀNG</th>
                            <th with="40%">NỘI DUNG</th>
                            <th>ID BLOG</th>
                            <th with="10%">NGÀY BÌNH LUẬN</th>
                            <th>DUYỆT</th>
                            <th>TRẢ LỜI</th>
                            <th>XÓA</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach($d as $row)
                        <tr>
                            <td rowspan="2">
                                </br>
                                {{$row['m_username']}} </br>
                            </td>
                            <td onload="cut_string()">
                                <span id="cut_strings">
                                    @php
                                    $str = $row['m_content'];
                                    $result_str = substr($str,0,40);
                                    $result_str.='....';
                                    echo $result_str;
                                    @endphp
                                </span>
                                <button type="button" class="btn btn-primary float-right" style="outline: none;" data-toggle="modal" data-target="#exampleModal">
                                    Xem
                                </button>
                            </td>
                            <td>
                                Mã sản phẩm : {!!$row['id']!!} </br>
                                Tên sản phẩm : {!!$row['m_product_name']!!}
                            </td>
                            <td with="10%">
                                {{$row['created_at']}}
                            </td>
                            <td>
                                <!-- <button class="btn btn-@php if($row['m_status'] ==1) {echo 'primary';} else {echo 'warning';}@endphp 
" style="outline: none;" id="click_d"> -->
                                    
                                    @if($row['m_status']===1){
                                    echo "Ðã Duyệt";
                                    }
                                    @else{
                                    echo "Chưa Duyệtt";
                                    }
                                    @endif
                            </td>
                            <td>
                                <button type="button" @php if($row['m_status']===0){echo "disabled" ;} @endphp class="btn btn-secondary" style="outline: none;" data-toggle="modal" data-target="#exampleModal1">
                                    Trả lời
                                </button>
                            </td>
                            <td <button class="btn btn-danger" style="outline: none;" id>
                                <a href="/admintrator/delete_cmt/{!!$row['id']!!}">Xóa</a>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        ID KHÁCH HÀNG : {{$row['id']}} </br>
                        Tên : {{$row['m_username']}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        {!!$row['m_content']!!}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="outline:none;" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <span style="color:red">Khách Hàng</span> : {{$row['m_username']}} </br>
                        Nội dung : <span>{!!$row['m_content']!!}</span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>TRẢ LỜI BÌNH LUẬN</h3>
                    <form method="post" action="">
                        <div class="form-group">
                            <textarea class="form-control" name="data_cmt" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <button type="submit" name="send_cmt" class="btn btn-primary">GỬI</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="outline:none;" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- start model -->

</div> <!-- container-fluid -->
@push('scripts')
<!-- <script>
    window.onload = function(){
        let nodej = document.getElementById('cut_strings').innerText;
        let cut_string = nodej.slice(0,39);
        //
        document.getElementById('cut_strings').innerText = cut_string;
    }
</script>     -->
@endpush
@endsection