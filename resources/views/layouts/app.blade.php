<head>

<base href="/public">

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="theme-color" content="#ec0000">


<!-- ================= PAGE SEO OVERRIDE ================= -->
@yield('meta_tags')


@if (!View::hasSection('meta_tags'))

<!-- ================= BASIC SEO ================= -->

<title>{{ $globalSeo->default_title ?? config('app.name') }}</title>

<meta name="description" content="{{ $globalSeo->meta_description ?? '' }}">

<meta name="keywords" content="{{ $globalSeo->meta_keywords ?? '' }}">

<meta name="author" content="{{ $globalSeo->author ?? '' }}">

<meta name="robots" content="{{ $globalSeo->robots_meta ?? 'index, follow' }}">

<link rel="canonical" href="{{ $globalSeo->canonical_url ?? url()->current() }}">



<!-- ================= OPEN GRAPH ================= -->

<meta property="og:title" 
content="{{ $globalSeo->og_title ?? $globalSeo->default_title ?? config('app.name') }}">

<meta property="og:description" 
content="{{ $globalSeo->og_description ?? $globalSeo->meta_description ?? '' }}">

<meta property="og:type" 
content="{{ $globalSeo->og_type ?? 'website' }}">

<meta property="og:url" 
content="{{ url()->current() }}">


@if(!empty($globalSeo?->og_image))

<meta property="og:image" 
content="{{ asset('storage/'.$globalSeo->og_image) }}">

<meta property="og:image:secure_url" 
content="{{ asset('storage/'.$globalSeo->og_image) }}">

@endif



<!-- ================= TWITTER CARD ================= -->

<meta name="twitter:card" 
content="{{ $globalSeo->twitter_card ?? 'summary_large_image' }}">


<meta name="twitter:title" 
content="{{ $globalSeo->twitter_title ?? $globalSeo->default_title ?? config('app.name') }}">


<meta name="twitter:description" 
content="{{ $globalSeo->twitter_description ?? $globalSeo->meta_description ?? '' }}">


@if(!empty($globalSeo?->twitter_image))

<meta name="twitter:image" 
content="{{ asset('storage/'.$globalSeo->twitter_image) }}">

@elseif(!empty($globalSeo?->og_image))

<meta name="twitter:image" 
content="{{ asset('storage/'.$globalSeo->og_image) }}">

@endif


@if(!empty($globalSeo?->twitter_site))

<meta name="twitter:site" 
content="{{ $globalSeo->twitter_site }}">

@endif


@if(!empty($globalSeo?->twitter_creator))

<meta name="twitter:creator" 
content="{{ $globalSeo->twitter_creator }}">

@endif



<!-- ================= OPEN GRAPH EXTRA ================= -->

<meta property="og:locale" 
content="{{ $globalSeo->og_locale ?? 'en_US' }}">


@endif



<!-- ================= FAVICON ================= -->

@if(!empty($globalSeo?->favicon))

<link rel="icon" type="image/png" 
href="{{ asset('storage/'.$globalSeo->favicon) }}">

@endif



<!-- ================= GOOGLE VERIFICATION ================= -->

@if(!empty($globalSeo?->google_verification))

<meta name="google-site-verification" 
content="{{ $globalSeo->google_verification }}">

@endif



<!-- ================= GOOGLE ANALYTICS ================= -->

@if(!empty($globalSeo?->google_analytics_id))

<script async src="https://www.googletagmanager.com/gtag/js?id={{ $globalSeo->google_analytics_id }}"></script>

<script>
window.dataLayer = window.dataLayer || [];

function gtag(){
dataLayer.push(arguments);
}

gtag('js', new Date());

gtag('config','{{ $globalSeo->google_analytics_id }}');
</script>

@endif



<!-- ================= ORGANIZATION SCHEMA ================= -->

@if(!empty($globalSeo?->site_logo))

<script type="application/ld+json">
{
"@context":"https://schema.org",
"@type":"Organization",
"name":"{{ $globalSeo->site_name ?? config('app.name') }}",
"url":"{{ url('/') }}",
"logo":"{{ asset('storage/'.$globalSeo->site_logo) }}"
}
</script>

@endif



<!-- ================= CSS ================= -->

<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/owl.theme.default.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/css/colorbox.css') }}">



<!-- Google Fonts -->

<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,500,600,700,800&display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,500,600,700,800&display=swap" rel="stylesheet">

<script>
document.documentElement.classList.add('loading');
</script>

<!-- CRITICAL CSS: Prevents "Big Image" flash on refresh -->
<style>
.page-loader{
    position:fixed !important;
    top:0;
    left:0;
    width:100%;
    height:100%;
    min-height:100vh;
    background:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    z-index:2147483647;
    opacity:1;
    visibility:visible;
    transition:opacity .5s ease, visibility .5s ease;
}

.page-loader.hidden{
    opacity:0;
    visibility:hidden;
}

.page-loader-logo{
    width:240px;
    max-width:85vw;
    height:auto;
    animation:pageLoaderPulse 1.5s ease-in-out infinite;
}

