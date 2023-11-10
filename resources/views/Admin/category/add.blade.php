@extends('admin.index')
@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Tạo mới danh mục</h3>
    </div>
    <form class="form-horizontal" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Danh mục gốc</label>
                <div class="col-sm-10">
                    <select name="parent" class="browser-default custom-select">
                        <option value="0" selected>Chọn danh mục gốc</option>
                            @foreach($categorySelect as $cate)
                            <option value="{{$cate->id}}">{{$cate->m_title}}</option>
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Tên danh mục *</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="inputPassword3" placeholder="Tên danh mục">
                    @if ($errors->has('name'))
                        <span style="font-size: 12px;" class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Thứ tự *</label>
                <div class="col-sm-10">
                    <input type="number" name="index" class="form-control" id="inputPassword3" placeholder="Thứ tự">
                    @if ($errors->has('index'))
                        <span style="font-size: 12px;" class="text-danger">{{ $errors->first('index') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Lưu</button>
        </div>
    </form>
</div>
@endsection