@extends('layouts.app')

@section('content')

<!-- Page title start -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <ul class="breadcrumb">
                    <li>
                        <a href="{{ url('/') }}">Home</a>
                        <span>/</span>
                        <span>Eyewitness News</span>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
<!-- Page title end -->

<section class="utf_block_wrapper">
    <div class="container">
        <div class="row">

            <!-- Main Content -->
            <div class="col-lg-8 col-md-12">

                <div class="single-post">

                    <div class="utf_post_content-area">

                        <div class="utf_post_title-area">

                            <a class="utf_post_cat">
                                Eyewitness News
                            </a>

                            <h2 class="utf_post_title">
                                {{ $news->title }}
                            </h2>

                            <div class="utf_post_meta">

                                <span class="utf_post_author">
                                    Story By
                                    <a href="#">
                                        {{ $news->user->name ?? 'Citizen Reporter' }}
                                    </a>
                                </span>

                                <span class="utf_post_date">
                                    <i class="fa-regular fa-clock"></i>
                                    {{ $news->created_at->format('d M, Y') }}
                                </span>

                                @if($news->location)
                                <span class="post-hits">
                                    <i class="fa fa-map-marker"></i>
                                    {{ $news->location }}
                                </span>
                                @endif

                            </div>

                        </div>

                        <div class="utf_post_content-area">

                            @if($news->image)
                            <div class="post-media post-featured-image">

                                <a href="{{ asset('storage/'.$news->image) }}" class="gallery-popup">

                                    <img src="{{ asset('storage/'.$news->image) }}"
                                        class="img-fluid"
                                        alt="{{ $news->title }}">

                                </a>

                            </div>
                            @endif

                            <div class="entry-content">

                                {!! nl2br(e($news->content)) !!}

                            </div>

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

                                @forelse($popularPosts as $popularPost)

                                <li class="clearfix">

                                    <div class="utf_post_block_style post-float clearfix">

                                        <div class="utf_post_thumb">

                                            <a href="{{ route('posts.show',$popularPost->slug) }}">
                                                <img class="img-fluid"
                                                    src="{{ asset('storage/'.$popularPost->image1) }}"
                                                    alt="{{ $popularPost->title }}">
                                            </a>

                                            @if($popularPost->category)
                                            <a class="utf_post_cat"
                                                href="{{ route('category.page',$popularPost->category->slug) }}">
                                                {{ $popularPost->category->name }}
                                            </a>
                                            @endif

                                        </div>

                                        <div class="utf_post_content">

                                            <h2 class="utf_post_title title-small">

                                                <a href="{{ route('posts.show',$popularPost->slug) }}">
                                                    {{ Str::limit($popularPost->title,55) }}
                                                </a>

                                            </h2>

                                            <div class="utf_post_meta">

                                                <span class="utf_post_author">
                                                    <i class="fa fa-user"></i>
                                                    {{ $popularPost->author_name ?? $popularPost->user->name }}
                                                </span>

                                                <span class="utf_post_date">
                                                    <i class="fa-regular fa-clock"></i>
                                                    {{ optional($popularPost->published_at)->format('d M, Y') }}
                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                </li>

                                @empty

                                <li>No popular news available.</li>

                                @endforelse

                            </ul>

                        </div>

                    </div>

                    <!-- Sidebar Banner -->
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
                                    Subscribe to the ABS Radio & Television newsletter to receive the latest
                                    breaking news, live updates, exclusive stories, programmes, and special
                                    announcements directly in your inbox.
                                </p>

                            </div>

                            <div class="utf_newsletter_form">

                                <form action="{{ route('newsletter.subscribe') }}" method="POST">

                                    @csrf

                                    <div class="form-group">

                                        <input
                                            type="email"
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

@endsection

<style>

/* Featured Image */
.post-featured-image img{
    width:100%;
    height:500px;
    object-fit:cover;
    border-radius:10px;
}

/* Title */
.utf_post_title{
    font-size:36px;
    font-weight:700;
    line-height:1.4;
    margin:15px 0;
}

/* Content */
.entry-content{
    font-size:18px;
    line-height:1.9;
    color:#444;
}

.entry-content p{
    margin-bottom:20px;
}

.utf_post_cat {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    height: 32px;
    padding: 0 15px;

    font-size: 14px;
    font-weight: 600;
    font-family: Arial, sans-serif;

    color: #fff;
    background: #e50914;

    text-transform: uppercase;
    text-decoration: none;

    border-radius: 4px;
    line-height: 1;

    transition: 0.3s ease;
}

.utf_post_cat:hover {
    background: #b20710;
    color: #fff;
}
/* ======================
LARGE DESKTOP
====================== */
@media (min-width:1200px){

    .post-featured-image img{
        height:550px;
    }

    .utf_post_title{
        font-size:40px;
    }

    .entry-content{
        font-size:19px;
    }

}

/* ======================
LAPTOP
====================== */
@media (max-width:1199px){

    .post-featured-image img{
        height:480px;
    }

    .utf_post_title{
        font-size:34px;
    }

}

/* ======================
TABLET
====================== */
@media (max-width:991px){

    .post-featured-image img{
        height:420px;
    }

    .utf_post_title{
        font-size:30px;
    }

    .entry-content{
        font-size:17px;
    }

}

/* ======================
MOBILE LANDSCAPE
====================== */
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
        line-height:1.8;
    }

    .utf_post_meta{
        font-size:13px;
    }

        .utf_post_cat {
        height: 28px;
        padding: 0 10px;
        font-size: 18px;
    }


}

/* ======================
MOBILE
====================== */
@media (max-width:575px){

    .post-featured-image img{
        height:390px;
    }

    .utf_post_title{
        font-size:20px;
    }

    .entry-content{
        font-size:15px;
    }

    .utf_post_meta{
        display:flex;
        flex-wrap:wrap;
        gap:10px;
    }

}

/* ======================
SMALL PHONES
====================== */
@media (max-width:399px){

    .post-featured-image img{
        height:360px;
    }

    .utf_post_title{
        font-size:18px;
    }

    .entry-content{
        font-size:14px;
    }

}

</style>