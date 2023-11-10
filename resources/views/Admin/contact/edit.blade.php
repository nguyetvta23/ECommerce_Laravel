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
        <h3 class="card-title">Chi tiết phản hồi</h3>
    </div>
    <form class="form-horizontal" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Họ tên</label>
                <div class="col-sm-10" style="margin-top:7px;">
                    <span style="margin-top:7px;">{{$contact->m_name}}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10" style="margin-top:7px;">
                    <span>{{$contact->m_email}}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Số điện thoại</label>
                <div class="col-sm-10" style="margin-top:7px;">
                    <span>{{$contact->m_phone}}</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Tiêu đề</label>
                <div class="col-sm-10">
                    <textarea name="title" class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>{{$contact->m_title}}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Nội dung</label>
                <div class="col-sm-10">
                <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3" disabled>{{$contact->m_content}}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label">Trả lời *</label>
                <div class="col-sm-10">
                <textarea name="reply" class="ckeditor form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                @if ($errors->has('reply'))
                    <span style="font-size: 12px;" class="text-danger">{{ $errors->first('reply') }}</span>
                @endif
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">Gửi</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script src="http://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('noidung');
</script>
@endpush
