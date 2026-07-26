@extends('layouts.app')

@section('content')

<!-- Page Title Start -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                        <span>/</span>
                        <span>Live News</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page Title End -->

<section class="utf_block_wrapper">

    <div class="container">

        <div class="row">

            <!-- Main Content -->
            <div class="col-lg-8 col-md-12">

                <div class="single-post">

                    <div class="utf_post_content-area">

                        <div class="utf_post_title-area">

                            @if($liveNews->is_live)
                                <a class="utf_post_cat bg-danger">
                                    🔴 LIVE NEWS
                                </a>
                            @endif

                            <h2 class="utf_post_title">
                                {{ $liveNews->title }}
                            </h2>

                            <div class="utf_post_meta">

                                <span class="utf_post_date">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $liveNews->created_at->format('d M, Y h:i A') }}
                                </span>

                            </div>

                        </div>

                        @if($liveNews->image)

                        <div class="post-media post-featured-image">

                            <a href="{{ asset('storage/'.$liveNews->image) }}"
                                class="gallery-popup">

                                <img src="{{ asset('storage/'.$liveNews->image) }}"
                                    class="img-fluid"
                                    alt="{{ $liveNews->title }}">

                            </a>

                        </div>

                        @endif

                        <div class="entry-content">

                            {!! nl2br(e($liveNews->content)) !!}

                        </div>

                    </div>

                </div>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 col-md-12">

                <div class="sidebar utf_sidebar_right">

                    <!-- Follow Us -->
                    <div class="widget">

                        <h3 class="utf_block_title">
                            <span>Follow Us</span>
                        </h3>

                        <ul class="social-icon">

                            <li>
                                <a href="https://www.facebook.com/absradiotelevision" target="_blank">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            </li>

                            <li>
                                <a href="https://www.instagram.com/absradiotv" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            </li>

                            <li>
                                <a href="https://x.com/absradiotv" target="_blank">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                            </li>

                            <li>
                                <a href="https://youtube.com/@absradiotelevision" target="_blank">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                            </li>

                        </ul>

                    </div>

                    <!-- Popular News -->
                    <div class="widget color-default">

                        <h3 class="utf_block_title">
                            <span>Popular News</span>
                        </h3>

                        <div class="utf_list_post_block">

                            <ul class="utf_list_post">

                                @forelse($popularPosts as $post)

                                <li class="clearfix">

                                    <div class="utf_post_block_style post-float clearfix">

                                        <div class="utf_post_thumb">

                                            <a href="{{ route('posts.show',$post->slug) }}">
                                                <img src="{{ asset('storage/'.$post->image1) }}"
                                                    alt="{{ $post->title }}">
                                            </a>

                                            @if($post->category)
                                            <a class="utf_post_cat">
                                                {{ $post->category->name }}
                                            </a>
                                            @endif

                                        </div>

                                        <div class="utf_post_content">

                                            <h2 class="utf_post_title title-small">

                                                <a href="{{ route('posts.show',$post->slug) }}">
                                                    {{ Str::limit($post->title,55) }}
                                                </a>

                                            </h2>

                                            <div class="utf_post_meta">

                                                <span class="utf_post_date">
                                                    <i class="fa-regular fa-clock"></i>
                                                    {{ optional($post->published_at)->format('d M, Y') }}
                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                </li>

                                @empty

                                <li>No popular news found.</li>

                                @endforelse

                            </ul>

                        </div>

                    </div>

                    <!-- Advertisement -->
                    <div class="widget text-center">

                        <img class="banner img-fluid"
                            src="{{ asset('images/banner-ads/ad-sidebar.png') }}"
                            alt="">

                    </div>

                    <!-- Newsletter -->
                    <div class="widget m-bottom-0">

                        <h3 class="utf_block_title">
                            <span>Newsletter</span>
                        </h3>

                        <div class="utf_newsletter_block">

                            <div class="utf_newsletter_introtext">

                                <h4>Stay Updated with ABS</h4>

                                <p>
                                    Subscribe to receive the latest breaking news,
                                    live updates, exclusive stories and programmes.
                                </p>

                            </div>

                            <div class="utf_newsletter_form">

                                <form action="{{ route('newsletter.subscribe') }}" method="POST">

                                    @csrf

                                    <div class="form-group">

                                        <input type="email"
                                            name="email"
                                            class="form-control form-control-lg"
                                            placeholder="Enter your email address"
                                            required>

                                        <button type="submit" class="btn btn-primary">
                                            Subscribe
                                        </button>

                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<style>