@keyframes pageLoaderPulse{
    0%{ transform:scale(1); opacity:1; }
    50%{ transform:scale(1.08); opacity:.75; }
    100%{ transform:scale(1); opacity:1; }
}

html.loading body > *:not(.page-loader){
    visibility:hidden !important;
}

html.loading .body-inner{
    visibility:hidden !important;
}
</style>

<noscript>
    <style>
        html.loading body > *:not(.page-loader) { visibility: visible !important; }
        html.loading .body-inner { visibility: visible !important; }
        .page-loader { display: none !important; }
    </style>
</noscript>

</head>
<body>

<!-- Start Pre Loader -->
<!-- ================= PAGE LOADER ================= -->
<div class="page-loader">

    <img src="{{ asset('assets/images/ABSloader.png') }}" 
         alt="ABS Radio Television"
         class="page-loader-logo">

</div>
<!-- End Pre Loader -->

<div class="body-inner">
  <!-- Breaking News Sliding Ticker -->
 <div id="breaking-news" class="breaking-news">
    <div class="container">
        <div class="row align-items-center">

            <!-- Breaking News Label -->
            <div class="col-auto pe-0">
                <span class="breaking-news-label px-3 py-2 text-white font-weight-bold">
                    <i class="fa fa-bolt"></i> BREAKING NEWS
                </span>
            </div>

            <!-- Sliding Content -->
            <div class="col breaking-news-slider">
                <div class="ticker-wrapper">
                    <div class="ticker">
                        <div class="ticker-content">

                            @forelse($breakingNews as $news)

                                <a href="{{ route('posts.show', $news->slug) }}">
                                    {{ $news->title }}
                                </a>

                            @empty

                                <a href="#">
                                    No breaking news available.
                                </a>

                            @endforelse

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
  <!-- Topbar End --> 
  
  <!-- Header start -->

  <!-- Header End -->
   @include('snippets.header')
  <!-- Main Nav Start --> 
  
  <!-- Main Nav End --> 
  
  <!-- Featured Post Area Start --> 
  @yield('content')
  <!-- Ad Content Area End -->
  
  
<!-- Footer Start -->  
 @include('snippets.footer')
<!-- Footer End -->
  
<!-- Copyright Start -->   

<!-- Copyright End -->
</div>



<style>
html.loaded body > *{
    visibility:visible !important;
}
</style>

  <style>

#radioPlayer{
    position:fixed;
    bottom:20px;
    right:20px;
    width:320px;
    background:#fff;
    box-shadow:0 0 15px rgba(0,0,0,.2);
    border-radius:10px;
    z-index:99999;
    display:none;
}

.radio-header{
    background:#dc3545;
    color:#fff;
    padding:10px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-radius:10px 10px 0 0;
}

.radio-body{
    padding:15px;
}

.radio-body audio{
    width:100%;
    margin-top:10px;
}

#closeRadio{
    background:none;
    border:none;
    color:#fff;
    font-size:20px;
    cursor:pointer;
}


.floating-player{
    position:fixed;
    bottom:20px;
    right:20px;
    width:360px;
    background:#000;
    border-radius:12px;
    overflow:hidden;
    z-index:999999;
    box-shadow:0 15px 40px rgba(0,0,0,.35);
}

.player-header{
    background:#d60000;
    color:#fff;
    padding:10px 15px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-weight:bold;
}

.player-header button{
    background:none;
    border:none;
    color:#fff;
    cursor:pointer;
    font-size:18px;
}

.floating-player iframe{
    width:100%;
    height:220px;
    border:0;
}

.restore-player{
    position:fixed;
    bottom:20px;
    right:20px;
    background:#d60000;
    color:#fff;
    padding:12px 20px;
    border-radius:40px;
    display:none;
    cursor:pointer;
    z-index:999999;
}



/* ================= BREAKING NEWS ================= */

.breaking-news {
    background-color: #1e1e1e;
    border-bottom: 1px solid #333;
    overflow: hidden;
    padding: 8px 0;
}

.breaking-news-label {
    background-color: #d32f2f;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    white-space: nowrap;
}

.breaking-news-slider {
    overflow: hidden;
}

.ticker-wrapper {
    overflow: hidden;
}

.ticker {
    display: flex;
    width: max-content;
    animation: slideLeft 30s linear infinite;
}

.ticker-content a {
    color: #ffffff;
    text-decoration: none;
    margin-right: 50px;
    font-size: 0.95rem;
    white-space: nowrap;
    display: inline-block;
}

.ticker-content a:hover {
    color: #ffcc00;
}


/* pause ticker */

.breaking-news:hover .ticker {

    animation-play-state: paused;

}

/* ================= PAGE LOADER ================= */

/* MOVED TO HEAD TO PREVENT FLASH */

@keyframes slideLeft {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(-50%);
    }
}

/* PREVENT CONTENT FLASH */

html.loaded .body-inner{
    visibility:visible !important;
}


/* mobile */

