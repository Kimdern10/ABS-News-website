<div class="utf_main_nav_area clearfix utf_sticky">
  <div class="container">
    <div class="row align-items-center">

      <!-- Radio Button at Top-Most Left -->
      <div class="col-lg-1 col-2 d-none d-lg-flex align-items-center">
        <a href="#"
          id="radioToggle"
          class="nav-link radio-btn"
          style="font-size:1.6rem;padding:8px;">

          <i class="fa fa-broadcast-tower"></i>

        </a>
      </div>

      <!-- Logo -->
      <div class="logo">
        <a href="/">
          <img src="{{ asset('assets/images/ABS.png') }}" alt="ABS Logo" class="logo-img">
        </a>
      </div>

      @php
      $navbarCategories = $categories->take(4);
      $pageCategories = $categories->slice(4);
      @endphp

      <nav class="navbar navbar-expand-lg col-lg-7 col-12">

        <!-- Mobile Hamburger -->
        <button class="navbar-toggler mobile-hamburger"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation">

          <span class="navbar-toggler-icon"></span>

        </button>

        <!-- Navbar -->
        <div id="navbarSupportedContent"
          class="collapse navbar-collapse justify-content-center">

          <ul class="navbar-nav">

            <!-- Home -->
            <li class="nav-item active">
              <a href="{{ url('/') }}" class="nav-link">
                Home
              </a>
            </li>


            <!-- Mobile Live Radio -->
            <li class="nav-item d-lg-none">
              <a href="#"
                id="mobileRadioToggle"
                class="nav-link">

                <i class="fa fa-broadcast-tower text-danger"></i>
                <span class="ml-2">🔴 Live Radio</span>

              </a>
            </li>


            <!-- Categories From Admin Dashboard -->
            @foreach($navbarCategories as $category)

            <li class="nav-item">
              <a href="{{ route('category.page',$category->slug) }}"
                class="nav-link">

                {{ $category->name }}

              </a>
            </li>
            @endforeach




            <!-- MORE DROPDOWN -->
            <li class="nav-item dropdown">

              <a href="#"
                class="nav-link dropdown-toggle"
                data-toggle="dropdown">

                More

                <i class="fa fa-angle-down"></i>

              </a>

              <ul class="utf_dropdown_menu">

                <!-- About Us -->
                <li>
                  <a href="{{ route('aboutus') }}">
                    About Us
                  </a>
                </li>

                <li>
                  <a href="{{ route('contactus') }}">
                    Contact Us
                  </a>
                </li>

                <!-- Eye Witnesses -->
                <li>
                  <a href="{{ route('eyewitness.news') }}">
                    Eye Witnesses
                  </a>
                </li>

                <!-- Remaining Categories -->
                @foreach($pageCategories as $category)

                <li>

                  <a href="{{ route('category.page',$category->slug) }}">

                    {{ $category->name }}

                  </a>

                </li>

                @endforeach

              </ul>

            </li>

          </ul>

        </div>

      </nav>


      <!-- Right Side -->
      <div class="header-right d-flex align-items-center">

        <!-- Dark Mode -->
        <button id="darkModeToggle" class="header-icon-btn mr-2">
          <i class="fa-solid fa-moon" id="darkModeIcon"></i>
        </button>

<!-- Search -->
<button class="header-icon-btn mr-2" id="searchBtn">
    <i class="fa fa-search"></i>
</button>


<!-- Search Popup -->
<div class="utf_search_block" id="searchBox">

    <span class="utf_search_close">&times;</span>

    <form action="{{ route('search') }}" method="GET">

        <div class="mb-3">
            <input type="text"
                name="keyword"
                class="form-control"
                placeholder="Search news..."
                required>
        </div>


        <button type="submit" class="btn btn-danger w-100">
            <i class="fa fa-search"></i> Search
        </button>

    </form>

