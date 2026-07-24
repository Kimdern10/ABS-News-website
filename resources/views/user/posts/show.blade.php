@extends('layouts.app')

@section('content')
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="breadcrumb">
          <li>
            <a href="{{ url('/') }}">Home</a>
            <span>/</span>
            <span>{{ $post->category->name }}</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Page title end -->

<!-- 1rd Block Wrapper Start -->
<section class="utf_block_wrapper">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-12">
        <div class="single-post">
          <div class="utf_post_content-area">

            <div class="utf_post_title-area">

              @if($post->category)
              <a class="utf_post_cat"
                href="{{ route('category.page',$post->category->slug) }}">
                {{ $post->category->name }}
              </a>
              @endif

              <h2 class="utf_post_title">
                {{ $post->title }}
              </h2>

              <div class="utf_post_meta">

                <span class="utf_post_author">
                  Story By
                  <a href="#">
                    {{ $post->author_name ?? $post->user->name }}
                  </a>
                </span>

                <span class="utf_post_date">
                  <i class="fa-regular fa-clock"></i>
                  {{ optional($post->published_at)->format('d M, Y') }}
                </span>

                <span class="post-hits">
                  <i class="fa fa-eye"></i>
                  {{ $post->views }}
                </span>

                <span class="post-comment">
                  <i class="fa-regular fa-comments"></i>
                  <span>{{ $comments->count() }}
                  </span>

              </div>

            </div>

            <div class="utf_post_content-area">

              @if($post->image1)
              <div class="post-media post-featured-image">
                <a href="{{ asset('storage/'.$post->image1) }}" class="gallery-popup">
                  <img src="{{ asset('storage/'.$post->image1) }}"
                    class="img-fluid"
                    alt="{{ $post->title }}">
                </a>
              </div>
              @endif

              <div class="entry-content">

                {!! $post->excerpt !!}

                <div class="row mt-4 mb-4">

                  @if($post->image2)
                  <div class="col-md-6">
                    <a href="{{ asset('storage/'.$post->image2) }}" class="gallery-popup">
                      <img src="{{ asset('storage/'.$post->image2) }}"
                        class="img-fluid rounded">
                    </a>
                  </div>
                  @endif

                  @if($post->image3)
                  <div class="col-md-6">
                    <a href="{{ asset('storage/'.$post->image3) }}" class="gallery-popup">
                      <img src="{{ asset('storage/'.$post->image3) }}"
                        class="img-fluid rounded">
                    </a>
                  </div>
                  @endif

                </div>
                {!! $post->content !!}

                <div class="row mt-4">

                  @if($post->image4)
                  <div class="col-md-6">
                    <a href="{{ asset('storage/'.$post->image4) }}" class="gallery-popup">
                      <img src="{{ asset('storage/'.$post->image4) }}"
                        class="img-fluid rounded">
                    </a>
                  </div>
                  @endif

                  @if($post->image5)
                  <div class="col-md-6">
                    <a href="{{ asset('storage/'.$post->image5) }}" class="gallery-popup">
                      <img src="{{ asset('storage/'.$post->image5) }}"
                        class="img-fluid rounded">
                    </a>
                  </div>
                  @endif

                </div>

              </div>

            </div>
          </div>
        </div>

        <nav class="post-navigation clearfix">

          <div class="post-previous">

            @if($previousPost)
            <a href="{{ route('posts.show', $previousPost->slug) }}">
              <span>
                <i class="fa fa-angle-left"></i>
                Previous Post
              </span>

              <h3>{{ Str::limit($previousPost->title, 60) }}</h3>
            </a>
            @endif

          </div>

          <div class="post-next">

            @if($nextPost)
            <a href="{{ route('posts.show', $nextPost->slug) }}">
              <span>
                Next Post
                <i class="fa fa-angle-right"></i>
              </span>

              <h3>{{ Str::limit($nextPost->title, 60) }}</h3>
            </a>
            @endif

          </div>

        </nav>



        <div class="related-posts block">
    <h3 class="utf_block_title">
        <span>Related Posts</span>
    </h3>

    <div id="utf_latest_news_slide" class="owl-carousel owl-theme utf_latest_news_slide">

        @foreach($relatedPosts as $related)

        <div class="item">

            <div class="utf_post_block_style clearfix">

                <div class="utf_post_thumb">

                    <a href="{{ route('posts.show', $related->slug) }}">
                        <img
                            class="img-fluid related-landscape-img"
                            src="{{ asset('storage/' . $related->image1) }}"
                            alt="{{ $related->title }}">
                    </a>

                    @if($related->category)
                    <a class="utf_post_cat"
                       href="{{ route('category.page', $related->category->slug) }}">
                        {{ $related->category->name }}
                    </a>
                    @endif

                </div>

                <div class="utf_post_content">

                    <h2 class="utf_post_title title-medium">
                        <a href="{{ route('posts.show', $related->slug) }}">
                            {{ Str::limit($related->title, 45) }}
                        </a>
                    </h2>

                    <div class="utf_post_meta">
                        <span class="utf_post_date">
                         <i class="fa-regular fa-clock"></i>
                            {{ optional($related->published_at)->format('d M, Y') }}
                        </span>
                    </div>

                </div>

            </div>

        </div>

        @endforeach

    </div>
