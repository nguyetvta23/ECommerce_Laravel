@extends('admin.index')
@push('styles')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link href="{{ asset('admin/assets/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" rel="stylesheet">
    <script src=" {{ asset('admin/assets/libs/moment/moment.js') }}"></script>
@endpush

@push('scripts')
    <script src=https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('admin/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $("#datepicker2").datepicker({
            format: "dd/mm/yyyy",
            autoclose: !0,
            todayHighlight: !0,
        });
        $("#datepicker").datepicker({
            format: "dd/mm/yyyy",
            autoclose: !0,
            todayHighlight: !0,
        });
    </script>


    <script>
        jQuery(document).ready(function($) {
            var colorDanger = "#FF1744";
            var donut = Morris.Donut({
                element: 'donut',
                resize: true,
                colors: [
                    '#5ddab4',
                    '#9694ff',
                    '#80DEEA',
                    '#4DD0E1',
                    '#00ACC1',
                    '#0097A7',
                    '#00838F',
                    '#006064'
                ],
                //labelColor:"#cccccc", // text color
                //backgroundColor: '#333333', // border color
                data: [{
                        label: "Đánh giá 5*",
                        value: <?php echo $cmtproduct5sao; ?>
                    },
                    {
                        label: "Đánh giá 4*",
                        value: <?php echo $cmtproduct4sao; ?>
                    },
                    {
                        label: "Đánh giá 3*",
                        value: <?php echo $cmtproduct3sao; ?>
                    },
                    {
                        label: "Đánh giá 2*",
                        value: <?php echo $cmtproduct2sao; ?>
                    },
                    {
                        label: "Đánh giá 1*",
                        value: <?php echo $cmtproduct1sao; ?>
                    },
                ]
            });
            $('#btn-dashboard-filter').on('click', function() {
                var from_date = new Date($('#datepicker').val().split("/").reverse().join("/"));
                var to_date = new Date($('#datepicker2').val().split("/").reverse().join("/"));
                var _token = $('input[name="_token"]').val();
                console.log(to_date);
                $.ajax({
                    url: '{{ route('filterdate') }}',
                    method: "post",
                    dataType: "JSON",
                    data: {
                        from_date: from_date.toISOString(),
                        to_date: to_date.toISOString(),
                        _token: _token
                    },

                    success: function(data) {
                        chart.setData(data);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
            chart7day();
            var chart = new Morris.Bar({
                element: 'myfirstchart',
                // option thống kê
                barColors: ['#435ebe', '#fc8710', '#FF6541', '#A4ADD3'],
                gridTextColor: ['#000000'],
                // pointFillColors: ['#ffffff'],
                // pointStrokeColors:['black'],
                fillOpacity: 0.8,
                hideHover: 'auto',
                parseTime: false,

                xkey: 'name',
                ykeys: ['tongtien'],
                // behaveLikeLine: true,

                labels: ['Giá tiền']
            });

            // autoload 30 ngày đơn hàng
            function chart7day() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ route('orderdate') }}',
                    method: "post",
                    dataType: "JSON",
                    data: {
                        _token: _token
                    },

                    success: function(data) {
                        chart.setData(data);
                    }
                });
            }
        });
    </script>
