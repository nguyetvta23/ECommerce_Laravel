@extends('Admin.index')
@section('content')
    <link href="{{ asset('admin/assets/libs/tablesaw/tablesaw.css') }}" rel="stylesheet" type="text/css">
    <style>
        .phongnen {
            width: 150px;
            height: 200px;
            border: 1px solid rgb(247, 247, 247);
            border-radius: 15px;
            box-shadow: rgba(247, 247, 247, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
        }

        .phongnen img {
            padding: 5px 5px 5px 5px;
            width: 148.5px;
            height: 198px;
            border-radius: 15px;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .phongheader {
            border: 1px solid #000;
        }

        .list-group li {
            font-weight: bold;
        }

        .list-group li:nth-child(2n-1) {
            background-color: rgb(243, 241, 241);
        }

        .suaxoa a {
            margin-left: 5px;
        }

        .overchapter {
            height: 300px;
            overflow-y: auto;
        }

        .textdes {
            overflow-y: auto;
            height: 200px;
            background-color: rgb(237 237 237);
            padding: 7px;
            border-radius: 5px;
            text-align: justify;
            box-shadow: rgba(67, 71, 85, 0.27) 0px 0px 0.25em, rgba(90, 125, 188, 0.05) 0px 0.25em 1em;
        }

        .textdes::-webkit-scrollbar {
            width: 6px;
            background-color: #F5F5F5;
        }

        .textdes::-webkit-scrollbar-thumb {
            background-color: #cccccc;
            border-radius: 5px;
        }

        .butthemne {
            margin-top: 3px;
            position: relative;
            padding-left: 24px;
        }

        .iconthem {
            font-size: 24px;
            position: absolute;
            left: 0;
            top: 0.6px;
        }
    </style>
    @if (Session::has('alert_success'))
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
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="mt-0 header-title"><b>Danh mục sản phẩm</b></h4>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <select class="form-control" id="chondanhmuc" name="sortne">
                                    <option value="{{ Request::url() }}?danhsach=tatca" data-id="0">-- Chọn danh mục --
                                    </option>
                                    @foreach ($showdanhmuc as $showdm)
                                        <option value="{{ Request::url() }}?danhsach={{ $showdm->id }}"
                                            data-id="{{ $showdm->id }}">{{ $showdm->m_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary" id="btnlocsp">Lọc danh mục</button>
                            <button type="submit" class="btn btn-danger" id="btndeleteall">Xóa tất cả</button>
                        </div>
                    </div>
                    <div class=" tablesaw-bar  tablesaw-all-cols-visible  tablesaw-mode-columntoggle">
                        <table class="tablesaw table mb-0 tablesaw-columntoggle" data-tablesaw-mode="columntoggle"
                            data-tablesaw-mode-switch="" data-tablesaw-minimap="" id="tablesaw-7261" style="">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll" /></th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="persist"
                                        class=" tablesaw-swipe-cellpersist" style="width: 30px;">#</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-sortable-default-col=""
                                        data-tablesaw-priority="0" class="tablesaw-priority-0 tablesaw-toggle-cellvisible">
                                        Hình ảnh</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-sortable-default-col=""
                                        data-tablesaw-priority="1" class="tablesaw-priority-1" style="width: 10%">Danh mục</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="2"
                                        class="tablesaw-priority-2 tablesaw-toggle-cellvisible">Tên</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="3"
                                        class=" tablesaw-priority-3">Slug</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="4"
                                        class=" tablesaw-priority-4" style="width: 10%">Giá bán</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="5"
                                        class=" tablesaw-priority-5" style="width: 10%">Trạng thái</th>
                                    <th scope="col" data-tablesaw-sortable-col="" data-tablesaw-priority="6"
                                        class=" tablesaw-priority-6" style="width:306px;">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($datas as $key => $dt)
                                    <tr id="sid{{ $dt->id }}">
                                        <td><input type="checkbox" class="checkboxclass" name="ids"
                                                value="{{ $dt->id }}" data-id="{{ $dt->m_original_price }}"></td>
                                        <td class=" tablesaw-swipe-cellpersist" style="width: 30px;">{{ $i++ }}
                                        </td>
                                        <td class="tablesaw-priority-0 tablesaw-toggle-cellvisible">
                                            @if (json_decode($dt->m_picture))
                                                <img src="{{ asset('uploads') }}/{{ json_decode($dt->m_picture)[0] }}"
                                                    width="100px" height="100px" />
                                            @else
                                                <img src="{{ asset('uploads') }}/1657125436-sanpham.p1.jpg" width="100px"
                                                    height="100px" />
                                            @endif
                                        </td>
                                        <td class="tablesaw-priority-1 tablesaw-toggle-cellvisible">
                                            {{ $dt->showdanhmuc->m_title }}</td>
                                        <td class="tablesaw-priority-2 tablesaw-toggle-cellvisible">
                                            {{ $dt->m_product_name }}</td>
                                        <td class="tablesaw-priority-3 tablesaw-toggle-cellvisible">
                                            {{ $dt->m_product_slug }}</td>
                                        <td class="tablesaw-priority-4 tablesaw-toggle-cellvisible">
                                            {{ number_format($dt->m_original_price, 0, '.', '.') }} <sup>&#8363;</sup></td>
                                        <td class=" tablesaw-priority-5">
                                            @if ($dt->m_status == 1)
                                                <h4 class="badge badge-primary" style="padding:5px 10px;font-size:15px">Hiện
                                                </h4>
                                            @else
                                                <h4 class="badge badge-danger" style="padding:5px 10px;font-size:15px">Ẩn
                                                </h4>
                                            @endif
                                        </td>
                                        <td class=" tablesaw-priority-6" style="width: 306px;">
                                            <button class="btn btn-warning waves-effect waves-light btn-primary"
                                                data-toggle="modal"
                                                data-target=".bs-example-modal-xl{{ $dt->id }}"><i
                                                    class="fa fa-eye"></i></button>
                                            <a href="{{ route('product.edit', $dt->id) }}"
                                                class="btn btn-primary waves-effect width-md waves-light">Sửa</a>
                                            <a href="{{ route('product.destroy', $dt->id) }}"
                                                class="btn btn-danger waves-effect width-md waves-light btndelete">Xóa</a>
                                        </td>



                                        <div class="modal fade bs-example-modal-xl{{ $dt->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myExtraLargeModalLabel">Sản phẩm :
                                                            {{ $dt->m_product_name }}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-2">
                                                                <div class="phongnen">
                                                                    @if (json_decode($dt->m_picture))
                                                                        <img src="{{ asset('uploads') }}/{{ json_decode($dt->m_picture)[0] }}"
                                                                            alt="">
                                                                    @endif
                                                                </div>
                                                                <div class="form-group"
                                                                    style="text-align:center; margin:15px 0px 0px 0px">
                                                                    <p><a class="btn btn-primary waves-effect waves-light mr-1 collapsed"
                                                                            role="button" data-toggle="collapse"
                                                                            href="#collapseExample" aria-expanded="false"
                                                                            aria-controls="collapseExample"> Xem thêm hình
                                                                        </a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <h3><strong
                                                                        class="text-primary">{{ $dt->m_product_name }}</strong>
                                                                </h3>
                                                                <p>Slug: <span
                                                                        class="text-muted">{{ $dt->m_product_slug }}</span>
                                                                </p>
                                                                <p><strong>Danh mục:
                                                                    </strong><span>{{ $dt->showdanhmuc->m_title }}</span>
                                                                </p>
                                                                <p><strong>Giá gốc: </strong>
                                                                    @if ($dt->m_original_price)
                                                                        <s>{{ number_format($dt->m_price, 0, '.', '.') }}
                                                                            <sup>&#8363;</sup></s>
                                                                    @else
                                                                        <span>{{ number_format($dt->m_price, 0, '.', '.') }}
                                                                            <sup>&#8363;</sup></span>
                                                                    @endif
                                                                </p>
                                                                <p><strong>Giá đã giảm: </strong><mark id="price-giamgia"
                                                                        data-id="{{ $dt->m_original_price }}">{{ number_format($dt->m_original_price, 0, '.', '.') }}
                                                                        <sup>&#8363;</sup></mark></p>
                                                                {{-- <p><strong>Ngày đăng sản phẩm: </strong><span>{{$dt->updated_at->diffForHumans()}}</span></p> --}}
                                                                <p><strong>Số lượng tồn kho:
                                                                    </strong><span>{{ $dt->updatedsoluong1->sum('m_quanti') }}</span>
                                                                    |
                                                                    <strong>Lượt xem sản phẩm:
                                                                    </strong><span>{{ $dt->m_view }}</span>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <p><strong>Mô tả ngắn: </strong></p>
                                                                <div class="textdes">
                                                                    {!! $dt->m_short_description !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="collapse" id="collapseExample"
                                                                    style="">
                                                                    <div class="card-box">
                                                                        @if (json_decode($dt->m_picture))
                                                                            @foreach (json_decode($dt->m_picture) as $picture)
                                                                                <img src="{{ asset('uploads') }}/{{ $picture }}"
                                                                                    alt="" width="100px"
                                                                                    height="100px">
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="col-md-12">
                                                                <div class="textdes">
                                                                    {!! $dt->m_description !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </diV>
                                    </tr>
                                @endforeach
                                {{ $datas->links() }}
                            </tbody>
                        </table>
                    </div>
            </section>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <select class="form-control" id="sotiengiam">
                            <option value="1">Giảm theo %</option>
                            <option value="2">Giảm theo tiền</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="inputprice"
                            placeholder="Vui lòng nhập số tiền muốn giảm">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-dark" id="updateprice">Nhập</button>
                </div>
            </div>
        </div>
    </div>
    <!-- form-delete -->
    <form method="POST" action="" id="form-delete">
        @method('DELETE')
        @csrf
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/libs/tablesaw/tablesaw.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/tablesaw.init.js') }}"></script>
    <!-- javascript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <script>
        jQuery(document).ready(function($) {
            $('.btndelete').click(function(ev) {
                ev.preventDefault();
                var _href = $(this).attr('href');
                $('form#form-delete').attr('action', _href);
                alertify.confirm('Bạn muốn xóa sản phẩm này?', function(result) {
                    if (result) {
                        $('form#form-delete').submit();
                    }
                })
            });
            $('#checkAll').click(function() {
                $(".checkboxclass").prop('checked', $(this).prop('checked'));
            });
            $('#btndeleteall').click(function(e) {
                e.preventDefault();
                var allids = [];
                var _token = $('input[name="_token"]').val();
                $('input:checkbox[name=ids]:checked').each(function() {
                    allids.push($(this).val());
                });
                alert(allids);
                $.ajax({
                    url: "{{ route('deleteallsp') }}",
                    type: "delete",
                    data: {
                        _token: _token,
                        ids: allids
                    },
                    success: function(data) {
                        $.each(allids, function(key, val) {
                            $("#sid" + val).remove();
                        });
                        window.location.reload(true);
                    }
                });
            });
            $('#updateprice').click(function(e) {
                e.preventDefault();
                var allids = [];
                var priceold = [];
                var iddanhmuc = $('#chondanhmuc').find(':selected').data("id");
                var idsotiengiam = $('#sotiengiam').val();
                var inputprice = $('#inputprice').val();
                // var priceold = $('#price-giamgia').data('id');
                var _token = $('input[name="_token"]').val();
                $('input:checkbox[name=ids]:checked').each(function() {
                    allids.push($(this).val());
                    priceold.push($(this).data('id'));
                });
                // alert(iddanhmuc);
                // alert(idsotiengiam);
                // alert(inputprice);
                // alert(allids);
                // alert(_token);
                $.ajax({
                    url: "{{ route('capnhatprice') }}",
                    type: "post",
                    data: {
                        _token: _token,
                        iddanhmuc: iddanhmuc,
                        idsotiengiam: idsotiengiam,
                        inputprice: inputprice,
                        allids: allids,
                        priceold: priceold,
                    },
                    success: function(data) {
                        alert('Cập nhật giá thành công!');
                        window.location.reload(true);
                    }
                });
            });
        });
    </script>
    <script>
        jQuery(document).ready(function($) {
            $('#btnlocsp').click(function(e) {
                e.preventDefault();
                // var iddanhmuc = $('#chondanhmuc').find(':selected').data("id");
                var iddanhmuc = $('#chondanhmuc').val();
                // alert(iddanhmuc);
                if (iddanhmuc) {
                    window.location = iddanhmuc;
                }
                return false;
            });
            locdanhsach();

            function locdanhsach() {
                var url = window.location.href;
                $('select[name="sortne"]').find('option[value="' + url + '"]').attr("selected", true);
            };
        });
    </script>
@endpush