</div>

        <!-- User Profile Icon -->
        <div class="dropdown profile-dropdown">

          @auth
          @php($user = Auth::user())

          @if($user->Userprofile && $user->Userprofile->profile_picture)
          <img src="{{ asset('Userprofile/' . $user->Userprofile->profile_picture) }}"
            alt="{{ $user->name }}"
            class="rounded-circle"
            style="width:38px;height:38px;object-fit:cover;border:2px solid #fff;">
          @else
          <i class="fa-solid fa-circle-user" style="font-size:38px;"></i>
          @endif
          @else
          <i class="fa-solid fa-circle-user" style="font-size:38px;"></i>
          @endauth

          <ul class="utf_dropdown_menu">

            @auth

            @if(auth()->user()->hasAnyRole(['super-admin','admin','editor']))
            <li>
              <a href="{{ route('admin.dashboard') }}">
                <i class="fa fa-dashboard"></i>
                Dashboard
              </a>
            </li>
            @endif

            <li>
              <a href="{{ route('profile') }}">
                <i class="fa fa-user"></i>
                My Profile
              </a>
            </li>

            <li>
              <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">

                <i class="fa fa-sign-out"></i>
                Logout
              </a>

              <form id="logout-form"
                action="{{ route('logout') }}"
                method="POST"
                style="display:none;">
                @csrf
              </form>
            </li>

            @else

            <li>
              <a href="{{ route('login') }}">
                <i class="fa fa-sign-in"></i>
                Login
              </a>
            </li>

            <li>
              <a href="{{ route('sign-up') }}">
                <i class="fa fa-user-plus"></i>
                Sign Up
              </a>
            </li>

            @endauth

          </ul>

        </div>

      </div>

    </div>
  </div>
</div>


<!-- Live News + Eye Witnesses + Recent Video Bar -->
<div class="live-news-bar py-2">
  <div class="container">
    <div class="row align-items-center">

      <!-- Live News -->
      <div class="col-lg-5 col-md-6">

        @if($liveNews)

        <div class="d-flex align-items-center">

          <span class="badge badge-danger mr-2">
            🔴 LIVE NEWS
          </span>

          <a href="{{ route('live-news.show', $liveNews->slug) }}"
            class="text-danger font-weight-bold">

            {{ Str::limit($liveNews->title, 60) }}

          </a>

          <small class="ml-2 text-muted">
            {{ $liveNews->created_at->format('M d, Y h:i A') }}
          </small>

        </div>

        @endif

      </div>

      <!-- Eye Witnesses -->
      <div class="col-lg-4 col-md-6">

        @if($latestEyewitnessHeader)

        <div class="d-flex align-items-center">

          <div class="small-video-thumb mr-2"
            style="position:relative; width:80px;">

            <a href="{{ route('eyewitness.show', $latestEyewitnessHeader->id) }}">

              @if($latestEyewitnessHeader->image)

              <img src="{{ asset('storage/'.$latestEyewitnessHeader->image) }}"
                class="img-fluid"
                alt="{{ $latestEyewitnessHeader->title }}"
                style="width:80px;height:60px;object-fit:cover;">

              @else

              <img src="{{ asset('assets/images/no-image.jpg') }}"
                class="img-fluid"
                alt="No Image"
                style="width:80px;height:60px;object-fit:cover;">

              @endif

            </a>

          </div>

          <div>

            <strong>Eye Witness:</strong>

            <a href="{{ route('eyewitness.show', $latestEyewitnessHeader->id) }}"
              class="text-dark">

              {{ \Illuminate\Support\Str::limit($latestEyewitnessHeader->title, 25) }}

            </a>

            <br>

            <small class="text-muted">

              Posted by {{ $latestEyewitnessHeader->user->name ?? 'Anonymous' }}

              •

              {{ $latestEyewitnessHeader->created_at->diffForHumans() }}

            </small>

          </div>

        </div>

        @else

        <p class="text-muted">No eyewitness reports available.</p>

        @endif

      </div>



      <!-- Recent Video -->
      <div class="col-lg-3 col-md-12 mt-2 mt-md-0">

        @if($youtubeLive)

        <div id="openLivePlayer"
          class="small-video-box d-flex align-items-center"
          style="cursor:pointer;">

          <!-- Thumbnail -->
          <div class="small-video-thumb mr-3 position-relative">

            <img src="{{ asset('storage/'.$youtubeLive->thumbnail) }}"
              class="img-fluid rounded"
              alt="{{ $youtubeLive->title }}">

            <!-- Play Icon -->
            <span class="play-icon">
              <i class="fa fa-play"></i>
            </span>

          </div>

          <!-- Details -->
          <div class="flex-grow-1">

            <small class="font-weight-bold d-block mb-1">
              {{ $youtubeLive->title }}
            </small>

            <div class="d-flex align-items-center">

              <span class="badge badge-danger mr-2">
                🔴 LIVE
              </span>

              <i class="fab fa-youtube text-danger mr-1"
                style="font-size:18px;"></i>

              <span class="text-danger font-weight-bold">
                YouTube
              </span>

            </div>

          </div>

        </div>

        @else

        <div class="small-video-box d-flex align-items-center p-3">

          <div class="flex-grow-1 text-center">

            <i class="fab fa-youtube text-danger"
              style="font-size:30px;"></i>

            <p class="mb-0 mt-2 font-weight-bold">
              No Live Stream Now
            </p>

          </div>

        </div>

        @endif

      </div>

    </div>
  </div>
