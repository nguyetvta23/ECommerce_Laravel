@extends('admin.index')
@section('content')
<div class="content">
    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#exampleModalCenter">Thêm danh mục</button>
    <div class="row mt-3">
        @foreach($categorySelect as $item)
        <div style="height: 50px; width: 100%; background-color:#ffffff; padding: 15px; margin-left:10px; margin-right: 10px; margin-top: 5px;">
            <div class="title" style="float: left">
                {{$item->m_title}}
            </div>
            <div class="action" style="float:right">
                <i data-id="{{$item->id}}" class='fa fa-pencil-alt item-edit-btn text-primary' title='Sửa danh mục'></i>&nbsp;&nbsp;<i data-id="{!! $item->id !!}" onclick="deleteData({{$item->id}})" class='fa fa-trash item-delete-btn ml-2 mr-2 text-danger' title='Xóa danh mục'>
            </i>
            </div>
        </div>
        @if(count($item->children) > 0)
        @foreach($item->children as $sub)
        <div style="margin-left: 25px; height: 50px; width: 100%; background-color:#ffffff; padding: 15px; margin-right: 10px; margin-top: 5px">
            <div class=" title" style="float:left">
            {{$sub->m_title}}
        </div>
        <div class="action" style="float:right">
        
            <i data-id="{{$sub->id}}" class='fa fa-pencil-alt item-edit-btn text-primary' title='Sửa danh mục'></i>&nbsp;&nbsp;<i data-id="{!! $sub->id !!}" onclick="deleteData({{$sub->id}})" class='fa fa-trash item-delete-btn ml-2 mr-2 text-danger' title='Xóa danh mục'>
        </i>

        </div>
    </div>
    @endforeach
    @endif
    @endforeach
</div>
<div class=" modal fade" id="themmoi" tabindex="-1" role="dialog" aria-labelledby="themoi" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="formEditCategory" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Sửa danh mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                
                    <input name="idEdit" id="idEdit" type="hidden">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Danh mục gốc</label>
                        <div class="col-sm-8">
                            <select name="parentEditCategory" class="browser-default custom-select" id="parentEditCategory">
                                <option value="0" selected>Chọn danh mục gốc</option>
                                @foreach($categorySelect as $cate)
                                <option value="{{$cate->id}}">{{$cate->m_title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Tên danh mục *</label>
                        <div class="col-sm-8">
                            <input type="text" name="nameEditCategory" class="form-control" id="nameEditCategory" placeholder="Tên danh mục">
                            <span style="font-size: 12px;" class="text-danger" id="nameErrorMsg"></span>
                        </div>
                    </div>
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <!-- <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Thứ tự *</label>
                        <div class="col-sm-8">
                            <input type="number" name="numberEditCategory" class="form-control" id="numberEditCategory" placeholder="Thứ tự">
                            <span style="font-size: 12px;" class="text-danger" id="numberErrorMsg"></span>
                        </div>
                    </div> -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" id="edit-category" class="btn btn-primary edit-category">Cập nhật</button>
                    </div>
            </form>
        </div>
    </div>
</div> -->
</div>
<div class=" modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="formCategory" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm mới danh mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Danh mục gốc</label>
                        <div class="col-sm-8">
                            <select name="parentCategory" class="browser-default custom-select" id="parentCategory">
                                <option value="0" selected>Chọn danh mục gốc</option>
                                @foreach($categorySelect as $cate)
                                <option value="{{$cate->id}}">{{$cate->m_title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-sm-4 col-form-label">Tên danh mục *</label>
                        <div class="col-sm-8">
                            <input type="text" name="nameCategory" class="form-control" id="nameCategory" placeholder="Tên danh mục">
                            <span style="font-size: 12px;" class="text-danger" id="nameErrorMsg"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary add-category">Lưu</button>
                    </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script type="text/javascript">
    //Add category
    $('#formCategory').on('submit', function(event) {
        event.preventDefault();
        nameCategory = $('#nameCategory').val();
        parentCategory = $('#parentCategory').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name=" csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/admintrator/category/add",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}",
                nameCategory: nameCategory,
                parentCategory: parentCategory,
            },
            success: function(results) {
                swal("Thành công", results.message, "success");
                location.reload();
            },
            error: function() {
                swal({
                    title: 'Đã xảy ra lỗi ...',
                    type: 'error',
                    timer: '1500'
                })
            }
        });
    });
    //Update category
    $(document).ready(function() {
        $('.edit-category').click(function() {
            event.preventDefault();
            nameEditCategory = $('#nameEditCategory').val();
            parentEditCategory = $('#parentEditCategory').val();
            id = $('#idEdit').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/admintrator/category/" + id + "/edit",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    nameEditCategory: nameEditCategory,
                    parentEditCategory: parentEditCategory,
                },
                success: function(results) {
                    swal("Thành công!", results.message, "success");
                    location.reload();
                },
                error: function() {
                    swal({
                        title: 'Đã xảy ra lỗi ...',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });
        });
    });

    //Edit category
    $(document).ready(function() {
        $('.item-edit-btn').click(function() {
            $('#themmoi').modal('show')

            var id = $(this).data('id');
            var url = '/admintrator/category/' + id + '/edit'
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: 'GET',
                url: url,
                data:{_token:_token},
                success: function(data) {
                    $('#nameEditCategory').val(data.category.m_title);
                    $('#parentEditCategory').val(data.category.m_id_parent);
                    $('#idEdit').val(data.category.id);
                }
            });
        });
    });
</script>
@endpush