</div>

        <!-- Post comment start -->
        <!-- ================= COMMENTS ================= -->
        <div id="comments" class="comments-area block">

          <h3 class="utf_block_title">
            <span>{{ $comments->count() }} Comments</span>
          </h3>

          <ul class="comments-list">

            @forelse($comments as $comment)

            <li>

              <div class="comment">

                {{-- Avatar --}}
                @if($comment->user->Userprofile && $comment->user->Userprofile->profile_picture)

                <img class="comment-avatar"
                  src="{{ asset('Userprofile/'.$comment->user->Userprofile->profile_picture) }}"
                  alt="{{ $comment->user->name }}">

                @else

                <div class="comment-avatar avatar-icon">
                  <i class="fa-solid fa-circle-user"></i>
                </div>

                @endif

                <div class="comment-body">

                  <div class="meta-data">

                    <span class="comment-author">
                      {{ $comment->user->name }}
                    </span>

                    <span class="comment-date">
                      {{ $comment->created_at->diffForHumans() }}
                    </span>

                  </div>

                  <div class="comment-content">
                    <p>{{ $comment->content }}</p>
                  </div>

                  @auth

                  <a href="javascript:void(0)"
                    class="reply-btn"
                    onclick="document.getElementById('reply-{{ $comment->id }}').classList.toggle('d-none')">

                    <i class="fa-solid fa-reply"></i> Reply

                  </a>

                  <div id="reply-{{ $comment->id }}" class="d-none mt-2">

                    <form action="{{ route('comments.reply',$comment->id) }}" method="POST">

                      @csrf

                      <textarea
                        name="content"
                        class="form-control"
                        rows="2"
                        placeholder="Write your reply..."
                        required></textarea>

                      <button class="btn btn-primary btn-sm mt-2">
                        Reply
                      </button>

                    </form>

                  </div>

                  @endauth

                </div>

              </div>

              {{-- Replies --}}
              @if($comment->replies->count())

              <ul class="comments-reply">

                @foreach($comment->replies as $reply)

                <li>

                  <div class="comment reply-comment">

                    @if($reply->user->Userprofile && $reply->user->Userprofile->profile_picture)

                    <img class="comment-avatar"
                      src="{{ asset('Userprofile/'.$reply->user->Userprofile->profile_picture) }}"
                      alt="{{ $reply->user->name }}">

                    @else

                    <div class="comment-avatar avatar-icon">
                      <i class="fa-solid fa-circle-user"></i>
                    </div>

                    @endif

                    <div class="comment-body">

                      <div class="meta-data">

                        <span class="comment-author">
                          {{ $reply->user->name }}
                        </span>

                        <span class="comment-date">
                          {{ $reply->created_at->diffForHumans() }}
                        </span>

                      </div>

                      <div class="comment-content">
                        <p>{{ $reply->content }}</p>
                      </div>

                    </div>

                  </div>

                </li>

                @endforeach

              </ul>

              @endif

            </li>

            @empty

            <li class="text-center">
              <p>No comments yet. Be the first to comment.</p>
            </li>

            @endforelse

          </ul>

        </div>

        <!-- Comments Form Start -->
        <div class="comments-form">

          <h3 class="title-normal">Leave a Comment</h3>

          @if(auth()->check())

          <form method="POST"
            action="{{ route('comments.store',$post->id) }}">

            @csrf

            <div class="form-group">

              <textarea
                name="content"
                class="form-control"
                rows="6"
                placeholder="Write your comment..."
                required></textarea>

            </div>

            <button class="btn btn-primary">

              Post Comment

            </button>

          </form>

          @else

          <div class="alert alert-info">

            Please <a href="{{ route('login') }}">login</a> to comment.

          </div>

          @endif

        </div>
        <!-- Comments form end -->
      </div>

      <div class="col-lg-4 col-md-12">
        <div class="sidebar utf_sidebar_right">
          <div class="widget">
            <h3 class="utf_block_title"><span>Follow Us</span></h3>
            <ul class="social-icon">
              <ul>
                <li>
                  <a href="https://www.facebook.com/absradiotelevision" target="_blank" title="Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                  </a>
                </li>

                <li>
                  <a href="https://www.instagram.com/absradiotv" target="_blank" title="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                  </a>
                </li>

                <li>
                  <a href="https://x.com/absradiotv" target="_blank" title="X">
                    <i class="fa-brands fa-x-twitter"></i>
                  </a>
                </li>

                <li>
                  <a href="https://youtube.com/@absradiotelevision" target="_blank" title="YouTube">
                    <i class="fa-brands fa-youtube"></i>
                  </a>
                </li>
              </ul>
          </div>

          <div class="widget color-default">
            <h3 class="utf_block_title"><span>Popular News</span></h3>
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
                          <a href="#">
                            {{ $popularPost->author_name ?? $popularPost->user->name }}
                          </a>
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

          <div class="widget text-center"> <img class="banner img-fluid" src="images/banner-ads/ad-sidebar.png" alt="" /> </div>

          <!-- <div class="widget widget-tags">
            <h3 class="utf_block_title"><span>Popular Tags</span></h3>
            <ul class="unstyled clearfix">
              <li><a href="#">Business</a></li>
              <li><a href="#">Corporate</a></li>
              <li><a href="#">Services</a></li>
              <li><a href="#">Customer</a></li>
              <li><a href="#">Money</a></li>
              <li><a href="#">Health</a></li>
              <li><a href="#">Lifestyles</a></li>
              <li><a href="#">Traveling</a></li>
              <li><a href="#">Partners</a></li>
              <li><a href="#">Wordpress</a></li>
              <li><a href="#">Customer</a></li>
            </ul>
          </div> -->

          <div class="widget m-bottom-0">
            <h3 class="utf_block_title"><span>Newsletter</span></h3>

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
<!-- 1rd Block Wrapper End -->