</div>



<style>
  /* ====================== DARK MODE ====================== */
  html,
  body {
    height: 100%;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    overflow-y: visible !important;
  }



  /* Ensure scrolling works */
  body,
  html {
    overflow-y: auto !important;
    -webkit-overflow-scrolling: touch;
  }



  .header-icon-btn {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    border: 1px solid #e5e5e5;
    background: #fff;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: .3s;
    margin-left: 10px;
    cursor: pointer;
  }

  .header-icon-btn:hover {
    background: #d71920;
    color: #fff;
    border-color: #d71920;
  }



  .logo img {
    max-height: 65px;
    /* Adjust between 55px–80px if needed */
    width: auto;
    display: block;
  }

  /* Profile Icon */

  .profile-btn {
    text-decoration: none !important;
    font-size: 18px;
  }


  .profile-btn i {
    font-size: 20px;
  }

  /* Logo */
  /*================ LOGO =================*/

  .logo {

    margin-right: 8px;

  }


  .logo img {

    max-height: 55px;
    width: auto;
    display: block;

  }



  /*================ NAVBAR =================*/

  .navbar {

    flex-wrap: nowrap;

  }


  /* .navbar-nav {

    align-items: flex-start;

  } */

  .utf_main_nav_area {
    margin-top: 15px;
  }

  .live-news-bar {
    margin-top: 15px;
    padding-top: 10px !important;
    padding-bottom: 10px !important;
  }

  .navbar .nav-link {

    font-size: 14px !important;
    padding: 8px 6px !important;

  }


  .navbar .nav-item {

    margin-right: 2px;

  }



  /*================ RIGHT ICONS =================*/

  .header-icon-btn {

    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 1px solid #e5e5e5;
    background: #fff;
    color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin-left: 3px;
    transition: .3s;

  }


  .header-icon-btn i {

    font-size: 14px;

  }


  .header-icon-btn:hover {

    background: #d71920;
    color: white;
    border-color: #d71920;

  }



  /*================ PROFILE =================*/

  .profile-btn {

    text-decoration: none !important;

  }


  .profile-btn i {

    font-size: 18px;

  }



  /*================ DROPDOWN =================*/

  .dropdown {

    position: relative;

  }


  .dropdown:hover .utf_dropdown_menu {

    display: block;

  }


  .utf_dropdown_menu {

    right: 0;
    left: auto;

  }



  /*================ KEEP EVERYTHING ON ONE LINE =================*/

  .utf_main_nav_area .row {

    flex-wrap: nowrap;
    align-items: center;

  }

  /* =========================
   LIVE NEWS BAR
========================= */
  .live-news-bar {
    background: #1e1e1e;
    border-top: 1px solid #333;
  }

  .live-news-bar .badge-danger {
    background: #dc3545;
    color: #fff;
  }

  .small-video-thumb {
    position: relative;
    width: 80px;
    overflow: hidden;
    border-radius: 4px;
  }

  .small-video-thumb img {
    width: 100%;
    height: 60px;
    object-fit: cover;
  }

  .play-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #fff;
    font-size: 18px;
  }

  .small-video-box img {
    width: 90px;
    height: 60px;
    object-fit: cover;
    border-radius: 4px;
  }

  .utf_search_block {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 420px;
    max-width: 95%;
    background: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, .3);
    z-index: 99999;
    display: none;
  }

  .utf_search_close {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 28px;
    cursor: pointer;
  }

  .utf_search_block input,
  .utf_search_block select {
    height: 48px;
  }






  /* =====================================
   DARK MODE NAVBAR
===================================== */





  /* =====================================
   PROFILE ICON DARK MODE
===================================== */
  /* ===================================
   LIVE NEWS BAR
=================================== */

  .live-news-bar {
    background: #1e1e1e;
    border-top: 1px solid #333;
    padding: 12px 0;
  }

  .live-news-bar .row {
    align-items: center;
  }

  .live-news-bar .col-lg-5,
  .live-news-bar .col-lg-4,
  .live-news-bar .col-lg-3 {
    margin-bottom: 0;
  }

  .small-video-thumb {
    position: relative;
    width: 80px;
    min-width: 80px;
  }

  .small-video-thumb img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    border-radius: 5px;
  }

  .play-icon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: #fff;
    font-size: 14px;
  }

  .live-news-bar strong,
  .live-news-bar small,
  .live-news-bar span {
    color: #fff;
  }

  .live-news-bar .text-muted {
    color: #ccc !important;
  }

  @media(max-width:991px) {

    .live-news-bar .col-lg-5,
    .live-news-bar .col-lg-4,
    .live-news-bar .col-lg-3 {
      margin-bottom: 10px;
    }

  }

  @media(max-width:767px) {

    .live-news-bar .row {
      display: block;
    }

    .live-news-bar .col-lg-5,
    .live-news-bar .col-lg-4,
    .live-news-bar .col-lg-3 {
      width: 100%;
      max-width: 100%;
      margin-bottom: 12px;
    }

  }


  /* MOBILE HEADER */
  @media (max-width: 991.98px) {

    .utf_main_nav_area .row {
      position: relative;
      display: flex;
      align-items: center;
      min-height: 70px;
    }



    /* Hamburger - LEFT */
    .mobile-hamburger {
      position: absolute;
      left: 10px;
      top: 50%;
      transform: translateY(-50%);
      z-index: 20;
      margin: 0;
    }

    /* Logo - CENTER */
    .logo {
      position: absolute;
      left: 40%;
      top: 50%;
      transform: translateX(-50%) translateY(-50%);
      z-index: 15;
      margin: 0;
      margin-top: 5px;
    }

    .logo img {
      max-height: 50px;
    }

    /* Icons - RIGHT */
    .header-right {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      display: flex;
      align-items: center;
      gap: 5px;
      z-index: 15;
    }

    /* Hide radio icon on mobile */
    .radio-btn,
    .col-2 {
      display: none !important;
    }

    /* Navbar takes no space */
    .navbar {
      position: static;
      flex: 1 1 100%;
      width: 100%;
      max-width: 100%;
    }

    /* Dropdown menu */
    .navbar {
      position: static;
    }

    .navbar-collapse {
      position: absolute !important;
      top: 70px;
      left: 0;
      right: 0;
      width: 100vw !important;
      max-width: 100vw !important;

      background: #fff;
      z-index: 99999;

      padding: 15px;
      border-top: 1px solid #eee;

      max-height: calc(100vh - 70px);
      overflow-y: auto;

      box-sizing: border-box;
    }

    .navbar-nav,
    .navbar-nav .nav-item,
    .navbar-nav .nav-link {
      width: 100%;
      display: block;

    }

    .navbar-nav .nav-link {
      padding: 14px 15px;
    }

    .navbar-nav {
      width: 100%;
    }

    .live-news-bar {
      position: relative;
      z-index: 1;
    }

    .navbar-collapse {
      z-index: 99999 !important;
    }

    .utf_main_nav_area .container {
      position: relative;
    }

    .navbar-collapse.show {
      display: block !important;
    }

    .navbar-collapse:not(.show) {
      display: none !important;
    }

    .navbar-nav {
      display: flex;
      flex-direction: column;
      width: 100%;
    }

    @media (max-width: 991.98px) {

      .navbar-nav {
        align-items: flex-start !important;
        width: 100%;
      }

      .navbar-nav .nav-item {
        width: 100%;
        text-align: left;
      }

      .navbar-nav .nav-link {
        justify-content: flex-start !important;
        text-align: left !important;
        font-weight: 500 !important;
        /* less bold */
        font-size: 15px !important;
        letter-spacing: 0;
      }

    }

    /* Dropdown arrow box */
    .navbar-nav .dropdown-toggle i {
      width: 28px;
      height: 28px;
      background: #f2f2f2;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 12px;
    }

    /* Mobile submenu */
    .utf_dropdown_menu {
      position: static !important;
      width: 100% !important;
      display: none;
      background: #fff;
      border: none;
      box-shadow: none;
      padding: 0;
      margin: 0;
    }

    .nav-item.show .utf_dropdown_menu {
      display: block !important;
    }

    .utf_dropdown_menu li {
      border-bottom: 1px solid #eee;
    }

    .utf_dropdown_menu li a {
      display: block;
      padding: 14px 25px;
      color: #1b2a41;
      background: #fff;
      font-size: 15px;
    }

    .utf_dropdown_menu li a:hover {
      background: #e60000;
      color: #fff !important;
    }

    /* Smaller icons */
    .header-icon-btn {
      width: 32px;
      height: 32px;
      margin: 0;
    }
  }

  /* Mobile - More menu only */
  @media (max-width:991.98px) {

    .navbar .utf_dropdown_menu {
      position: static !important;
      width: 100% !important;
    }

    /* Profile menu */
    .profile-dropdown .utf_dropdown_menu {
      position: absolute !important;
      top: 100%;
      right: 0;
      width: 180px !important;
      min-width: 180px;
      background: #1e1e1e;
      z-index: 99999;
      box-shadow: 0 5px 20px rgba(0, 0, 0, .3);
    }
    
  }

  @media (max-width:575.98px) {

    .live-news-bar .row {
      display: block;
    }

    .live-news-bar .row>div {
      width: 100%;
      max-width: 100%;
      margin-bottom: 10px;
    }

    .live-news-bar .d-flex,
    .small-video-box {
      display: flex;
      align-items: center;
      background: #2b2b2b;
      border-radius: 8px;
      padding: 8px;
    }

    .small-video-thumb {
      width: 75px;
      min-width: 75px;
      margin-right: 10px;
    }

    .small-video-thumb img {
      width: 75px;
      height: 55px;
      object-fit: cover;
    }

    .play-icon {
      width: 20px;
      height: 20px;
      font-size: 9px;
    }

    .live-news-bar strong,
    .live-news-bar .text-danger,
    .small-video-box small {
      font-size: 13px;
    }

    .live-news-bar small {
      font-size: 10px;
    }
  }

  @media (max-width:991.98px) {

    .navbar-nav,
    .navbar-nav .nav-item,
    .navbar-nav .nav-link {
      width: 100% !important;
      /* display: block !important; */
      white-space: nowrap !important;
    }

  }

  @media (max-width:991.98px) {

    .profile-dropdown .utf_dropdown_menu {
      right: 10px !important;
      top: 50px !important;
      z-index: 999999 !important;
    }

  }

  /* ==================== Mobile ==================== */
  @media (max-width: 767px) {

    .utf_search_block {
      width: 95%;
      padding: 20px;
      border-radius: 6px;
    }

    .utf_search_block input,
    .utf_search_block select {
      height: 44px;
      font-size: 14px;
      margin-bottom: 12px;
    }

    .utf_search_block .btn {
      width: 100%;
      height: 44px;
      font-size: 15px;
    }

    .utf_search_close {
      top: 8px;
      right: 12px;
      font-size: 24px;
    }

    .utf_search_block {
        width: calc(100% - 30px);
        max-width: 100%;
        padding: 25px;
        left: 50%;
        top: 50%;
        border-radius: 10px;
    }


    .utf_search_block input {
        width: 100%;
        height: 55px;
        font-size: 16px;
        padding: 10px 15px;
    }


    .utf_search_block .btn {
        width: 100%;
        height: 55px;
        font-size: 16px;
    }


    .utf_search_close {
        top: 10px;
        right: 15px;
        font-size: 28px;
    }

  }

  /* ==================== Small Mobile ==================== */
  @media (max-width: 575px) {

    .utf_search_block {
      width: calc(100% - 20px);
      padding: 18px;
    }

    .utf_search_block input,
    .utf_search_block select {
      height: 42px;
      font-size: 14px;
    }

    .utf_search_block .btn {
      height: 22px;
      font-size: 14px;
    }

    .utf_search_close {
      font-size: 22px;
    }

      .utf_search_block {
        width: calc(100% - 20px);
        padding: 20px;
    }


    .utf_search_block input {
        height: 300px;
        font-size: 15px;
    }


    .utf_search_block .btn {
        height: 30px;
        font-size: 15px;
    }

  }

  /* ==================== Extra Small Devices ==================== */
  @media (max-width: 400px) {

    .utf_search_block {
      padding: 15px;
    }

    .utf_search_block input,
    .utf_search_block select {
      height: 40px;
      font-size: 13px;
    }

    .utf_search_block .btn {
      height: 40px;
      font-size: 13px;
    }

    .utf_search_close {
      font-size: 20px;
    }

  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('darkModeToggle');
    const icon = document.getElementById('darkModeIcon');

    if (!toggleBtn || !icon) return;

    // Load saved mode
    if (localStorage.getItem('darkMode') === 'enabled') {
      document.body.classList.add('dark-mode');
      icon.classList.remove('fa-moon');
      icon.classList.add('fa-sun');
    } else {
      document.body.classList.remove('dark-mode');
      icon.classList.remove('fa-sun');
      icon.classList.add('fa-moon');
    }

    toggleBtn.addEventListener('click', function() {
      document.body.classList.toggle('dark-mode');

      if (document.body.classList.contains('dark-mode')) {
        icon.classList.remove('fa-moon');
        icon.classList.add('fa-sun');
        localStorage.setItem('darkMode', 'enabled');
      } else {
        icon.classList.remove('fa-sun');
        icon.classList.add('fa-moon');
        localStorage.setItem('darkMode', 'disabled');
      }

      // Force scroll fix
      document.documentElement.style.overflowY = 'auto';
      document.body.style.overflowY = 'auto';
    });

    $('#searchBtn').click(function() {
      $('#searchBox').fadeIn(200);
    });

    $('.utf_search_close').click(function() {
      $('#searchBox').fadeOut(200);
    });

    $(document).mouseup(function(e) {

      var box = $("#searchBox");

      if (!box.is(e.target) && box.has(e.target).length === 0) {
        box.fadeOut(200);
      }

    });
  });
</script>