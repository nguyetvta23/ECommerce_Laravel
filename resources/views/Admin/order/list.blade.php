@extends('Admin.index')
@push('css')
<!-- third party css -->
<link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<!-- third party css end -->
@endpush
@push('scripts')
<!-- third party js -->
<script src=" {{ asset('admin/assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src=" {{ asset('admin/assets/libs/datatables/dataTables.bootstrap4.js') }}"></script>
<script src=" {{ asset('admin/assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src=" {{ asset('admin/assets/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src=" {{ asset('admin/assets/libs/datatables/dataTables.buttons.min.js') }}"></script>
<script src=" {{ asset('admin/assets/libs/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src=" {{ asset('admin/assets/libs/datatables/buttons.html5.min.js') }}"></script>
<script src=" {{ asset('admin/assets/libs/datatables/buttons.flash.min.js') }}"></script>
<script src=" {{ asset('admin/assets/libs/datatables/buttons.print.min.js') }}"></script>
<script src=" {{ asset('admin/assets/libs/datatables/dataTables.keyTable.min.js') }}"></script>
<script src=" {{ asset('admin/assets/libs/datatables/dataTables.select.min.js') }}"></script>
<script src=" {{ asset('admin/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
<script src=" {{ asset('admin/assets/libs/pdfmake/vfs_fonts.js') }}"></script>
<script src=" {{ asset('admin/assets/libs/checkbox/list.js') }}"></script>
<!-- third party js ends -->

<!-- Datatables init -->
<script src=" {{ asset('admin/assets/js/pages/datatables.init.js') }}"></script>
@endpush
@section('title')
Danh sách đơn hàng
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <h4 class="mt-0 header-title">Danh sách đơn hàng</h4>
            <ul style="list-style: none" class="pl-0">
                <li class="float-left pr-1"><a style="color: mediumvioletred;" href="{{route('order')}}">Tất cả <span class="text-dark font-weight-bold">({{$count_total}})</span> |</a></li>
                <li class="float-left pr-1"><a style="color: mediumvioletred;" href="{{request()->fullUrlWithQuery(['status' => 'confirm'])}}">Đơn hoàn thành <span class="text-dark font-weight-bold">({{$count[0]}})</span> |</a></li>
                <li class="float-left pr-1"><a style="color: mediumvioletred;" href="{{request()->fullUrlWithQuery(['status' => 'cancel'])}}">Đơn đã hủy <span class="text-dark font-weight-bold">({{$count[1]}})</span> </a></li>
            </ul><br>
            <form action="{{url('admintrator/order/action')}}" method="POST">
                @csrf
                <div class="actions">
                    <select name="actions" style="border: 1px solid #ccc;padding: 4px 10px;border-radius: 3px;">
                        <option>Tác vụ</option>
                        <option value="none">Đang chờ</option>
                        <option value="1">Đang vận chuyển</option>
                        <option value="2">Đã chuyển</option>
                        <option value="3">Hủy đơn hàng</option>
                        <option value="4">Đã Hoàn Thành</option>
                    </select>
                    <input type="submit" name="sm_action" value="Áp dụng" style="border-radius: 3px;border: 1px solid #afafaf;padding: 2px 15px;background: #fafafa;">
                </div><br>
                <table id="datatable" class="table table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>
                                <label for="">
                                    <input type="checkbox" name="checkAll" id="checkAll" class="checkAll">
                                </label>
                            </th>
                            <th>Stt</th>
                            <th>Tên khách hàng</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th style="width:180px">Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>


                    <tbody>
                        @php
                        $i = 0;
                        @endphp
                        @foreach ($orders as $order)
                        <tr>
                            <td>
                                <label for="">
                                    <input type="checkbox" name="checkItem[]" class="checkbox_childrent" value="{{$order->id}}">
                                </label>
                            </td>
                            <td>@php
                                $i++;
                                echo "$i";
                                @endphp
                            </td>
                            <td>{{$order->m_name}}</td>
                            <td>{{$order->m_email}}</td>
                            <td>{{$order->m_phone}}</td>
                            <td>@if($order->m_status == 0)
                                <span class="bg bg-info text-white font-weight-bold" style="padding: 10px 10px; padding-right: 14px">Chưa hoàn thành</span>
                                @elseif($order->m_status == 1)
                                <span class="bg bg-warning text-white font-weight-bold" style="padding: 10px 10px; padding-right: 14px">Đang vận chuyển</span>
                                @elseif($order->m_status == 2)
                                <span class="bg bg-dark text-white font-weight-bold" style="padding: 10px 10px; padding-right: 14px">Đã được giao</span>
                                @elseif($order->m_status == 3)
                                <span class="bg bg-danger text-white font-weight-bold" style="padding: 10px 10px; padding-right: 14px">Đã hủy đơn</span>
                                @elseif($order->m_status == 4)
                                <span class="bg bg-success text-white font-weight-bold" style="padding: 10px 10px; padding-right: 30px;">Hoàn thành đơn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('order.detail',$order->id)}}" class="btn btn-warning btn-xs">
                                    Chi tiết
                                </a>
                                <button type="button" class="btn btn-info btn-xs" id="sa-params">Xóa</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div> <!-- end row -->
@endsection