<style>
  /* ===========================
   Post Details Styling
=========================== */

  .utf_post_content-area {
    overflow: hidden;
  }

  /* Featured Image */
  .post-featured-image {
    width: 100%;
    max-width: 600px;
    margin: 25px 0 35px;
  }

  .post-featured-image img {
    width: 100%;
    height: 500px;
    /* Square size */
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, .12);
    transition: .3s;
  }

  .post-featured-image img:hover {
    transform: scale(1.02);
  }

  /* Other Images */
  .entry-content .row {
    margin-top: 30px;
    margin-bottom: 30px;
  }

  .entry-content .col-md-6 {
    margin-bottom: 20px;
  }

  .entry-content .col-md-6 img {
    width: 100%;
    height: 380px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, .12);
    transition: .3s;
  }

  .entry-content .col-md-6 img:hover {
    transform: scale(1.03);
  }

  /* Paragraphs */

  .entry-content {
    font-size: 17px;
    line-height: 1.9;
    color: #444;
  }

  .entry-content p {
    margin-bottom: 22px;
  }

  /* Blockquote */

  .entry-content blockquote {
    margin: 30px 0;
    padding: 20px 30px;
    border-left: 5px solid #ff5722;
    background: #f8f8f8;
    font-style: italic;
    border-radius: 6px;
  }

  /* Lists */

  .entry-content ul {
    padding-left: 22px;
  }

  .entry-content li {
    margin-bottom: 10px;
  }

  /* Meta */

  .utf_post_meta {
    margin-bottom: 20px;
  }

  /* Title */

  .utf_post_title {
    font-size: 36px;
    font-weight: 700;
    line-height: 1.4;
    margin: 15px 0;
  }

  .widget .utf_list_post .post-float {
    display: flex;
    align-items: flex-start;
  }

  .widget .utf_list_post .post-float .utf_post_thumb {
    width: 95px;
    min-width: 95px;
    height: 75px;
    margin-right: 15px;
    overflow: hidden;
  }

  .widget .utf_list_post .post-float .utf_post_thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .widget .utf_list_post .post-float .utf_post_title {
    font-size: 13px;
    line-height: 20px;
    font-weight: 500;
  }

  .widget .utf_list_post .utf_post_meta,
  .widget .utf_list_post .utf_post_author,
  .widget .utf_list_post .utf_post_date {
    font-size: 10px;
  }

  /*==========================
POST NAVIGATION
===========================*/

  .post-navigation {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    border-top: 1px solid #e5e5e5;
    border-bottom: 1px solid #e5e5e5;
    padding: 30px 0;
    margin: 45px 0;
  }

  .post-navigation .post-previous,
  .post-navigation .post-next {
    width: 48%;
  }

  .post-navigation .post-next {
    text-align: right;
  }

  .post-navigation a {
    display: block;
    color: #222;
    text-decoration: none;
  }

  .post-navigation span {
    display: block;
    font-size: 12px;
    color: #888;
    margin-bottom: 12px;
  }

  .post-navigation span i {
    color: #888;
  }

  .post-navigation h3 {
    font-size: 16px;
    font-weight: 500;
    line-height: 1.45;
    margin: 0;
    color: #222;
    transition: .3s;
  }

  .post-navigation a:hover h3 {
    color: #e74c3c;
  }

  .comments-list,
  .comments-reply {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .comment {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 15px;
    padding: 12px;
    border: 1px solid #eee;
    border-radius: 8px;
    background: #fff;
  }

  .reply-comment {
    margin-left: 45px;
    padding: 10px;
    background: #fafafa;
  }

  .comment-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
  }

  .avatar-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f5f5f5;
  }

  .avatar-icon i {
    font-size: 45px;
    color: #b5b5b5;
  }

  .comment-body {
    flex: 1;
  }

  .meta-data {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 5px;
  }

  .comment-author {
    font-size: 15px;
    font-weight: 600;
    color: #222;
  }

  .comment-date {
    font-size: 12px;
    color: #888;
  }

  .comment-content p {
    margin: 0;
    font-size: 14px;
    line-height: 1.6;
    color: #555;
  }

  .reply-btn {
    display: inline-block;
    margin-top: 8px;
    font-size: 13px;
    color: #007bff;
    text-decoration: none;
    font-weight: 600;
  }

  .reply-btn:hover {
    color: #0056b3;
    text-decoration: none;
  }

  .comments-reply {
    margin-top: 10px;
    margin-left: 35px;
  }

  .comments-reply .comment-avatar {
    width: 38px;
    height: 38px;
  }

  .comments-reply .avatar-icon i {
    font-size: 38px;
  }

  .comments-reply .comment-content p {
    font-size: 13px;
  }



  /*==========================
RELATED POSTS
===========================*/
/* RELATED POSTS LANDSCAPE STYLE */
/* Related Posts Landscape Style */

