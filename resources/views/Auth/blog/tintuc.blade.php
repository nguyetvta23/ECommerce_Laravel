@extends('Auth.layouts.master')
@section('title')
    Tin tức
@endsection
@push('scripts')
    <script>
        const loadBlog = (page) => {
            $.ajax({
                url: `{{ url('api/blog?page=') }}${page}`,
                type: "get",
                success: function(response) {
                    console.log("result", response);
                    let pagination = '';
                    let content = '';
                    const {
                        data,
                        links,
                        next_page_url,
                        prev_page_url
                    } = response;
                    data.map((item, index) => {
                        content += `<div class="col-xl-4 col-md-6">
                                <!-- blog single item start -->
                                <div class="blog-post-item mb-30">
                                    <div class="blog-thumb">
                                        <a href="{{ url('/blog-detail/') }}/${item.m_slug}">
                                            <img src="{{ URL::asset('uploads/post') }}/${item.m_image}" alt="blog thumb">
                                        </a>
                                    </div>
                                    <div class="blog-content">
                                        <h5 class="blog-title">
                                            <a href="{{ url('/blog-detail/') }}/${item.m_slug}">
                                                ${item.m_title.substring(0,60)}...
                                            </a>
                                        </h5>
                                        <ul class="blog-meta">
                                            <li><span>Tác giả: </span>${item.user.name}</li>
                                            <li><span>Thời gian: </span>${moment(item.created_at).format('DD/MM/YYYY')}</li>
                                        </ul>
                                        <a href="{{ url('/blog-detail/') }}/${item.m_slug}" class="read-more">Đọc thêm...</a>
                                    </div>
                                </div>
                                <!-- blog single item start -->
                            </div>`;
                    })
                    $('#list').html(content);
                    links.map((item, index) => {
                        if (item.label == '&laquo; Previous') {
                            pagination +=
                                `<li data-page=${item.url != null ? item.url.slice(-1): ""}><a class="Previous"><i class="ion-ios-arrow-left"></i></a></li>`
                        } else if (item.label == 'Next &raquo;') {
                            pagination +=
                                `<li data-page=${item.url != null ? item.url.slice(-1): ""}><a class="Next" href="#"><i class="ion-ios-arrow-right"></i></a></li>`
                        } else {
                            pagination +=
                                `<li data-page=${item.url.slice(-1)} class="${item.active ? 'active' : ''}"><a  href="#">${item.label}</a></li>`
                        }
                    })
                    $('.pagination-box').html(pagination);
                    $('.pagination-box li').click(function(e) {
                        e.preventDefault();
                        loadBlog($(this).data("page"))
                    });


                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
        loadBlog(1);
    </script>
@endpush
@section('content')
    <!-- main wrapper start -->
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area bg-img" data-bg="{{ URL::asset('Auth/img/banner/breadcrumb-banner.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap text-center">
                            <nav aria-label="breadcrumb">
                                <h1 class="breadcrumb-title">Tin tức</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Trang tin tức</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb area end -->

        <!-- blog main wrapper start -->
        <div class="blog-main-wrapper section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row" id="list">

                        </div>
                        <!-- start pagination area -->
                        <div class="paginatoin-area text-center">
                            <ul class="pagination-box">

                            </ul>
                        </div>
                        <!-- end pagination area -->
                    </div>
                </div>
            </div>
        </div>
        <!-- blog main wrapper end -->
    </main>
    <!-- main wrapper end -->
@endsection