/* Featured Image */
.post-featured-image img{
    width:100%;
    height:500px;
    object-fit:cover;
    border-radius:12px;
    box-shadow:0 8px 20px rgba(0,0,0,.12);
}

/* Title */
.utf_post_title{
    font-size:36px;
    font-weight:700;
    line-height:1.4;
}

/* Content */
.entry-content{
    font-size:18px;
    line-height:1.9;
    color:#444;
}

.entry-content p{
    margin-bottom:22px;
}

/* Sidebar Popular News */
.widget .utf_list_post .post-float{
    display:flex;
}

.widget .utf_list_post .utf_post_thumb{
    width:95px;
    min-width:95px;
    height:75px;
    margin-right:15px;
    overflow:hidden;
}

.widget .utf_list_post .utf_post_thumb img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* Fix date/time position */
.utf_post_title-area {
    position: relative;
    margin-bottom: 25px;
}

.utf_post_meta {
    position: relative !important;
    z-index: 5;
    display: block;
    margin-top: 15px;
    margin-bottom: 25px;
    background: transparent;
}

.utf_post_date {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    color: #777;
}


/* Make sure image stays below */
.post-featured-image {
    position: relative;
    z-index: 1;
    margin-top: 20px;
}

.post-featured-image img {
    display: block;
}

/* Large Desktop */
@media (min-width:1200px){

    .post-featured-image img{
        height:550px;
    }

    .utf_post_title{
        font-size:40px;
    }
}

/* Laptop */
@media (max-width:1199px){

    .post-featured-image img{
        height:480px;
    }

    .utf_post_title{
        font-size:34px;
    }
}

/* Tablet */
@media (max-width:991px){

    .post-featured-image img{
        height:420px;
    }

    .utf_post_title{
        font-size:30px;
    }

    .utf_sidebar_right{
        margin-top:40px;
    }

     .utf_post_title-area {
        margin-bottom: 20px;
    }

    .utf_post_meta {
        position: relative !important;
        display: block;
        margin-top: 10px;
        margin-bottom: 20px;
        padding: 0;
    }

    .utf_post_date {
        font-size: 13px;
        display: inline-flex;
        align-items: center;
    }

    .post-featured-image {
        margin-top: 15px;
    }
}

/* Mobile */
@media (max-width:767px){

    .post-featured-image img{
        height:390px;
    }

    .utf_post_title{
        font-size:22px;
        line-height:1.3;
    }

    .entry-content{
        font-size:16px;
        margin-top: 15px; 
    }

        .utf_post_meta {
        margin-top: 12px;
        margin-bottom: 20px;
    }

    .utf_post_date {
        font-size: 12px;
    }

    .post-featured-image img {
        height: 390px;
    }
}

/* Small Mobile */
@media (max-width:575px){

    .post-featured-image img{
        height:390px;
    }

    .utf_post_title{
        font-size:22px;
    }

    .entry-content{
        font-size:15px;
    }

      .utf_post_title-area {
        padding-bottom: 10px;
    }

    .utf_post_meta {
        clear: both;
        position: relative !important;
    }

    .utf_post_date {
        font-size: 11px;
    }
}

/* Extra Small */
@media (max-width:399px){

    .post-featured-image img{
        height:390px;
    }

    .utf_post_title{
        font-size:18px;
    }
}

</style>

@endsection