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
<!-- third party js ends -->

<!-- Datatables init -->
<script src=" {{ asset('admin/assets/js/pages/datatables.init.js') }}"></script>
@endpush
@section('title')
Thông tin đơn hàng
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
            <h2 class="mt-0 header-title">THÔNG TIN ĐƠN HÀNG</h2><br>
            <ul class="list-item" style="list-style: none; font-size: 16px; padding-left: 0px">
                <div class="row">
                @foreach($ordersr as $order)
                    <li class="col-md-3">
                        <h3 style="font-size: 16px;" class="title"><i class='fas fa-barcode' style='font-size:24px'></i> Mã đơn hàng</h3>
                        <span class="detail">{{$order->id}}</span>
                    </li>
                    <li class="col-md-3">
                        <h3 style="font-size: 16px;" class="title"><i class='fas fa-map-marker-alt' style='font-size:24px;'></i> Địa chỉ nhận hàng</h3>
                        <span class="detail">{{$order->m_address}}</span>
                    </li>
                    <li class="col-md-3">
                        <h3 style="font-size: 16px;" class="title"><i class='fas fa-phone' style='font-size:24px'></i> Số điện thoại</h3>
                        <span class="detail">{{$order->m_phone}}</span>
                    </li>
                    <li class="col-md-3">
                        <h3 style="font-size: 16px;" class="title"><i class='fas fa-rocket' style='font-size:24px'></i> Thông tin giao dịch</h3>
                        <span class="detail">
                            @if($order->m_status_pay == 0)
                                Ship COD
                            @elseif($order->m_status_pay == 1)
                                MOMO
                            @else
                                VNPAY
                            @endif
                        </span>
                    </li>
                </div>
                <hr>
                <div class="row">
                    <li class="col-md-6">
                        <h3 style="font-size: 16px;" class="title"><i class='fas fa-rocket' style='font-size:24px'></i> Thông tin Vận chuyển</h3>
                        <span class="detail">
                            @if($order->m_status_pay == 0)
                            Giao hành Nhanh
                            @elseif($order->m_status_pay == 1)
                            Viettel
                            @else
                            Giao hàng tiết kiệm
                            @endif
                        </span>
                    </li>
                    <form method="GET" action="{{route('order.detail',$order->id)}}" class="col-md-6">
                        <li>
                            <h5 class="title">Tình trạng đơn hàng</h5>
                            <select name="status" style="border: 1px solid #ccc;padding: 5px 20px;font-size: 16px;color: #666;border-radius: 3px;">
                                <option value='none' {{($order->m_status == 0) ? 'selected':''}}>Đang chờ</option>
                                <option value='1' {{($order->m_status == 1) ? 'selected':''}}>Đang vận chuyển</option>
                                <option value='2' {{($order->m_status == 2) ? 'selected':''}}>Đã chuyển</option>
                                <option value='3' {{($order->m_status == 3) ? 'selected':''}}>Đã hủy</option>
                                <option value='4' {{($order->m_status == 4) ? 'selected':''}}>Đã Hoàn Thành</option>
                            </select>
                            <button type="submit" class="btn btn-primary" name="sm_status" value="">Cập nhật đơn hàng</button>
                        </li>
                    </form>
                </div>
                @endforeach
                <br>
                <li>
                    <a href="{{route('order')}}">Trở về danh sách đơn hàng</a>
                </li>
            </ul>
        </div>
        <div class="card-box">
            <h4 class="mt-0 header-title">SẢN PHẨM ĐƠN HÀNG</h4>
            <table id="datatable" class="table table-bordered dt-responsive nowrap">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>ẢNH SẢN PHẨM</th>
                        <th>MÃ SẢN PHẨM</th>
                        <th>TÊN SẢN PHẨM</th>
                        <th>ĐƠN GIÁ</th>
                        <th>SỐ LƯỢNG</th>
                        <th>THÀNH TIỀN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderdetails as $key => $orderdetail)
                    <tr>
                        <td>{{$key}}</td>
                        <td style="width: 10px">
                            @if(json_decode($orderdetail->showimgproduct->m_picture))
                                <img src="{{asset('uploads')}}/{{json_decode($orderdetail->showimgproduct->m_picture)[0]}}" style="width: 80px;height: 80px;border: 1px solid #ccc;" />
                            @else
                                <img src="{{asset('uploads')}}/1657125436-sanpham.p1.jpg" style="width: 80px;height: 80px;border: 1px solid #ccc;" />
                            @endif
                        </td>
                        <td>{{$orderdetail->showmasanpham->id}}</td>
                        <td>{{$orderdetail->m_product_name}}</td>
                        <td>{{number_format($orderdetail->m_price, 0, '.', '.')}} Vnđ</td>
                        <td>{{$orderdetail->m_quanti}}</td>
                        @php
                           $tongorder = $orderdetail->m_price * $orderdetail->m_quanti
                        @endphp
                        <td>{{number_format($tongorder, 0, '.', '.')}} Vnđ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <h4 class="mt-0 header-title">GIÁ TRỊ ĐƠN HÀNG</h4>
            <table id="datatable" class="table table-bordered dt-responsive nowrap">
                @foreach($ordersr as $order)
                <p>Tổng số lượng sản phẩm: {{$order->showprice->sum('m_quanti')}}</p>
                <p style="color: red; font-weight: bold">Tổng giá trị đơn hàng: {{number_format($order->m_total_price, 0, '.', '.')}} Vnđ</p>
                @endforeach
            </table>
        </div>

    </div>
</div> <!-- end row -->
@endsection