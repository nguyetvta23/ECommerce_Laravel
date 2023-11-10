@extends('Auth.layouts.master')
@section('title')
    Tin tức
@endsection
@push('scripts')
    <script>
        $.ajax({
            type: "get",
            url: "{{url('api/blog/'.$m_slug)}}",
            success: function (response) {
                console.log(response);
                $('.blog-author-title h5').text(response[0].user.name);
                $('.blog-widget-img img').attr('src', `{{asset('uploads/avatar/')}}/${response[0].user.m_avatar}`);
                $('.blog-thumb img').attr('src', `{{asset('uploads/post/')}}/${response[0].m_image}`);
                $('.blog-title').text(response[0].m_title);
                $('.blog-meta i').first().text(response[0].user.name);
                $('.blog-meta i').last().text(moment(response[0].created_at).format('DD/MM/YYYY'));
                $('.content').html(response[0].m_content);
            },
            error: function (error){
                console.log(error);
            }
        });
    </script>
@endpush
@section('content')
    <!-- main wrapper start -->
    <main>
        <!-- breadcrumb area start -->
        <div class="breadcrumb-area bg-img" data-bg="assets/img/banner/breadcrumb-banner.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap text-center">
                            <nav aria-label="breadcrumb">
                                <h1 class="breadcrumb-title">Tin tức</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                                    <li class="breadcrumb-item"><a href="blog-left-sidebar.html">Tin tức</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Chi tiết tin tức</li>
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
                    <div class="col-lg-3 order-2 order-lg-1">
                        <div class="blog-widget-wrapper">
                            <!-- widget item start -->
                            <div class="blog-widget">
                                <div class="blog-widget-img">
                                    <img src="" alt="author thumb" />
                                </div>
                                <div class="blog-author-title text-center">
                                    <h5>Erik Jhonson</h5>
                                    <span>Admin</span>
                                    
                                </div>
                            </div>
                            <!-- widget item end -->

                            <!-- widget item start -->
                            <div class="blog-widget">
                                <h4 class="blog-widget-title">Tìm kiếm</h4>
                                <form class="widget-search-form">
                                    <input placeholder="Tìm kiếm" type="text" class="search-field">
                                    <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <!-- widget item end -->

                            <!-- widget item start -->
                            <!-- <div class="blog-widget">
                                <h4 class="blog-widget-title">Recent Posts</h4>
                                <ul class="recent-posts-inner">
                                    <li class="recent-posts">
                                        <div class="recent-posts-image">
                                            <a href="blog-details.html"><img src="assets/img/blog/recent-01.jpg"
                                                    alt="post thumb"></a>
                                        </div>
                                        <div class="recent-posts-body">
                                            <span class="recent-posts-meta">February 13, 2018</span>
                                            <h6 class="recent-posts-title"><a href="blog-details.html">Diffrent title gose
                                                    This is demo</a></h6>
                                        </div>
                                    </li>
                                    <li class="recent-posts">
                                        <div class="recent-posts-image">
                                            <a href="blog-details.html"><img src="assets/img/blog/recent-02.jpg"
                                                    alt="post thumb"></a>
                                        </div>
                                        <div class="recent-posts-body">
                                            <span class="recent-posts-meta">February 13, 2018</span>
                                            <h6 class="recent-posts-title"><a href="blog-details.html">Diffrent title gose
                                                    This is demo</a></h6>
                                        </div>
                                    </li>
                                    <li class="recent-posts">
                                        <div class="recent-posts-image">
                                            <a href="blog-details.html"><img src="assets/img/blog/recent-03.jpg"
                                                    alt="post thumb"></a>
                                        </div>
                                        <div class="recent-posts-body">
                                            <span class="recent-posts-meta">February 13, 2018</span>
                                            <h6 class="recent-posts-title"><a href="blog-details.html">Diffrent title gose
                                                    This is demo</a></h6>
                                        </div>
                                    </li>
                                    <li class="recent-posts">
                                        <div class="recent-posts-image">
                                            <a href="blog-details.html"><img src="assets/img/blog/recent-04.jpg"
                                                    alt="post thumb"></a>
                                        </div>
                                        <div class="recent-posts-body">
                                            <span class="recent-posts-meta">February 13, 2018</span>
                                            <h6 class="recent-posts-title"><a href="blog-details.html">Diffrent title gose
                                                    This is demo</a></h6>
                                        </div>
                                    </li>
                                </ul>
                            </div> -->
                            <!-- widget item end -->

                            <!-- widget item start -->
                            <!-- <div class="blog-widget">
                                <h4 class="blog-widget-title">Categories</h4>
                                <ul class="blog-categories">
                                    <li><a href="blog-details.html">Shoes</a><span>(20)</span></li>
                                    <li><a href="blog-details.html">Fashion</a><span>(18)</span></li>
                                    <li><a href="blog-details.html">Wallet</a><span>(40)</span></li>
                                    <li><a href="blog-details.html">Life Style</a><span>(66)</span></li>
                                    <li><a href="blog-details.html">Electronics</a><span>(66)</span></li>
                                    <li><a href="blog-details.html">Jewellery & Cosmetics</a><span>(30)</span></li>
                                </ul>
                            </div> -->
                            <!-- widget item end -->

                            <!-- widget item start -->
                            <!-- <div class="blog-widget">
                                <h4 class="blog-widget-title">Tags</h4>
                                <div class="blog-tag">
                                    <a href="blog-details.html">Fashion</a>
                                    <a href="blog-details.html">Shoes</a>
                                    <a href="blog-details.html">Wallet</a>
                                    <a href="blog-details.html">Bags</a>
                                    <a href="blog-details.html">Jewelery</a>
                                </div>
                            </div> -->
                            <!-- widget item end -->
                        </div>
                    </div>
                    <div class="col-lg-9 order-1 order-lg-2">
                        <div class="row">
                            <div class="col-12">
                                <!-- blog single item start -->
                                <div class="blog-post-item">
                                    <div class="blog-thumb">
                                        <img src="" alt="blog thumb">
                                    </div>
                                    <div class="blog-content blog-details">
                                        <h5 class="blog-title">
                                            
                                        </h5>
                                        <ul class="blog-meta">
                                            <li><span>By: </span><i></i></li>
                                            <li><span>On: </span><i></i></li>
                                        </ul>
                                        <div class="content"></div>
                                    </div>
                                </div>
                                <!-- blog single item start -->

                                <!-- comment area start -->
                                <!-- <div class="comment-section section-padding">
                                    <h5>03 bình luận</h5>
                                    <ul>
                                        <li>
                                            <div class="author-avatar">
                                                <img src="assets/img/blog/comment-icon.png" alt="">
                                            </div>
                                            <div class="comment-body">
                                                <span class="reply-btn"><a href="#">Reply</a></span>
                                                <h5 class="comment-author">Datle</h5>
                                                <div class="comment-post-date">
                                                    19 - 05, 2022 at 9:30pm
                                                </div>
                                                <p>Rất ý nghĩa</p>
                                            </div>
                                        </li>
                                        <li class="comment-children">
                                            <div class="author-avatar">
                                                <img src="assets/img/blog/comment-icon.png" alt="">
                                            </div>
                                            <div class="comment-body">
                                                <span class="reply-btn"><a href="#">Reply</a></span>
                                                <h5 class="comment-author">Truongnguyen</h5>
                                                <div class="comment-post-date">
                                                    19 - 05, 2022 at 9:30pm
                                                </div>
                                                <p>Bài hay qua tôi đã học thêm được nhiều thứ.</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="author-avatar">
                                                <img src="assets/img/blog/comment-icon.png" alt="">
                                            </div>
                                            <div class="comment-body">
                                                <span class="reply-btn"><a href="#">Reply</a></span>
                                                <h5 class="comment-author">Nguyetvo</h5>
                                                <div class="comment-post-date">
                                                    19 - 05, 2022 at 9:30pm
                                                </div>
                                                <p>Rất hay </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div> -->
                                <!-- comment area end -->

                                <!-- start blog comment box -->
                                <!-- <div class="blog-comment-wrapper">
                                    <h5>Góp Ý</h5>
                                    <p>Địa chỉ email sẽ không được công bố. Các trường bắt buộc được đánh dấu *</p>
                                    <form action="#">
                                        <div class="comment-post-box">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label>Nhận xét</label>
                                                    <textarea name="commnet" placeholder="Write a comment"></textarea>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <label>Tên</label>
                                                    <input type="text" class="coment-field" placeholder="Name">
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <label>Email</label>
                                                    <input type="text" class="coment-field" placeholder="Email">
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <label>Website</label>
                                                    <input type="text" class="coment-field" placeholder="Website">
                                                </div>
                                                <div class="col-12">
                                                    <div class="coment-btn">
                                                        <input class="btn" type="submit" name="submit"
                                                            value="POST COMMENT">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div> -->
                                <!-- start blog comment box -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- blog main wrapper end -->
    </main>
    <!-- main wrapper end -->
@endsection