.related-posts .utf_post_thumb {
    position: relative;
    overflow: hidden;
    border-radius: 4px;
}

.related-posts .related-landscape-img {
    width: 100% !important;
    height: 120px !important;
    object-fit: cover !important;
    display: block;
}

.related-posts .utf_post_cat {
    position: absolute;
    top: 10px;
    left: 10px;
    z-index: 9;
}

.related-posts .utf_post_title {
    font-size: 12px;
    line-height: 18px;
    margin-top: 10px;
}

.related-posts .utf_post_meta {
    margin-top: 8px;
}












  @media (min-width: 1200px) {
    .post-featured-image img {
      height: 550px;
    }
  }

  /* ==================== DESKTOP / LG ==================== */
  @media (max-width: 1199px) {
    .utf_post_title {
      font-size: 34px;
    }
  }

  /* ==================== TABLET (768px - 991px) ==================== */
  @media (max-width: 991px) {
    .post-featured-image img {
      height: 420px;
    }

    .entry-content .col-md-6 img {
      height: 380px;
    }

    .utf_post_title {
      font-size: 32px;
    }

    .post-navigation {
      padding: 25px 0;
      margin: 35px 0;
    }

@media (max-width: 991px) {
    .related-posts .utf_post_thumb img {
        height: 340px !important;
    }

    .related-posts .utf_post_title {
        font-size: 15px !important;
        line-height: 22px !important;
    }
}

  }

  /* ==================== SMALL TABLET / LARGE MOBILE (576px - 767px) ==================== */
  @media (max-width: 767px) {
    .post-featured-image img {
      height: 380px;
    }

    .entry-content .col-md-6 img {
      height: 380px;
    }

    .utf_post_title {
      font-size: 28px;
      line-height: 1.35;
    }

    .entry-content {
      font-size: 16.5px;
      line-height: 1.85;
    }

    .post-navigation {
      flex-direction: column;
      gap: 25px;
      padding: 25px 0;
    }

    .post-navigation .post-previous,
    .post-navigation .post-next {
      width: 100%;
    }

    .post-navigation .post-next {
      text-align: left;
    }

        .related-posts .utf_post_thumb img {
        height: 290px !important;
    }

    .related-posts .utf_post_title {
        font-size: 14px !important;
        line-height: 20px !important;
    }

    .related-posts .utf_post_date {
        font-size: 12px !important;
    }

  }

  /* ==================== MOBILE PORTRAIT (< 576px) ==================== */
  @media (max-width: 575px) {
    .post-featured-image img {
      height: 380px;
      border-radius: 10px;
    }

    .entry-content .col-md-6 img {
      height: 380px;
    }

    .utf_post_title {
      font-size: 26px;
      line-height: 1.3;
    }

    .entry-content {
      font-size: 16px;
      line-height: 1.8;
    }

    .utf_post_meta {
      flex-wrap: wrap;
      gap: 12px;
      font-size: 13.5px;
    }

    .post-navigation {
      padding: 20px 0;
      margin: 30px 0;
    }

    .post-navigation h3 {
      font-size: 15px;
    }



    /* Sidebar */
    .utf_sidebar_right {
      margin-top: 45px;
    }

        .related-posts .utf_post_thumb img {
        height: 290px !important;
    }

    .related-posts .utf_post_title {
        font-size: 14px !important;
        line-height: 20px !important;
    }

    .related-posts .utf_post_date {
        font-size: 12px !important;
    }
  }

  /* ==================== EXTRA SMALL MOBILE (< 400px) ==================== */
  @media (max-width: 399px) {
    .post-featured-image img {
      height: 290px;
    }

    .entry-content .col-md-6 img {
      height: 290px;
    }

    .utf_post_title {
      font-size: 24px;
    }

    .entry-content {
      font-size: 15.5px;
    }

        .related-posts .utf_post_thumb img {
        height: 260px !important;
    }

    .related-posts .utf_post_title {
        font-size: 10px !important;
        line-height: 13px !important;
    }

    .related-posts .utf_post_date {
        font-size: 9px !important;
    }

  }

  /* General Improvements */
  @media (max-width: 767px) {
    .utf_block_title span {
      font-size: 15px;
    }

    .utf_post_cat {
      font-size: 11px;
      padding: 5px 9px;
    }
  }

  img.img-fluid {
    max-width: 100%;
    height: auto;
  }

  /* ===========================
   Mobile Comments
=========================== */

  @media (max-width: 768px) {

    .comment {
      padding: 10px;
      gap: 10px;
      margin-bottom: 12px;
    }

    .comment-avatar {
      width: 40px;
      height: 40px;
    }

    .avatar-icon i {
      font-size: 40px;
    }

    .comment-author {
      font-size: 14px;
    }

    .comment-date {
      font-size: 11px;
    }

    .comment-content p {
      font-size: 13px;
      line-height: 1.5;
    }

    .reply-btn {
      font-size: 12px;
    }

    .comments-reply {
      margin-left: 20px;
      margin-top: 8px;
    }

    .comments-reply .comment {
      padding: 8px;
    }

    .comments-reply .comment-avatar {
      width: 34px;
      height: 34px;
    }

    .comments-reply .avatar-icon i {
      font-size: 34px;
    }

    .comments-reply .comment-author {
      font-size: 13px;
    }

    .comments-reply .comment-date {
      font-size: 10px;
    }

    .comments-reply .comment-content p {
      font-size: 12px;
      line-height: 1.4;
    }

    .comments-area .form-control {
      font-size: 13px;
    }

    .comments-area textarea {
      min-height: 70px;
    }

    .comments-area .btn {
      font-size: 12px;
      padding: 6px 14px;
    }

  }

  /* Small phones */

  @media (max-width:480px) {

    .comment {
      gap: 8px;
      padding: 8px;
    }

    .comment-avatar {
      width: 36px;
      height: 36px;
    }

    .avatar-icon i {
      font-size: 36px;
    }

    .comments-reply {
      margin-left: 15px;
    }

    .comments-reply .comment-avatar {
      width: 30px;
      height: 30px;
    }

    .comments-reply .avatar-icon i {
      font-size: 30px;
    }

    .comment-content p {
      font-size: 12px;
    }

  }
</style>
<script>
  $("#utf_latest_news_slide").owlCarousel({
    loop: true,
    margin: 20,
    nav: true,
    dots: false,
    responsive: {
        0: { items: 1 },
        576: { items: 2 },
        768: { items: 3 },
        992: { items: 4 }
    }
});
  </script>
@endsection