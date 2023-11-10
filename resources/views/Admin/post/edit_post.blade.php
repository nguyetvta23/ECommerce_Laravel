@extends('admin.index')
@push('scripts')
    <!-- dropify js -->
    <script src="{{ asset('admin/assets/libs/dropify/dropify.min.js') }}"></script>
    <script src="http://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('m_desc');
        CKEDITOR.replace('m_content');
    </script>
    <script>
        const renderPost = () => {
            $.ajax({
                type: "get",
                url: "{{ url('api/post/' . $data['id']) }}",
                success: function(response) {
                    $('input[name=m_title]').val(response.m_title);
                    $('input[name=m_slug]').val(response.m_slug);
                    $('input[name=m_slug]').data('slug', response.m_slug);
                    CKEDITOR.instances.m_desc.setData(response.m_desc);
                    CKEDITOR.instances.m_content.setData(response.m_content);
                    $('input[name=m_meta_keyword]').val(response.m_meta_keyword);
                    $('input[name=m_meta_desc]').val(response.m_meta_desc);
                    response.m_status == 0 ? $('#hidden').prop("checked", true) : '';
                    $('.dropify').attr('data-default-file',
                        `{{ asset('uploads/post/${response.m_image}') }}`)
                    $('.dropify').dropify({
                        messages: {
                            'default': 'Drag and drop a file here or click',
                            'replace': 'Drag and drop or click to replace',
                            'remove': 'Remove',
                            'error': 'Ooops, something wrong appended.'
                        },
                        error: {
                            'fileSize': 'The file size is too big (1M max).'
                        }
                    });
                },
                error: function(error) {
                    toastr.error('Lỗi lấy thông tin bài viết!')
                }
            });
        }
        renderPost();

        $('.form-horizontal:first').submit(function(e) {
            e.preventDefault();
            let data = new FormData(this);
            console.log($('input[name=m_slug]').data('slug'))
            data.set('m_desc', CKEDITOR.instances.m_desc.getData());
            data.set('m_content', CKEDITOR.instances.m_content.getData());
            $.ajax({
                url: '{{ url('api/post/' . $data['id']) }}',
                type: 'post',
                data,
                processData: false,
                contentType: false,
                success: function(response) {
                    toastr.success('Sửa thành công!', 'Xem danh sách để kiểm tra'),
                        renderPost();
                    ["m_title", "m_slug", "m_desc", "m_content", "m_meta_keyword", "m_meta_desc",
                        "m_image"
                    ].map((item) => {
                        $(`.${item}`).empty();
                    })
                },
                error: function(error) {
                    console.log(error);
                    ["m_title", "m_slug", "m_desc", "m_content", "m_meta_keyword", "m_meta_desc",
                        "m_image"
                    ].map((item) => {
                        $(`.${item}`).empty();
                    })
                    let validate = error.responseJSON.errors;
                    for (const key in validate) {
                        console.log("key", key);
                        let content = '';
                        validate[key].map((item) => {
                            content += `<li>${item}</li>`
                        })
                        $(`.${key}`).html(content)
                    }
                    toastr.error('Lỗi sửa bài viết!', 'Vui lòng kiểm tra lại thông tin')
                }
            });
        });
    </script>
@endpush
@push('styles')
    <!-- dropify -->
    <link href="{{ asset('admin/assets/libs/dropify/dropify.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-12">
                                <div class="p-2">
                                    <form class="form-horizontal" role="form" enctype="multipart/form-data"
                                        method="POST">
                                        @csrf
                                        @method('put')
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">Tiêu đề</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Nhập tiêu đề"
                                                    name="m_title">
                                                <ul class="parsley-errors-list m_title">
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">Slug</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Nhập slug"
                                                    name="m_slug">
                                                <ul class="parsley-errors-list m_slug">
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">Tóm tắt bài viết</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" id="m_desc" rows="5" placeholder="Nhập tóm tắt bài viết" name="m_desc"></textarea>
                                                <ul class="parsley-errors-list m_desc">
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">Nội dung bài viết</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" id="m_content" rows="5" placeholder="Nhập nội dung bài viết" name="m_content"></textarea>
                                                <ul class="parsley-errors-list m_content">
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">Meta từ khóa</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Nhập meta từ khóa"
                                                    name="m_meta_keyword">
                                                <ul class="parsley-errors-list m_meta_keyword">
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">Meta nội dung</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="Nhập meta nội dung"
                                                    name="m_meta_desc">
                                                <ul class="parsley-errors-list m_meta_desc">
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">Trạng thái hiển thị</label>
                                            <div class="col-md-10 row mt-1">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="hidden" name="m_status" value="0"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label" for="hidden">Ẩn</label>
                                                </div>
                                                <div class="custom-control custom-radio ml-4">
                                                    <input type="radio" id="show" name="m_status" value="1"
                                                        class="custom-control-input" @checked(true)>
                                                    <label class="custom-control-label" for="show">Hiện</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label">Hình ảnh</label>
                                            <div class="col-md-4">
                                                <div class="card-box">
                                                    <input type="file" name="m_image" class="dropify"
                                                        data-default-file="" />
                                                    <ul class="parsley-errors-list m_image">
                                                    </ul>
                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                        <div class="form-group text-right mb-0">
                                            <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
                                                Sửa bài viết
                                            </button>
                                            <button type="reset" class="btn btn-secondary waves-effect waves-light">
                                                Hủy
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <!-- end row -->

                    </div> <!-- end card-box -->
                </div><!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
