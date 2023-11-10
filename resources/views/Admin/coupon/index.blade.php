@extends('admin.index')
@push('styles')
    <!-- third party css -->
    <link href=" {{ asset('admin/assets/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href=" {{ asset('admin/assets/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href=" {{ asset('admin/assets/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
    <link href=" {{ asset('admin/assets/libs/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
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
    <script src=" {{ asset('admin/assets/libs/moment/moment.js') }}"></script>
    <!-- third party js ends -->
    <script>
        let table = "";
        const renderData = () => {
            $.ajax({
                url: "{{ route('coupon-load') }}",
                type: "get",
                success: function(response) {
                    console.log('list-post', response);
                    let tbody = ``;
                    response.data.map((item, index) => {
                        tbody += `
                                <tr>
                                    <td>${item.coupon_name}</td>
                                    <td>
                                        ${item.coupon_code}
                                    </td>
                                    <td>${item.coupon_method == 1 ? "Giảm theo phần trăm" : "Giảm theo số tiền"}</td>
                                    <td>${item.coupon_time}</td>
                                    <td>${item.coupon_method == 1 ? item.coupon_value+"%" : item.coupon_value.toLocaleString()}</td>
                                    <td>${moment(item.coupon_expired).format('DD/MM/YYYY')}</td>
                                    <td>
                                        <button type="button" data-id="${item.id}" class="btn-delete btn btn-icon waves-effect waves-light btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>`
                    })
                    $('tbody:first').html(tbody);
                    $('.btn-delete').click(function(e) {
                        let id = $(this).data('id');
                        $.ajax({
                            type: "get",
                            url: `{{ url('admintrator/coupon/delete/${id}') }}`,
                            success: function(response) {
                                table.destroy();
                                renderData();
                                toastr.success('Xóa thành công!')
                            },
                            error: function(e) {
                                console.error(e);
                                toastr.error('Lỗi xóa!');
                            }
                        });
                    });
                },
                error: function(e) {
                    console.error(e);
                    toastr.error('Lỗi tải trang!');
                }
            }).then(() => {
                table = $("#datatable").DataTable({
                    "columns": [{
                            "width": "10%"
                        },
                        {
                            "width": "14%"
                        },
                        null,
                        null,
                        {
                            "width": "10%"
                        },
                        {
                            "width": "14%"
                        },
                        {
                            "width": "12%"
                        }
                    ],
                })
            })
        }
        renderData();
    </script>
@endpush
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="datatable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên mã</th>
                                    <th>Mã giảm giá</th>
                                    <th>Phương thức giảm</th>
                                    <th>Số lượng mã</th>
                                    <th>Giá trị mã</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end row -->

        </div> <!-- container-fluid -->

    </div> <!-- content -->
@endsection