@media (max-width:768px) {

    .breaking-news-label{
        display:flex;
        align-items:center;
        justify-content:center;
        height:100%;
        min-height:35px;   /* adjust as needed */
        min-width:110px;   /* wider red box */
        padding:0 15px;
        font-size:.8rem;
        font-weight:600;
    }

    .ticker-content a{
        font-size:.9rem;
        margin-right:30px;
    }

    

    .floating-player{
        width:95%;
        right:2.5%;
    }



}

</style>
<!-- Javascript Files --> 
<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script> 
<script src="{{ asset('assets/js/popper.min.js') }}"></script> 
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script> 
<script src="{{ asset('assets/js/jquery.colorbox.js') }}"></script>
<script src="{{ asset('assets/js/smoothscroll.js') }}"></script> 
<script src="{{ asset('assets/js/custom_script.js') }}"></script> 



@if($radioStream)

<div id="radioPlayer">

    <div class="radio-header">

        <span>🔴 LIVE RADIO</span>

        <button id="closeRadio">
            ×
        </button>

    </div>

    <div class="radio-body">

        <strong>{{ $radioStream->title }}</strong>

        <audio controls autoplay>
            <source src="{{ $radioStream->stream_url }}">
            Your browser does not support audio.
        </audio>

    </div>

</div>

@endif

<div id="floatingPlayer" class="floating-player" style="display:none;">

    <div class="player-header">

        <span>🔴 LIVE TV</span>

        <div>
            <button id="minimizePlayer">
                <i class="fa fa-minus"></i>
            </button>

            <button id="closePlayer">
                ×
            </button>
        </div>

    </div>

    <iframe
        id="liveFrame"
        src=""
        allow="autoplay; encrypted-media"
        allowfullscreen>
    </iframe>

</div>

<div id="restorePlayer"
     class="restore-player"
     style="display:none;">

    <i class="fa fa-play"></i>
    LIVE TV

</div>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SKV4S8RDYL"></script>

<script>
window.dataLayer = window.dataLayer || [];

function gtag(){
    dataLayer.push(arguments);
}

gtag('js', new Date());
gtag('config', 'G-SKV4S8RDYL');


/* ==========================================
   PAGE LOADER + DARK MODE
========================================== */

window.addEventListener('load', function () {

    document.documentElement.classList.remove('loading');
    document.documentElement.classList.add('loaded');

    const loader = document.querySelector('.page-loader');

    if(loader){

        loader.classList.add('hidden');

        setTimeout(function(){

            loader.remove();

        }, 500);

    }

});


document.addEventListener('DOMContentLoaded', function () {

    if(localStorage.getItem('darkMode') === 'enabled'){
        document.body.classList.add('dark-mode');
    }

});


function toggleDarkMode(){

    document.body.classList.toggle('dark-mode');

    if(document.body.classList.contains('dark-mode')){
        localStorage.setItem('darkMode', 'enabled');
    }else{
        localStorage.setItem('darkMode', 'disabled');
    }

}


/* ==========================================
   RADIO PLAYER
========================================== */

const radioBtn       = document.getElementById('radioToggle');
const mobileRadioBtn = document.getElementById('mobileRadioToggle');
const radioPlayer    = document.getElementById('radioPlayer');
const closeRadio     = document.getElementById('closeRadio');

function openRadio(e){

    e.preventDefault();

    if(radioPlayer){
        radioPlayer.style.display = 'block';
    }

}

if(radioBtn){
    radioBtn.addEventListener('click', openRadio);
}

if(mobileRadioBtn){
    mobileRadioBtn.addEventListener('click', openRadio);
}

if(closeRadio){

    closeRadio.addEventListener('click', function(){

        radioPlayer.style.display = 'none';

    });

}


/* ==========================================
   LIVE TV PLAYER
========================================== */

const youtubeUrl = "{{ $youtubeLive?->youtube_url ?? '' }}";

const openBtn      = document.getElementById('openLivePlayer');
const player       = document.getElementById('floatingPlayer');
const frame        = document.getElementById('liveFrame');
const restore      = document.getElementById('restorePlayer');
const minimizeBtn  = document.getElementById('minimizePlayer');
const closeBtn     = document.getElementById('closePlayer');

if(openBtn){

    openBtn.addEventListener('click', function(){

        if(!youtubeUrl){
            alert('No Live Stream Available');
            return;
        }

        let embedUrl = youtubeUrl;

        if(youtubeUrl.includes('watch?v=')){

            const videoId = youtubeUrl.split('v=')[1].split('&')[0];

            embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1`;

        }

        player.style.display = 'block';
        restore.style.display = 'none';
        frame.src = embedUrl;

    });

}

if(minimizeBtn){

    minimizeBtn.addEventListener('click', function(){

        player.style.display = 'none';
        restore.style.display = 'block';

    });

}

if(restore){

    restore.addEventListener('click', function(){

        player.style.display = 'block';
        restore.style.display = 'none';

    });

}

if(closeBtn){

    closeBtn.addEventListener('click', function(){

        player.style.display = 'none';
        restore.style.display = 'none';
        frame.src = '';

    });

}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
