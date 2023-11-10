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
                <h4 class="page-title"> Quản lí bình luận <span class="badge badge-danger"><?php echo count($query); ?></span>
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
                            <th>ID SẢN PHẨM</th>
                            <th with="10%">THỜI GIAN CẬP NHẬT</th>
                            <th>DUYỆT</th>
                            <th>TRẢ LỜI</th>
                            <th>XÓA</th>
                        </tr>
                    </thead>


                    <tbody id="output">
                        @php
                        if(isset($query)) {
                        foreach($query as $row) {
                        @endphp
                        <tr>
                            <td>
                                {{$row->name}}
                            </td>
                            <td>
                                <span>
                                    @php
                                    $str = $row->m_content;
                                    $ct = substr($str, 0,30);
                                    $ct .= '....';
                                    echo $ct;
                                    @endphp
                                </span>
                                <button type='button' value="{{$row->idbl}}"   class='get_value btn btn-primary float-right' style='outline: none;' data-toggle='modal' data-target='#exampleModal'>
                                    Xem
                                </button>
                            </td>
                            <td>
                                <span style='color:red'>ID : {{$row->m_id_maloai}}</span></br>
                                {{$row->m_product_name}}
                            </td>
                            <td with='10%'>
                                {{$row->updated_at->diffForHumans()}}
                            </td>
                    
                            <td>
                                @if($row->m_status ==1)
                                    <button class="statust btn btn-primary" data-order_id="{{$row->idbl}}" value="0">Duyệt</button>
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                @else
                                    <button class="statust btn btn-warning" data-order_id="{{$row->idbl}}" value="1">Chưa Duyệt</button>
                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                @endif
                            </td>
                            <td>
                                <button type='button'  value="{{$row->idbl}}" class='answer_queston btn btn-secondary' style='outline: none;' data-toggle='modal' data-target='#exampleModal1'>
                                    Trả lời
                                </button>
                            </td>
                            <td>
                                <button class='btn btn-danger' style='outline: none;' id>
                                    <a href="{{url('admintrator/delete_cmt')}}/{{$row->idbl}}">Xóa</a>
                                </button>
                            </td>
                        </tr>
                        @php
                        }
                        }
                        @endphp
                    </tbody>

                </table>
                {{$query->links()}}

            </div>
        </div>
    </div>
    <!-- end row -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        KHÁCH HÀNG : <span id="id_user"></span> </br>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="content_user">
                    
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="outline:none;" data-dismiss="modal">ĐÓNG</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <span style="color:red">Khách Hàng</span> <span class="name_"></span></br>
                        Nội dung : <span class="content_"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>TRẢ LỜI BÌNH LUẬN</h3>
                    <form method="post" class="form_">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="input-answer" name="idbl" value="" data-id="">
                            <textarea class="form-control" name="data_cmt" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <button type="submit" name="send_cmt" class="send_cmt btn btn-primary">GỬI</button>
                    </form>
                    @if(session('alert'))
                    <section class="alert alert-success" >{{session('alert')}}</section>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" style="outline:none;" data-dismiss="modal">ĐÓNG</button>
                </div>
            </div>
        </div>
    </div>
    <!-- start model -->

</div> <!-- container-fluid -->
@push('scripts')
 <script src="{{URL::asset('admin/assets/js/jquery/load_model.js')}}"></script>
@endpush
@endsection