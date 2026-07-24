@extends('layouts.app')

@section('content')
<!-- Page Title Start -->
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li>{{ $category->name }}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Page Title End -->

<section class="utf_block_wrapper">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-12">

        <div class="block category-listing">

          <h3 class="utf_block_title">
            <span>{{ $category->name }} News</span>
          </h3>

          <ul class="subCategory unstyled">
            @foreach($categories as $cat)
            <li>
              <a href="">
                {{ $cat->name }}
              </a>
            </li>
            @endforeach
          </ul>

          <div class="row">

            @forelse($posts as $post)

            <div class="col-md-6">

              <div class="utf_post_block_style post-grid clearfix">

                <div class="utf_post_thumb">
                  <a href="#">
                    <img class="img-fluid"
                      src="{{ $post->image1 ? asset('storage/' . $post->image1) : asset('images/no-image.jpg') }}"
                      alt="{{ $post->title }}">
                  </a>
                </div>

                <a class="utf_post_cat" href="#">
                  {{ $post->category->name }}
                </a>

                <div class="utf_post_content">

                  <h2 class="utf_post_title title-large">
                    <a href="{{ route('posts.show', $post->slug) }}">
                      {{ Str::limit($post->title, 55) }}
                    </a>
                  </h2>

                  <div class="utf_post_meta">

                    <span class="utf_post_author">
                      <i class="fa fa-user"></i>
                      <a href="#">
                        {{ $post->author_name ?? $post->user->name }}
                      </a>
                    </span>

                    <span class="utf_post_date">
                      <i class="fa-regular fa-clock"></i>
                      {{ optional($post->published_at)->format('d M, Y') }}
                    </span>

                    <span class="post-comment pull-right">
                      <i class="fa fa-eye"></i>
                      {{ number_format($post->views) }}
                    </span>

                  </div>

                  <p>
                    {{ \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?? $post->content), 150) }}
                  </p>

                </div>

              </div>

            </div>

            @empty

            <div class="col-12">
              <div class="alert alert-info">
                No posts found in this category.
              </div>
            </div>

            @endforelse

          </div>

        </div>

        <div class="paging">
          {{ $posts->links() }}
        </div>

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

                @forelse($popularPosts as $post)

                <li class="clearfix">
                  <div class="utf_post_block_style post-float clearfix">

                    <div class="utf_post_thumb">
                      <a href="{{ route('posts.show', $post->slug) }}">
                        <img src="{{ asset('storage/'.$post->image1) }}"
                          alt="{{ $post->title }}">
                      </a>

                      @if($post->category)
                      <a class="utf_post_cat" href="#">
                        {{ $post->category->name }}
                      </a>
                      @endif
                    </div>

                    <div class="utf_post_content">

                      <h2 class="utf_post_title title-small">
                        <a href="{{ route('posts.show', $post->slug) }}">
                          {{ Str::limit($post->title, 55) }}
                        </a>
                      </h2>

                      <div class="utf_post_meta">

                        <span class="utf_post_author">
                          <i class="fa fa-user"></i>
                          {{ $post->author_name ?? $post->user->name }}
                        </span>

                        <span class="utf_post_date">
                          <i class="fa-regular fa-clock"></i>
                          {{ $post->published_at?->format('d M, Y') }}
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



          <div class="widget text-center"> <img class="banner img-fluid" src="images/banner-ads/ad-sidebar.png" alt="" /> </div>
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
<!-- /* Popular News Small Posts */ -->
<style>
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

  /* Category Listing */
  .category-listing .post-grid {
    background: #fff;
    border: none;
    box-shadow: none;
    margin-bottom: 35px;
    position: relative;
  }

  /* Image */
  .category-listing .post-grid .utf_post_thumb {
    position: relative;
    overflow: hidden;
    border-radius: 4px;
    margin-bottom: 18px;
  }

  .category-listing .post-grid .utf_post_thumb img {
    width: 100%;
    height: 240px;
    object-fit: cover;
    display: block;
  }

  /* Category Badge */
  /* .category-listing .post-grid .utf_post_cat{
    position:absolute;
    top:12px;
    left:12px;
    z-index:2;
    background:#f04d4d;
    color:#fff;
    font-size:11px;
    text-transform:uppercase;
    padding:5px 10px;
    border-radius:3px;
} */

  /* Content */
  .category-listing .utf_post_content {
    padding: 0;
  }

  /* Title */
  .category-listing .utf_post_title {
    margin-bottom: 10px;
    line-height: 1.4;
  }

  .category-listing .utf_post_title a {
    color: #222;
    font-size: 20px;
    font-weight: 500;
  }

  .category-listing .utf_post_title a:hover {
    color: #e74c3c;
  }

  /* Meta */
  .category-listing .utf_post_meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 18px;
    margin-bottom: 12px;
    font-size: 13px;
    color: #888;
  }

  .category-listing .utf_post_meta span {
    display: flex;
    align-items: center;
  }

  .category-listing .utf_post_meta i {
    margin-right: 6px;
    color: #ff4a57;
  }

  /* Excerpt */
  .category-listing p {
    color: #777;
    font-size: 15px;
    line-height: 1.8;
    margin: 0;
  }

  /* Grid spacing */
  .category-listing .row>.col-md-6 {
    margin-bottom: 25px;
  }

  /* ================= DARK MODE CATEGORY PAGE ================= */















  @media (min-width: 1200px) {
    .category-listing .post-grid .utf_post_thumb img {
      height: 390px;
    }
  }

  /* ==================== TABLET (992px - 1199px) ==================== */
  @media (max-width: 1199px) {
    .category-listing .utf_post_title a {
      font-size: 19px;
    }
  }

  /* ==================== MEDIUM TABLET (768px - 991px) ==================== */
  @media (max-width: 991px) {
    .category-listing .post-grid .utf_post_thumb img {
      height: 390px;
    }

    .category-listing .utf_post_title a {
      font-size: 18px;
    }

    /* Sidebar */
    .utf_sidebar_right {
      margin-top: 40px;
    }
  }

  /* ==================== SMALL TABLET / LARGE MOBILE (576px - 767px) ==================== */
  @media (max-width: 767px) {
    .category-listing .post-grid .utf_post_thumb img {
      height: 390px;
    }

    .category-listing .utf_post_title a {
      font-size: 17.5px;
      line-height: 24px;
    }

    .category-listing .utf_post_meta {
      font-size: 12.5px;
      gap: 12px;
    }

    .category-listing p {
      font-size: 14.5px;
      line-height: 1.7;
    }

    /* Popular Posts in Sidebar */
    .widget .utf_list_post .post-float .utf_post_thumb {
      width: 85px;
      min-width: 85px;
      height: 68px;
    }

    .widget .utf_list_post .post-float .utf_post_title {
      font-size: 12.5px;
      line-height: 19px;
    }
  }

  /* ==================== MOBILE PORTRAIT (< 576px) ==================== */
  @media (max-width: 575px) {
    .category-listing .post-grid .utf_post_thumb img {
      height: 390px;
    }

    .category-listing .utf_post_title a {
      font-size: 16.5px;
      line-height: 23px;
    }

    .category-listing .utf_post_meta {
      font-size: 12px;
      gap: 10px;
    }

    .category-listing p {
      font-size: 14px;
      line-height: 1.65;
    }

    /* Make grid full width on very small screens */
    .category-listing .row>.col-md-6 {
      width: 100%;
      flex: 0 0 100%;
      max-width: 100%;
    }

    /* Breadcrumb */
    .page-title .breadcrumb {
      font-size: 14px;
    }

    /* Sidebar widgets */
    .widget .utf_list_post .post-float .utf_post_thumb {
      width: 80px;
      min-width: 80px;
      height: 65px;
    }
  }

  /* ==================== EXTRA SMALL MOBILE (< 400px) ==================== */
  @media (max-width: 399px) {
    .category-listing .post-grid .utf_post_thumb img {
      height: 300px;
    }

    .category-listing .utf_post_title a {
      font-size: 16px;
    }

    .category-listing p {
      font-size: 13.5px;
    }
  }

  /* General Responsive Improvements */
  @media (max-width: 767px) {
    .utf_block_title span {
      font-size: 15px;
    }

    .utf_post_cat {
      font-size: 10.5px;
      padding: 4px 9px;
    }
  }

  img.img-fluid {
    max-width: 100%;
    height: auto;
  }
</style>
@endsection