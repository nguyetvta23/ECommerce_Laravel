@extends('admin.index')
@section('title')
    Quản trị danh mục
@endsection
@section('content')
<div class="content ">
    <button type="button" class="btn btn-info btn-xs" id="sa-success">Thành công</button>
    <button type="button" class="btn btn-info btn-xs" id="sa-params">Xóa</button>
    

    <!-- Thêm danh mục  -->
    <button class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#modalAdd">Thêm danh
        mục</button>

    <div id="modalAdd" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Thêm danh mục</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="admin-category-add-parent">Danh mục gốc</label>
                                <select class="form-control" id="admin-category-add-parent">
                                    <option value='0'>Thư mục cha</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nameCategory">...</label>
                                <input type="text" required="" class="form-control" id="admin-category-add-name"
                                    placeholder="Tên danh mục mới">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect btn-close"
                        data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light"
                        id='admin-category-add-btn'>Thêm</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- Thêm danh mục  -->


    <!-- Sửa danh mục  -->
    <div id="modalEdit" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Thêm danh mục</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="admin-category-edit-parent">Danh mục gốc</label>
                                <select class="form-control" id="admin-category-edit-parent">
                                    <option value='0'>Thư mục cha</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nameCategory">...</label>
                                <input type="text" required="" class="form-control" id="nameCategory"
                                    placeholder="Tên danh mục mới">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light">Thêm</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- Sửa danh mục  -->


    <!-- Danh sách danh mục  -->

    <ul class="list-group list-group-flush mt-3 h4" id="admin-category-list-content">
    </ul>

    <!-- Danh sách danh mục  -->
    @endsection