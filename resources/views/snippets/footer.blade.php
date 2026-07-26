<footer id="footer" class="footer">
  <div class="utf_footer_main">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-sm-12 col-xs-12 footer-widget contact-widget">
          <h3 class="widget-title">About ABS</h3>

          <ul>
            <li>
              Anambra Broadcasting Service (ABS) is the official broadcasting network of Anambra State, delivering trusted news, quality entertainment, educational programmes, and public service content through radio, television, and digital platforms.
            </li>

            <li>
              <i class="fa fa-home"></i>
              Awka: Enugu-Onitsha Express Way, Near Aroma Junction, Awka, Anambra State.
            </li>

            <li>
              <i class="fa fa-home"></i>
              Onitsha: Oraifite Street, Awada Layout, Onitsha, Anambra State.
            </li>

            <li>
              <i class="fa fa-broadcast-tower"></i>
              ABS FM 88.5 (Awka) | ABS FM 90.7 (Onitsha)
            </li>

            <li>
              <i class="fa fa-television"></i>
              ABS TV Channel 24 (Awka) | Channel 27 (Onitsha), NigComSat: Channel Frequency 2, Frequency: 12.731 GHz, Polarization: Horizontal (H) Symbol Rate: 26250 KBPS
            </li>

            <li>
              <i class="fa fa-globe"></i>
              <a href="https://www.absradiotv.com" target="_blank">
                www.absradiotv.com
              </a>
            </li>

            <li>
              <i class="fa-regular fa-envelope"></i>
              <a href="mailto:absradiotv@yahoo.com">
                absradiotv@yahoo.com
              </a>
            </li>
          </ul>
          <ul class="unstyled utf_footer_social">
            <ul>
              <li>
                <a title="Facebook" href="https://www.facebook.com/absradiotelevision" target="_blank">
                  <i class="fa-brands fa-facebook-f"></i>
                </a>
              </li>

              <li>
                <a title="Instagram" href="https://www.instagram.com/absradiotv" target="_blank">
                  <i class="fa-brands fa-instagram"></i>
                </a>
              </li>

              <li>
                <a title="X (Twitter)" href="https://x.com/absradiotv" target="_blank">
                  <i class="fa-brands fa-x-twitter"></i>
                </a>
              </li>

              <li>
                <a title="YouTube" href="https://youtube.com/@absradiotelevision" target="_blank">
                  <i class="fa-brands fa-youtube"></i>
                </a>
              </li>
            </ul>
        </div>

        <div class="col-lg-4 col-sm-12 col-xs-12 footer-widget widget-categories">
          <h3 class="widget-title">Popular Categories</h3>

          <ul>
            @foreach($categories as $category)
            <li>
              <i class="fa fa-angle-double-right"></i>

              <a href="{{ route('category.page', $category->slug) }}">
                <span class="catTitle">{{ $category->name }}</span>

                <span class="catCounter">
                  ({{ $category->posts()->count() }})
                </span>
              </a>
            </li>
            @endforeach
          </ul>
        </div>

        <div class="col-lg-4 col-sm-12 col-xs-12 footer-widget">
          <h3 class="widget-title">Popular Post</h3>

          <div class="utf_list_post_block">
            <ul class="utf_list_post">

              @foreach($popularPosts->take(3) as $post)

              <li class="clearfix">
                <div class="utf_post_block_style post-float clearfix">

                  <div class="utf_post_thumb">
                    <a href="{{ route('posts.show', $post->slug) }}">
                      <img class="img-fluid"
                        src="{{ asset('storage/'.$post->image1) }}"
                        alt="{{ $post->title }}">
                    </a>
                  </div>

                  <div class="utf_post_content">

                    <h2 class="utf_post_title title-small">
                      <a href="{{ route('posts.show', $post->slug) }}">
                        {{ Str::limit($post->title, 55) }}
                      </a>
                    </h2>

                    <div class="utf_post_meta">
                      <span class="utf_post_date">
                        <i class="fa-regular fa-clock"></i>
                        {{ $post->published_at?->format('d M, Y') }}
                      </span>
                    </div>

                  </div>

                </div>
              </li>

              @endforeach

            </ul>
          </div>
        </div>
      </div>
</footer>

<div class="copyright">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12 text-center">
        <div class="utf_copyright_info">
          <span>
            Copyright &copy; {{ date('Y') }}
            <strong>ABS Radio & Television</strong>.
            All Rights Reserved.
          </span>
        </div>
      </div>
    </div>

    <div id="back-to-top" class="back-to-top">
      <button class="btn btn-primary" title="Back to Top">
        <i class="fa fa-angle-up"></i>
      </button>
    </div>
  </div>
</div>

<style>
/* Footer Popular Posts */
.footer-widget .utf_list_post {
    margin: 0;
    padding: 0;
    list-style: none;
}

.footer-widget .utf_list_post li {
    margin-bottom: 18px;
}

.footer-widget .utf_list_post .post-float {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.footer-widget .utf_list_post .utf_post_thumb {
    width: 95px;
    min-width: 95px;
    height: 75px;
    border-radius: 6px;
    overflow: hidden;
    flex-shrink: 0;
}

.footer-widget .utf_list_post .utf_post_thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: .3s;
}

.footer-widget .utf_list_post .utf_post_thumb:hover img {
    transform: scale(1.08);
}

.footer-widget .utf_post_content {
    flex: 1;
}

.footer-widget .utf_post_title {
    font-size: 14px;
    line-height: 22px;
    font-weight: 600;
    margin-bottom: 8px;
}

.footer-widget .utf_post_title a {
    color: #fff;
    text-decoration: none;
    transition: .3s;
}

.footer-widget .utf_post_title a:hover {
    color: #d71920;
}

.footer-widget .utf_post_meta {
    font-size: 12px;
    color: #bdbdbd;
}

.footer-widget .utf_post_meta i {
    margin-right: 5px;
    color: #d71920;
}

/* Footer background logo */
#footer {
    position: relative;
    background-image: url('{{ asset("assets/images/ABS.png") }}');
    background-repeat: no-repeat;
    background-position: center;
    background-size: 350px;
    background-blend-mode: overlay;
    background-color: rgba(0,0,0,0.85);
}

#footer::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.75);
    z-index: 0;
}

#footer .container {
    position: relative;
    z-index: 1;
}
</style>