@endpush

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <div class="row">

                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="{{ route('product.index') }}" class="dropdown-item">Xem sản phẩm</a>
                                <!-- item-->
                                <a href="{{ route('product.create') }}" class="dropdown-item">Thêm sản phẩm</a>
                            </div>
                        </div>

                        <h4 class="header-title mt-0 mb-4">Tổng sản phẩm</h4>

                        <div class="widget-chart-1">
                            <!-- <div class="widget-chart-box-1 float-left" dir="ltr">
                                                <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050 "
                                                    data-bgColor="#F9B9B9" value="58" data-skin="tron" data-angleOffset="180"
                                                    data-readOnly=true data-thickness=".15" />
                                            </div> -->

                            <div class="widget-detail-1 text-right">
                                <h2 class="font-weight-normal pt-2 mb-1"> {{ $tongsanpham->count() }}</h2>
                                <p class="text-muted mb-1">Sản phẩm</p>
                            </div>
                        </div>
                    </div>

                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="{{ route('category-admin') }}" class="dropdown-item">Xem danh mục</a>
                            </div>
                        </div>

                        <h4 class="header-title mt-0 mb-4">Tổng danh mục</h4>

                        <div class="widget-chart-1">
                            <!-- <div class="widget-chart-box-1 float-left" dir="ltr">
                                                <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#f05050 "
                                                    data-bgColor="#F9B9B9" value="58" data-skin="tron" data-angleOffset="180"
                                                    data-readOnly=true data-thickness=".15" />
                                            </div> -->

                            <div class="widget-detail-1 text-right">
                                <h2 class="font-weight-normal pt-2 mb-1"> {{ $tongdanhmuc->count() }}</h2>
                                <p class="text-muted mb-1">Danh mục</p>
                            </div>
                        </div>
                    </div>

                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="{{ route('order') }}" class="dropdown-item">Xem đơn hàng</a>
                            </div>
                        </div>

                        <h4 class="header-title mt-0 mb-4">Đơn hàng trong 30 ngày</h4>

                        <div class="widget-chart-1">
                            <!-- <div class="widget-chart-box-1 float-left" dir="ltr">
                                                <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
                                                    data-bgColor="#FFE6BA" value="80" data-skin="tron" data-angleOffset="180"
                                                    data-readOnly=true data-thickness=".15" />
                                            </div> -->
                            <div class="widget-detail-1 text-right">
                                <h2 class="font-weight-normal pt-2 mb-1"> {{ $tongdonhang->count() }} </h2>
                                <p class="text-muted mb-1">30 ngày</p>
                            </div>
                        </div>
                    </div>

                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <div class="card-box">
                        <div class="dropdown float-right">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <!-- item-->
                                <a href="{{ route('list_comment') }}" class="dropdown-item">Xem đánh giá</a>
                            </div>
                        </div>

                        <h4 class="header-title mt-0 mb-4">Tổng đánh giá</h4>

                        <div class="widget-chart-1">
                            <!-- <div class="widget-chart-box-1 float-left" dir="ltr">
                                                <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#ffbd4a"
                                                    data-bgColor="#FFE6BA" value="80" data-skin="tron" data-angleOffset="180"
                                                    data-readOnly=true data-thickness=".15" />
                                            </div> -->
                            <div class="widget-detail-1 text-right">
                                <h2 class="font-weight-normal pt-2 mb-1"> {{ $cmtproduct->count() }} </h2>
                                <p class="text-muted mb-1">Đánh giá</p>
                            </div>
                        </div>
                    </div>

                </div><!-- end col -->


            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card-box">
                        <form autocomplete="off" class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <p>Từ ngày<input type="text" id="datepicker" class="form-control"
                                            placeholder="dd/mm/yyyy">
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <p>Đến ngày <input type="text" id="datepicker2" class="form-control"
                                            placeholder="dd/mm/yyyy">
                                    </p>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <input type="button" id="btn-dashboard-filter" class="btn btn-info btn-sm"
                                        value="Lọc kết quả">
                                </div>
                            </div>
                        </form>
                        <h4 class="header-title mt-0">Thống kê đơn hàng</h4>

                        <div class="widget-chart text-center">
                            <div id="myfirstchart" style="height:250px;"></div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-xl-4">
                    <div class="card-box">
                        <h4 class="header-title mt-0">Thống kê đánh giá</h4>
                        <div id="donut" class="morris-donut-inverse" style="height:373px">

                        </div>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xl-4">
                    <div class="card-box">
                        <h4 class="header-title mb-3">Đánh giá gần đây</h4>

                        <div class="inbox-widget">
                            @foreach ($showcmtganday as $show)
                                <div class="inbox-item">
                                    <a href="#">
                                        <div class="inbox-item-img">
                                            @if ($show->showiduser->m_avatar != null)
                                                <img src="{{ asset('uploads/avatar') }}/{{ $show->showiduser->m_avatar }}"
                                                    class="rounded-circle" alt="">
                                            @else
                                                <img src="{{ asset('admin/assets/images') }}/users/user-4.jpg"
                                                    class="rounded-circle" alt="">
                                            @endif
                                        </div>
                                        <h5 class="inbox-item-author mt-0 mb-1">{{ $show->showiduser->name }}</h5>
                                        <p class="inbox-item-text">{{ $show->m_content }}</p>
                                        <p class="inbox-item-date">{{ $show->updated_at->diffForHumans() }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-xl-8">
                    <div class="card-box">
                        <h4 class="header-title mt-0 mb-3">Đơn hàng gần đây</h4>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Người đặt hàng</th>
                                        <th>Thời gian Đặt</th>
                                        <th>Số điện thoại</th>
                                        <th>Tình trạng</th>
                                        <th>Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($showdonhangganday as $key => $showdh)
                                        <tr>
                                            <td>{{ $key += 1 }}</td>
                                            <td>{{ $showdh->m_name }}</td>
                                            <td>{{ $showdh->updated_at }}</td>
                                            <td>{{ $showdh->m_phone }}</td>
                                            <td>
                                                @if ($showdh->m_status == 0)
                                                    <span class="badge badge-info">Chưa hoàn thành</span>
                                                @elseif($showdh->m_status == 1)
                                                    <span class="badge badge-warning">Đang vận chuyển</span>
                                                @elseif($showdh->m_status == 2)
                                                    <span class="badge badge-dark">Đã được giao</span>
                                                @elseif($showdh->m_status == 3)
                                                    <span class="badge badge-danger">Đơn đã hủy</span>
                                                @elseif($showdh->m_status == 4)
                                                    <span class="badge badge-success">Hoàn thành đơn</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($showdh->m_total_price, 0, '.', '.') }} Vnđ</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end col -->

            </div>
            <!-- end row -->

        </div> <!-- container-fluid -->

    </div> <!-- content -->

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    2022 &copy; Phát triển bởi <a href="{{ route('about-us') }}">Kingdom Sneakers Team</a>
                </div>
                <div class="col-md-6">
                    <div class="text-md-right footer-links d-none d-sm-block">
                        <a href="{{ route('about-us') }}">Về Kingdom Sneakers</a>
                        <a href="{{ route('contact-auth') }}">Liên hệ</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection
