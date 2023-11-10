@extends('admin.index')
@section('content')
@if(Session::has('alert_success'))
    <div class="alert alert-success" style="margin-top: 10px;">
        {!! Session::get('alert_success') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Thêm sản phẩm</h3>
    </div>
    <form action="{{route('product.store')}}" class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Tên sản phẩm</label>
                <div class="col-sm-10" style="">
                    <input type="text" class="form-control" name="m_product_name" placeholder="Nhập tên sản phẩm">
                    @error('m_product_name')
                        <ul class="parsley-errors-list filled" id="parsley-id-11" aria-hidden="false">
                            <li class="parsley-required">{{$message}}</li>
                        </ul>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Chọn Danh mục</label>
                <div class="col-sm-10" style="">
                    <select class="form-control" id="id_category" name="m_id_category">
                        @foreach($showcategory as $key => $show)
                            <option value="{{$show->id}}" {{($show->m_id_parent == 0) ? 'style=font-weight:bold':''}}>{{$show->m_title}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Giá gốc</label>
                <div class="col-sm-10" style="">
                    <input type="number" class="form-control" name="m_price" placeholder="Nhập giá sản phẩm">
                    @error('m_price')
                        <ul class="parsley-errors-list filled" id="parsley-id-11" aria-hidden="false">
                            <li class="parsley-required">{{$message}}</li>
                        </ul>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Giá ưu đãi</label>
                <div class="col-sm-10" style="">
                    <input type="number" class="form-control" name="m_original_price" placeholder="Nhập giá ưu đãi sản phẩm">
                    @error('m_original_price')
                        <ul class="parsley-errors-list filled" id="parsley-id-11" aria-hidden="false">
                            <li class="parsley-required">{{$message}}</li>
                        </ul>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Số lượng tồn kho</label>
                <div class="col-sm-10" style="">
                <a class="btn btn-primary waves-effect waves-light mr-1 collapsed" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Click để thêm size giày và số lượng tồn kho</a>
                    @error('m_buy')
                        <ul class="parsley-errors-list filled" id="parsley-id-11" aria-hidden="false">
                            <li class="parsley-required">{{$message}}</li>
                        </ul>
                    @enderror
                </div>
            </div>
            
            <div class="collapse" id="collapseExample" style="">
                <div class="card-box">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="33" id="idsize33" name="size[]">
                                    <label class="custom-control-label" for="idsize33">Size 33</label>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="soluong33" placeholder="Nhập số lượng tồn kho" readonly>
                                </div>
                            </div>
                            <!-- size 34 -->
                            <div class="col-md-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="idsize34" value="34" name="size[]">
                                    <label class="custom-control-label" for="idsize34">Size 34</label>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="soluong34" placeholder="Nhập số lượng tồn kho" readonly>
                                </div>
                            </div>
                            <!-- size 35 -->
                            <div class="col-md-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="idsize35" value="35" name="size[]">
                                    <label class="custom-control-label" for="idsize35">Size 35</label>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="soluong35" placeholder="Nhập số lượng tồn kho" readonly>
                                </div>
                            </div>
                            <!-- size 36 -->
                            <div class="col-md-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="idsize36" value="36" name="size[]">
                                    <label class="custom-control-label" for="idsize36">Size 36</label>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="soluong36" placeholder="Nhập số lượng tồn kho" readonly>
                                </div>
                            </div>
                            <!-- size 37 -->
                            <div class="col-md-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="idsize37" value="37" name="size[]">
                                    <label class="custom-control-label" for="idsize37">Size 37</label>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="soluong37" placeholder="Nhập số lượng tồn kho" readonly>
                                </div>
                            </div>
                            <!-- size 38 -->
                            <div class="col-md-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="idsize38" value="38" name="size[]">
                                    <label class="custom-control-label" for="idsize38">Size 38</label>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="soluong38" placeholder="Nhập số lượng tồn kho" readonly>
                                </div>
                            </div>
                            <!-- size 39 -->
                            <div class="col-md-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="idsize39" value="39" name="size[]">
                                    <label class="custom-control-label" for="idsize39">Size 39</label>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="soluong39" placeholder="Nhập số lượng tồn kho" readonly>
                                </div>
                            </div>
                            <!-- size 40 -->
                            <div class="col-md-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="idsize40" value="40" name="size[]">
                                    <label class="custom-control-label" for="idsize40">Size 40</label>
                                </div>
                            </div>
                            <div class="col-md-11">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="soluong40" placeholder="Nhập số lượng tồn kho" readonly>
                                </div>
                            </div>
                        </div>
                    </div>              
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Hình ảnh sản phẩm</label>
                <div class="col-sm-10" style="">
                    <input type="file" name="file_upload[]" class="form-control" placeholder="Nhập hình ảnh sản phẩm" multiple>
                    @error('file_upload')
                        <ul class="parsley-errors-list filled" id="parsley-id-11" aria-hidden="false">
                            <li class="parsley-required">{{$message}}</li>
                        </ul>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Mô tả ngắn</label>
                <div class="col-sm-10">
                    <textarea class="ckeditor form-control" name="m_short_description" placeholder="Nhập mô tả ngắn sản phẩm"></textarea>
                    @error('m_short_description')
                        <ul class="parsley-errors-list filled" id="parsley-id-11" aria-hidden="false">
                            <li class="parsley-required">{{$message}}</li>
                        </ul>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Mô tả sản phẩm</label>
                <div class="col-sm-10">
                    <textarea class="ckeditor form-control" name="m_description" placeholder="Nhập mô tả sản phẩm"></textarea>
                    @error('m_description')
                        <ul class="parsley-errors-list filled" id="parsley-id-11" aria-hidden="false">
                            <li class="parsley-required">{{$message}}</li>
                        </ul>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Ẩn / Hiện</label>
                <div class="col-sm-10" style="">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="m_status" value="2">
                        <label class="form-check-label" for="flexRadioDefault1">
                            Ẩn 
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="m_status" value="1" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Hiện
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-right mb-0">
            <button type="submit" class="btn btn-info">Thêm</button>
            <button type="reset" class="btn btn-secondary waves-effect waves-light">Hủy</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="http://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('noidung');
</script>
<script type="text/javascript">
    CKEDITOR.replace('motangan');
</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        // size 33
        $(document).on('click','#idsize33', function(){
            var idsize = $(this).is(':checked') ? true:false;
            if(idsize == true){
                $('#soluong33').prop('readonly', false);
                $('#soluong33').prop('name', 'soluong[]');
            }else{
                $('#soluong33').prop('readonly', true);
                $('#soluong33').prop('value', '');
            }
        });
        // size 34
        $(document).on('click','#idsize34', function(){
            var idsize = $(this).is(':checked') ? true:false;
            if(idsize == true){
                $('#soluong34').prop('readonly', false);
                $('#soluong34').prop('name', 'soluong[]');
            }else{
                $('#soluong34').prop('readonly', true);
                $('#soluong34').prop('value', '');
            }
        });
        // size 35
        $(document).on('click','#idsize35', function(){
            var idsize = $(this).is(':checked') ? true:false;
            if(idsize == true){
                $('#soluong35').prop('readonly', false);
                $('#soluong35').prop('name', 'soluong[]');

            }else{
                $('#soluong35').prop('readonly', true);
                $('#soluong35').prop('value', '');
            }
        });
        // size 36
        $(document).on('click','#idsize36', function(){
            var idsize = $(this).is(':checked') ? true:false;
            if(idsize == true){
                $('#soluong36').prop('readonly', false);
                $('#soluong36').prop('name', 'soluong[]');
            }else{
                $('#soluong36').prop('readonly', true);
                $('#soluong36').prop('value', '');
            }
        });
        // size 37
        $(document).on('click','#idsize37', function(){
            var idsize = $(this).is(':checked') ? true:false;
            if(idsize == true){
                $('#soluong37').prop('readonly', false);
                $('#soluong37').prop('name', 'soluong[]');
            }else{
                $('#soluong37').prop('readonly', true);
                $('#soluong37').prop('value', '');
            }
        });
        // size 38
        $(document).on('click','#idsize38', function(){
            var idsize = $(this).is(':checked') ? true:false;
            if(idsize == true){
                $('#soluong38').prop('readonly', false);
                $('#soluong38').prop('name', 'soluong[]');
            }else{
                $('#soluong38').prop('readonly', true);
                $('#soluong38').prop('value', '');
            }
        });
        // size 39
        $(document).on('click','#idsize39', function(){
            var idsize = $(this).is(':checked') ? true:false;
            if(idsize == true){
                $('#soluong39').prop('readonly', false);
                $('#soluong39').prop('name', 'soluong[]');
            }else{
                $('#soluong39').prop('readonly', true);
                $('#soluong39').prop('value', '');
            }
        });
        // size 40
        $(document).on('click','#idsize40', function(){
            var idsize = $(this).is(':checked') ? true:false;
            if(idsize == true){
                $('#soluong40').prop('readonly', false);
                $('#soluong40').prop('name', 'soluong[]');
            }else{
                $('#soluong40').prop('readonly', true);
                $('#soluong40').prop('value', '');
            }
        });
    });
</script>
@endpush
