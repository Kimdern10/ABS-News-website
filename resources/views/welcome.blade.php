 @extends('layouts.app')
 @section('content')

 <section class="utf_featured_post_area pt-4 no-padding">
   <div class="container">
     <div class="row">

       {{-- LEFT SIDE SLIDER --}}
       <div class="col-lg-7 col-md-12 pad-r">

         <div id="utf_featured_slider"
           class="owl-carousel owl-theme utf_featured_slider">

           @foreach($sliderNews->take(3) as $post)

           <div class="item"
             style="background-image:url('{{ asset('storage/'.$post->image1) }}')">

             <div class="utf_featured_post">

               <div class="utf_post_content">

                 <a class="utf_post_cat"
                   href="{{ route('category.page',$post->category->slug) }}">
                   {{ $post->category->name }}
                 </a>

                 <h2 class="utf_post_title title-extra-large">

                   <a href="{{ route('posts.show',$post->slug) }}">
                     {{ $post->title }}
                   </a>

                 </h2>

      <span class="utf_post_author">
                           <i class="fa fa-user"></i>
                          <a href="#">
        {{ $post->story_by ?? $post->author_name ?? $post->user->name }}
    </a>
</span>


                 <span class="utf_post_date">
                   <i class="fa-regular fa-clock"></i>

                   {{ optional($post->published_at)->format('d M, Y') }}
                 </span>

               </div>

             </div>

           </div>

           @endforeach

         </div>

       </div>


       {{-- RIGHT SIDE --}}
       <div class="col-lg-5 col-md-12 pad-l">

         <div class="row">


           {{-- TOP NEWS --}}
           <div class="col-md-12">

             @php
             $topNews = $sliderNews->skip(3)->first();
             @endphp


             @if($topNews)

             <div class="utf_post_overaly_style contentTop hot-post-top clearfix">

               <div class="utf_post_thumb">

                 <a href="{{ route('posts.show',$topNews->slug) }}">

                   <img class="img-fluid"
                     src="{{ asset('storage/'.$topNews->image1) }}"
                     alt="{{ $topNews->title }}" />

                 </a>

               </div>

               <div class="utf_post_content">

                 <a class="utf_post_cat"
                   href="{{ route('category.page',$topNews->category->slug) }}">

                   {{ $topNews->category->name }}

                 </a>

                 <h2 class="utf_post_title title-large">

                   <a href="{{ route('posts.show',$topNews->slug) }}">
                     {{ $topNews->title }}
                   </a>

                 </h2>


                 <span class="utf_post_author">
                   <i class="fa fa-user"></i>

                   <a href="#">
                     {{ $topNews->story_by ?? $topNews->author_name ?? $topNews->user->name }}
                   </a>
                 </span>


                 <span class="utf_post_date">
                   <i class="fa-regular fa-clock"></i>

                   {{ optional($topNews->published_at)->format('d M, Y') }}

                 </span>

               </div>

             </div>

             @endif

           </div>



           {{-- BOTTOM TWO POSTS --}}

           @foreach($sliderNews->skip(4)->take(2) as $post)

           <div class="col-md-6">

             <div class="utf_post_overaly_style contentTop utf_hot_post_bottom clearfix">

               <div class="utf_post_thumb">

                 <a href="{{ route('posts.show',$post->slug) }}">

                   <img class="img-fluid"
                     src="{{ asset('storage/'.$post->image1) }}"
                     alt="{{ $post->title }}" />

                 </a>

               </div>


               <div class="utf_post_content">

                 <a class="utf_post_cat"
                   href="{{ route('category.page',$post->category->slug) }}">

                   {{ $post->category->name }}

                 </a>


                 <h2 class="utf_post_title title-medium">

                   <a href="{{ route('posts.show',$post->slug) }}">
                     {{ $post->title }}
                   </a>

                 </h2>


                 <div class="utf_post_meta">

                   <span class="utf_post_author">
                     <i class="fa fa-user"></i>

                     <a href="#">
                       {{ $post->story_by ?? $post->author_name ?? $post->user->name }}
                     </a>

                   </span>

                 </div>

               </div>

             </div>

           </div>

           @endforeach

         </div>

       </div>

     </div>
   </div>
 </section>
 <!-- Featured Post Area End -->

 <!-- Latest News Area Start -->
 <section class="utf_latest_new_area pb-bottom-20">
   <div class="container">
     <div class="utf_latest_news block color-red">

       <h3 class="utf_block_title">
         <span>Latest News</span>
       </h3>

       <div id="utf_latest_news_slide" class="owl-carousel owl-theme utf_latest_news_slide">

         @foreach($latestNews->chunk(2) as $chunk)

         <div class="item">
           <ul class="utf_list_post">

             @foreach($chunk as $post)

             <li class="clearfix">
               <div class="utf_post_block_style clearfix">

                 <div class="utf_post_thumb">
                   <a href="{{ route('posts.show',$post->slug) }}">
                     <img class="img-fluid"
                       src="{{ asset('storage/'.$post->image1) }}"
                       alt="{{ $post->title }}">
                   </a>
                 </div>

                 @if($post->category)
                 <a class="utf_post_cat"
                   href="{{ route('category.page',$post->category->slug) }}">
                   {{ $post->category->name }}
                 </a>
                 @endif

                 <div class="utf_post_content">

                   <h2 class="utf_post_title title-medium">
                     <a href="{{ route('posts.show',$post->slug) }}">
                       {{ Str::limit($post->title,50) }}
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

                   </div>

                 </div>

               </div>
             </li>

             @endforeach

           </ul>
         </div>

         @endforeach

       </div>

     </div>
   </div>
 </section>
 <!-- Latest News Area End -->

 <!-- Ad Content Area Start -->
 <!-- Ad Content Area End -->

 <!-- 1rd Block Wrapper Start -->
 <section class="utf_block_wrapper p-bottom-0">
   <div class="container">
     <div class="row">
       <div class="col-lg-8 col-md-12">
         @php
         $tabOne = $categories->skip(3)->first();
         $tabTwo = $categories->skip(4)->first();

         $tabOnePosts = $tabOne
         ? $tabOne->posts()->where('status','published')->latest('published_at')->take(5)->get()
         : collect();

         $tabTwoPosts = $tabTwo
         ? $tabTwo->posts()->where('status','published')->latest('published_at')->take(5)->get()
         : collect();
         @endphp
         <div class="utf_featured_tab color-blue">
           <h3 class="utf_block_title"><span>{{ $tabOne->name ?? 'News' }}</span></h3>
           <ul class="nav nav-tabs">
             <li class="nav-item"> <a class="nav-link animated fadeIn active" href="#tab_a" data-toggle="tab"> <span class="tab-head"> <span class="tab-text-title">{{ $tabOne->name ?? '' }}</span> </span> </a> </li>
             <li class="nav-item"> <a class="nav-link animated fadeIn" href="#tab_b" data-toggle="tab"> <span class="tab-head"> <span class="tab-text-title">{{ $tabTwo->name ?? '' }}</span> </span> </a> </li>
           </ul>
           <div class="tab-content">

             {{-- TAB A --}}
             <div class="tab-pane active animated fadeInRight" id="tab_a">
               <div class="row">

                 <div class="col-lg-6 col-md-6">

                   @if($tabOnePosts->count())

                   @php
                   ($post = $tabOnePosts->first());
                   @endphp

                   <div class="utf_post_block_style clearfix">
                     <div class="utf_post_thumb">
                       <a href="{{ route('posts.show',$post->slug) }}">
                         <img class="img-fluid" src="{{ asset('storage/'.$post->image1) }}" alt="{{ $post->title }}">
                       </a>
                     </div>

                     <a class="utf_post_cat" href="#">
                       {{ $tabOne->name }}
                     </a>

                     <div class="utf_post_content">

                       <h2 class="utf_post_title">
                         <a href="{{ route('posts.show',$post->slug) }}">
                           {{ $post->title }}
                         </a>
                       </h2>

                       <div class="utf_post_meta">
                         <span class="utf_post_author">
                           <i class="fa fa-user"></i>
                           {{ $post->author_name ?? $post->user->name }}
                         </span>

                         <span class="utf_post_date">
                           <i class="fa-regular fa-clock"></i>
                           {{ optional($post->published_at)->format('d M, Y') }}
                         </span>
                       </div>

                       <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->content),120) }}</p>

                     </div>
                   </div>


                   @endif

                 </div>


                 <div class="col-lg-6 col-md-6">

                   <div class="utf_list_post_block">
                     <ul class="utf_list_post">

                       @foreach($tabOnePosts->skip(1) as $post)

                       <li class="clearfix">

                         <div class="utf_post_block_style post-float clearfix">

                           <div class="utf_post_thumb">
                             <a href="{{ route('posts.show',$post->slug) }}">
                               <img class="img-fluid" src="{{ asset('storage/'.$post->image1) }}" alt="{{ $post->title }}">
                             </a>
                           </div>

                           <div class="utf_post_content">

                             <h2 class="utf_post_title title-small">
                               <a href="{{ route('posts.show',$post->slug) }}">
                                 {{ $post->title }}
                               </a>
                             </h2>

                             <div class="utf_post_meta">
                               <span class="utf_post_author">
                                 <i class="fa fa-user"></i>
                                 {{ $post->author_name ?? $post->user->name }}
                               </span>

                               <span class="utf_post_date">
                                 <i class="fa-regular fa-clock"></i>
                                 {{ optional($post->published_at)->format('d M, Y') }}
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
             </div>


             {{-- TAB B --}}
             <div class="tab-pane animated fadeInLeft" id="tab_b">

               <div class="row">

                 <div class="col-lg-6 col-md-6">

                   @if($tabTwoPosts->count())

                   @php
                   ($post = $tabTwoPosts->first());
                   @endphp

                   <div class="utf_post_block_style clearfix">

                     <div class="utf_post_thumb">
                       <a href="{{ route('posts.show',$post->slug) }}">
                         <img class="img-fluid" src="{{ asset('storage/'.$post->image1) }}" alt="{{ $post->title }}">
                       </a>
                     </div>

                     <a class="utf_post_cat" href="#">
                       {{ $tabTwo->name }}
                     </a>

                     <div class="utf_post_content">

                       <h2 class="utf_post_title">
                         <a href="{{ route('posts.show',$post->slug) }}">
                           {{ $post->title }}
                         </a>
                       </h2>

                       <div class="utf_post_meta">

                         <span class="utf_post_author">
                           <i class="fa fa-user"></i>
                           {{ $post->author_name ?? $post->user->name }}
                         </span>

                         <span class="utf_post_date">
                           <i class="fa-regular fa-clock"></i>
                           {{ optional($post->published_at)->format('d M, Y') }}
                         </span>

                       </div>

                       <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->content),120) }}</p>

                     </div>

                   </div>


                   @endif

                 </div>


                 <div class="col-lg-6 col-md-6">

                   <div class="utf_list_post_block">

                     <ul class="utf_list_post">

                       @foreach($tabTwoPosts->skip(1) as $post)

                       <li class="clearfix">

                         <div class="utf_post_block_style post-float clearfix">

                           <div class="utf_post_thumb">
                             <a href="{{ route('posts.show',$post->slug) }}">
                               <img class="img-fluid" src="{{ asset('storage/'.$post->image1) }}" alt="{{ $post->title }}">
                             </a>
                           </div>

                           <div class="utf_post_content">

                             <h2 class="utf_post_title title-small">
                               <a href="{{ route('posts.show',$post->slug) }}">
                                 {{ $post->title }}
                               </a>
                             </h2>

                             <div class="utf_post_meta">

                               <span class="utf_post_author">
                                 <i class="fa fa-user"></i>
                                 {{ $post->author_name ?? $post->user->name }}
                               </span>

                               <span class="utf_post_date">
                                 <i class="fa-regular fa-clock"></i>
                                 {{ optional($post->published_at)->format('d M, Y') }}
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

             </div>

           </div>
         </div>



         <div class="gap-30"></div>
         <div class="block color-orange">
           <h3 class="utf_block_title">
             <span>{{ $fifthCategory->name ?? 'News' }}</span>
           </h3>

           <div class="row">

             <div class="col-lg-6 col-md-6">

               @php
               ($featured = $fifthCategory?->posts->first());
               @endphp
               @if($featured)
               <div class="utf_post_overaly_style clearfix">
                 <div class="utf_post_thumb">
                   <a href="{{ route('posts.show',$featured->slug) }}">
                     <img class="img-fluid"
                       src="{{ asset('storage/'.$featured->image1) }}"
                       alt="{{ $featured->title }}">
                   </a>
                 </div>

                 <div class="utf_post_content">
                   <a class="utf_post_cat"
                     href="{{ route('category.page',$fifthCategory->slug) }}">
                     {{ $fifthCategory->name }}
                   </a>

                   <h2 class="utf_post_title">
                     <a href="{{ route('posts.show',$featured->slug) }}">
                       {{ $featured->title }}
                     </a>
                   </h2>

                   <div class="utf_post_meta">
                     <span class="utf_post_author">
                       <i class="fa fa-user"></i>
                       <a href="#">
                         {{ $featured->story_by ?? $featured->author_name ?? $featured->user->name }}
                       </a>
                     </span>

                     <span class="utf_post_date">
                       <i class="fa-regular fa-clock"></i>
                       {{ optional($featured->published_at)->format('d M, Y') }}
                     </span>
                   </div>
                 </div>
               </div>
               @endif

               <div class="utf_list_post_block">
                 <ul class="utf_list_post">

                   @foreach($fifthCategory?->posts->skip(1)->take(4) ?? [] as $post)

                   <li class="clearfix">
                     <div class="utf_post_block_style post-float clearfix">

                       <div class="utf_post_thumb">
                         <a href="{{ route('posts.show',$post->slug) }}">
                           <img class="img-fluid"
                             src="{{ asset('storage/'.$post->image1) }}"
                             alt="{{ $post->title }}">
                         </a>

                         <a class="utf_post_cat"
                           href="{{ route('category.page',$fifthCategory->slug) }}">
                           {{ $fifthCategory->name }}
                         </a>
                       </div>

                       <div class="utf_post_content">
                         <h2 class="utf_post_title title-small">
                           <a href="{{ route('posts.show',$post->slug) }}">
                             {{ $post->title }}
                           </a>
                         </h2>

                         <div class="utf_post_meta">
                           <span class="utf_post_author">
                             <i class="fa fa-user"></i>
                             <a href="#">
                               {{ $post->story_by ?? $post->author_name ?? $post->user->name }}
                             </a>
                           </span>

                           <span class="utf_post_date">
                             <i class="fa-regular fa-clock"></i>
                             {{ optional($post->published_at)->format('d M, Y') }}
                           </span>
                         </div>
                       </div>

                     </div>
                   </li>

                   @endforeach

                 </ul>
               </div>

             </div>

             <div class="col-lg-6 col-md-6">

               @php
               ($featured = $sixthCategory?->posts->first());
               @endphp

               @if($featured)
               <div class="utf_post_overaly_style last clearfix">
                 <div class="utf_post_thumb">
                   <a href="{{ route('posts.show',$featured->slug) }}">
                     <img class="img-fluid"
                       src="{{ asset('storage/'.$featured->image1) }}"
                       alt="{{ $featured->title }}">
                   </a>
                 </div>

                 <div class="utf_post_content">
                   <a class="utf_post_cat"
                     href="{{ route('category.page',$sixthCategory->slug) }}">
                     {{ $sixthCategory->name }}
                   </a>

                   <h2 class="utf_post_title">
                     <a href="{{ route('posts.show',$featured->slug) }}">
                       {{ $featured->title }}
                     </a>
                   </h2>

                   <div class="utf_post_meta">
                     <span class="utf_post_author">
                       <i class="fa fa-user"></i>
                       <a href="#">
                         {{ $featured->story_by ?? $featured->author_name ?? $featured->user->name }}
                       </a>
                     </span>

                     <span class="utf_post_date">
                       <i class="fa-regular fa-clock"></i>
                       {{ optional($featured->published_at)->format('d M, Y') }}
                     </span>
                   </div>
                 </div>
               </div>

               @endif

               <div class="utf_list_post_block">
                 <ul class="utf_list_post">

                   @foreach($sixthCategory?->posts->skip(1)->take(4) ?? [] as $post)

                   <li class="clearfix">
                     <div class="utf_post_block_style post-float clearfix">

                       <div class="utf_post_thumb">
                         <a href="{{ route('posts.show',$post->slug) }}">
                           <img class="img-fluid"
                             src="{{ asset('storage/'.$post->image1) }}"
                             alt="{{ $post->title }}">
                         </a>

                         <a class="utf_post_cat"
                           href="{{ route('category.page',$sixthCategory->slug) }}">
                           {{ $sixthCategory->name }}
                         </a>
                       </div>

                       <div class="utf_post_content">
                         <h2 class="utf_post_title title-small">
                           <a href="{{ route('posts.show',$post->slug) }}">
                             {{ $post->title }}
                           </a>
                         </h2>

                         <div class="utf_post_meta">
                           <span class="utf_post_author">
                             <i class="fa fa-user"></i>
                             <a href="#">
                               {{ $post->story_by ?? $post->author_name ?? $post->user->name }}
                             </a>
                           </span>

                           <span class="utf_post_date">
                             <i class="fa-regular fa-clock"></i>
                             {{ optional($post->published_at)->format('d M, Y') }}
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

             @if($popularPosts->count())
             <div class="utf_post_overaly_style clearfix">
               <div class="utf_post_thumb">
                 <a href="{{ route('posts.show', $popularPosts->first()->slug) }}">
                   <img class="img-fluid"
                     src="{{ asset('storage/'.$popularPosts->first()->image1) }}"
                     alt="{{ $popularPosts->first()->title }}" />
                 </a>
               </div>

               <div class="utf_post_content">

                 @if($popularPosts->first()->category)
                 <a class="utf_post_cat"
                   href="{{ route('category.page', $popularPosts->first()->category->slug) }}">
                   {{ $popularPosts->first()->category->name }}
                 </a>
                 @endif

                 <h2 class="utf_post_title">
                   <a href="{{ route('posts.show', $popularPosts->first()->slug) }}">
                     {{ Str::limit($popularPosts->first()->title, 60) }}
                   </a>
                 </h2>

                 <div class="utf_post_meta">
                   <span class="utf_post_author">
                     <i class="fa fa-user"></i>
                     <a href="#">
                       {{ $popularPosts->first()->author_name ?? $popularPosts->first()->user->name }}
                     </a>
                   </span>

                   <span class="utf_post_date">
                     <i class="fa-regular fa-clock"></i>
                     {{ $popularPosts->first()->published_at?->format('d M, Y') }}
                   </span>
                 </div>

               </div>
             </div>
             @endif

             <div class="utf_list_post_block">
               <ul class="utf_list_post">

                 @foreach($popularPosts->skip(1) as $post)

                 <li class="clearfix">
                   <div class="utf_post_block_style post-float clearfix">

                     <div class="utf_post_thumb">
                       <a href="{{ route('posts.show', $post->slug) }}">
                         <img class="img-fluid"
                           src="{{ asset('storage/'.$post->image1) }}"
                           alt="{{ $post->title }}" />
                       </a>

                       @if($post->category)
                       <a class="utf_post_cat"
                         href="{{ route('category.page', $post->category->slug) }}">
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
                           <a href="#">
                             {{ $post->author_name ?? $post->user->name }}
                           </a>
                         </span>

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

           <div class="widget color-default m-bottom-0">
             <h3 class="utf_block_title"><span>Trending News</span></h3>

             <div id="utf_post_slide" class="owl-carousel owl-theme utf_post_slide">

               @foreach($trendingNews as $post)
               <div class="item">
                 <div class="utf_post_overaly_style text-center clearfix">

                   <div class="utf_post_thumb">
                     <a href="{{ route('posts.show', $post->slug) }}">
                       <img class="img-fluid"
                         src="{{ asset('storage/'.$post->image1) }}"
                         alt="{{ $post->title }}">
                     </a>
                   </div>

                   <div class="utf_post_content">

                     @if($post->category)
                     <a class="utf_post_cat"
                       href="{{ route('category.page', $post->category->slug) }}">
                       {{ $post->category->name }}
                     </a>
                     @endif

                     <h2 class="utf_post_title">
                       <a href="{{ route('posts.show', $post->slug) }}">
                         {{ Str::limit($post->title, 60) }}
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
                     </div>

                   </div>

                 </div>
               </div>
               @endforeach

             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- 1rd Block Wrapper End -->

 <!-- 2rd Block Wrapper Start -->
 <section class="utf_block_wrapper p-bottom-0">
   <div class="container">
     <div class="row">
       @foreach($categories->take(3) as $category)
       <div class="col-lg-4">
         <div class="block
        {{ $loop->first ? 'color-dark-blue' : '' }}
        {{ $loop->iteration == 2 ? 'color-aqua' : '' }}
        {{ $loop->iteration > 2 ? 'color-violet' : '' }}
    ">

           <h3 class="utf_block_title">
             <span>{{ $category->name }}</span>
           </h3>

           @php
           $featured = $category->posts()
           ->where('status','published')
           ->latest('published_at')
           ->first();
           @endphp

           @if($featured)
           <div class="utf_post_overaly_style clearfix">
             <div class="utf_post_thumb">
               <a href="{{ route('posts.show',$featured->slug) }}">
                 <img class="img-fluid"
                   src="{{ asset('storage/'.$featured->image1) }}"
                   alt="{{ $featured->title }}">
               </a>
             </div>

             <div class="utf_post_content">
               <h2 class="utf_post_title">
                 <a href="{{ route('posts.show',$featured->slug) }}">
                   {{ $featured->title }}
                 </a>
               </h2>

               <div class="utf_post_meta">
                 <span class="utf_post_author">
                   <i class="fa fa-user"></i>
                   <a href="#">
                     {{ $featured->author_name ?? $featured->user->name }}
                   </a>
                 </span>

                 <span class="utf_post_date">
                   <i class="fa-regular fa-clock"></i>
                   {{ optional($featured->published_at)->format('d M, Y') }}
                 </span>
               </div>
             </div>
           </div>
           @endif

           <div class="utf_list_post_block">
             <ul class="utf_list_post">

               @foreach(
               $category->posts()
               ->where('status','published')
               ->latest('published_at')
               ->skip(1)
               ->take(4)
               ->get()
               as $post
               )

               <li class="clearfix">
                 <div class="utf_post_block_style post-float clearfix">

                   <div class="utf_post_thumb">
                     <a href="{{ route('posts.show',$post->slug) }}">
                       <img class="img-fluid"
                         src="{{ asset('storage/'.$post->image1) }}"
                         alt="{{ $post->title }}">
                     </a>
                   </div>

                   <div class="utf_post_content">
                     <h2 class="utf_post_title title-small">
                       <a href="{{ route('posts.show',$post->slug) }}">
                         {{ $post->title }}
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
                     </div>
                   </div>

                 </div>
               </li>

               @endforeach

             </ul>
           </div>

         </div>
       </div>
       @endforeach
     </div>
 </section>
 <!-- 2rd Block Wrapper End -->

 <!-- 3rd Block Wrapper Start -->
 <section class="utf_block_wrapper p-bottom-0">
   <div class="container">
     <div class="row">
       <div class="col-lg-8 col-md-12">
         <div class="utf_more_news block color-default">
           <h3 class="utf_block_title"><span>View More News</span></h3>
           <div id="utf_more_news_slide" class="owl-carousel owl-theme utf_more_news_slide">

             <div class="item">

               @foreach($viewMoreNews as $post)

               <div class="utf_post_block_style utf_post_float_half clearfix">

                 <div class="utf_post_thumb">
                   <a href="{{ route('posts.show', $post->slug) }}">
                     <img class="img-fluid"
                       src="{{ asset('storage/'.$post->image1) }}"
                       alt="{{ $post->title }}">
                   </a>
                 </div>

                 <a class="utf_post_cat"
                   href="{{ route('category.page', $post->category->slug) }}">
                   {{ $post->category->name }}
                 </a>

                 <div class="utf_post_content">

                   <h2 class="utf_post_title">
                     <a href="{{ route('posts.show', $post->slug) }}">
                       {{ $post->title }}
                     </a>
                   </h2>

                   <div class="utf_post_meta">
                     <span class="utf_post_author">
                       <i class="fa fa-user"></i>
                       <a href="#">
                         {{ $post->story_by ?: ($post->author_name ?: $post->user->name) }}
                       </a>
                     </span>

                     <span class="utf_post_date">
                       <i class="fa-regular fa-clock"></i>
                       {{ optional($post->published_at)->format('d M, Y') }}
                     </span>
                   </div>

                   <p>
                     {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}
                   </p>

                 </div>

               </div>

               @endforeach

             </div>

           </div>
         </div>
       </div>

      
     </div>
   </div>
 </section>
 <!-- 3rd Block Wrapper End -->

 <style>
   /* Latest News Card */
   .utf_latest_news .utf_post_block_style {
     display: block;
     margin-bottom: 25px;
   }

   /* Image */
   .utf_latest_news .utf_post_thumb {
     width: 100%;
     height: 200px;
     overflow: hidden;
     border-radius: 6px;
     margin-bottom: 12px;
     position: relative;
   }

   .utf_latest_news .utf_post_thumb img {
     width: 100%;
     height: 100%;
     object-fit: cover;
     transition: .4s;
   }

   .utf_latest_news .utf_post_thumb:hover img {
     transform: scale(1.05);
   }

   /* Category */
   .utf_latest_news .utf_post_cat {
     position: absolute;
     top: 10px;
     left: 10px;
     z-index: 2;
   }

   /* Title */
   .utf_latest_news .utf_post_title {
     font-size: 15px;
     line-height: 25px;
     font-weight: 500;
     margin-bottom: 10px;
   }

   /* Meta */
   .utf_latest_news .utf_post_meta {
     font-size: 14px;
     color: #777;
   }

   /*=========================================
 FEATURED TAB (LEFT)
=========================================*/

   .utf_featured_tab .utf_post_thumb {
     width: 100%;
     height: 260px;
     overflow: hidden;
     border-radius: 5px;
   }

   .utf_featured_tab .utf_post_thumb img {
     width: 100%;
     height: 100%;
     object-fit: cover;
     display: block;
   }

   .utf_featured_tab .utf_post_content {
     padding-top: 15px;
   }

   .utf_featured_tab .utf_post_title {
     font-size: 20px;
     line-height: 30px;
     font-weight: 500;
     margin: 15px 0;
   }

   .utf_featured_tab .utf_post_content p {
     font-size: 12px;
     line-height: 15px;
     color: #666;
   }

   .utf_featured_tab .utf_post_meta {
     font-size: 12px;
     margin-bottom: 13px;
   }

   .utf_featured_tab .utf_post_author,
   .utf_featured_tab .utf_post_date {
     font-size: 12px;
   }



   /*=========================================
 SMALL POSTS (RIGHT SIDE)
=========================================*/

   .post-float {
     display: flex;
     align-items: flex-start;
     margin-bottom: 20px;
   }

   .post-float .utf_post_thumb {
     width: 95px;
     min-width: 95px;
     height: 75px;
     margin-right: 15px;
     overflow: hidden;
     border-radius: 4px;
   }

   .post-float .utf_post_thumb img {
     width: 100%;
     height: 100%;
     object-fit: cover;
   }

   .post-float .utf_post_content {
     flex: 1;
     padding: 0;
   }

   .post-float .utf_post_title,
   .post-float .title-small {
     font-size: 12px;
     line-height: 20px;
     font-weight: 600;
     margin-bottom: 8px;
   }

   .post-float .utf_post_meta,
   .post-float .utf_post_author,
   .post-float .utf_post_date {
     font-size: 10px;
     line-height: 20px;
   }

   /* Navbar should stay above everything */
   .utf_main_nav_area {
     position: relative;
     z-index: 99999;
     overflow: visible !important;
   }

   .utf_main_nav_area .navbar {
     position: relative;
     z-index: 99999;
   }

   .utf_main_nav_area .dropdown-menu {
     z-index: 999999 !important;
     position: absolute;
   }

   /* Prevent slider from covering the menu */
   .utf_featured_post_area,
   .owl-carousel,
   .owl-stage-outer,
   .owl-stage,
   .owl-item {
     z-index: 1;
   }

   /*=========================================
 POPULAR NEWS
=========================================*/

   .widget .utf_post_overaly_style .utf_post_thumb {
     width: 100%;
     height: 260px;
     overflow: hidden;
     border-radius: 5px;
   }

   .widget .utf_post_overaly_style .utf_post_thumb img {
     width: 100%;
     height: 100%;
     object-fit: cover;
   }

   .widget .utf_post_overaly_style .utf_post_title {
     font-size: 20px;
     line-height: 30px;
     font-weight: 500;
     margin: 15px 0;
   }

   .widget .utf_post_overaly_style .utf_post_meta,
   .widget .utf_post_overaly_style .utf_post_author,
   .widget .utf_post_overaly_style .utf_post_date {
     font-size: 12px;
   }

   /* Popular News Small Posts */

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

   /*=========================================
 TRENDING NEWS
=========================================*/

   #utf_post_slide .utf_post_thumb {
     width: 100%;
     height: 260px;
     overflow: hidden;
     border-radius: 5px;
   }

   #utf_post_slide .utf_post_thumb img {
     width: 100%;
     height: 100%;
     object-fit: cover;
   }

   #utf_post_slide .utf_post_title {
     font-size: 16px;
     line-height: 25px;
     font-weight: 600;
     margin: 15px 0;
   }

   #utf_post_slide .utf_post_meta,
   #utf_post_slide .utf_post_author,
   #utf_post_slide .utf_post_date {
     font-size: 12px;
   }

   /*=========================================
 BLOCK TITLES & TABS
=========================================*/

   .utf_block_title span {
     font-size: 13px;
     font-weight: 600;
     letter-spacing: .3px;
   }

   .nav-tabs .nav-link {
     font-size: 14px;
     font-weight: 600;
     text-transform: uppercase;
   }

   /*=========================================
 CATEGORY BADGES
=========================================*/

   .utf_post_cat {
     display: inline-block;
     padding: 5px 10px;
     font-size: 11px;
     font-weight: 600;
     border-radius: 3px;
     text-transform: uppercase;
   }

   /*==========================
 THREE COLUMN NEWS
===========================*/

   .block {
     margin-bottom: 30px;
   }

   .block .utf_post_overaly_style {
     position: relative;
     overflow: hidden;
     border-radius: 4px;
     margin-bottom: 18px;
   }

   .block .utf_post_overaly_style .utf_post_thumb {
     width: 100%;
     height: 330px;
     overflow: hidden;
   }

   .block .utf_post_overaly_style .utf_post_thumb img {
     width: 100%;
     height: 100%;
     object-fit: cover;
     display: block;
   }

   .block .utf_post_overaly_style .utf_post_content {
     position: absolute;
     left: 0;
     right: 0;
     bottom: 0;
     padding: 20px;
     background: linear-gradient(to top, rgba(0, 0, 0, .85), rgba(0, 0, 0, .15), transparent);
   }

   .block .utf_post_overaly_style .utf_post_title {
     font-size: 20px;
     line-height: 28px;
     font-weight: 500;
     margin: 12px 0;
   }

   .block .utf_post_overaly_style .utf_post_title a {
     color: #fff;
   }

   .block .utf_post_overaly_style .utf_post_meta {
     font-size: 10px;
   }

   .block .utf_post_overaly_style .utf_post_author a,
   .block .utf_post_overaly_style .utf_post_date {
     color: #fff;
   }

   /*==========================
 SMALL POSTS
===========================*/

   .block .utf_list_post {
     margin: 0;
     padding: 0;
   }

   .block .utf_list_post li {
     margin-bottom: 18px;
     list-style: none;
   }

   .block .post-float {
     display: flex;
     align-items: flex-start;
   }

   .block .post-float .utf_post_thumb {
     width: 105px;
     min-width: 105px;
     height: 80px;
     margin-right: 15px;
     overflow: hidden;
     border-radius: 4px;
   }

   .block .post-float .utf_post_thumb img {
     width: 100%;
     height: 100%;
     object-fit: cover;
   }

   .block .post-float .utf_post_content {
     flex: 1;
   }

   .block .post-float .utf_post_title {
     font-size: 12px;
     line-height: 22px;
     font-weight: 500;
     margin-bottom: 8px;
   }

   .block .post-float .utf_post_title a {
     color: #333;
   }

   .block .post-float .utf_post_meta {
     font-size: 10px;
     margin-top: 6px;
   }

   .block .utf_post_author,
   .block .utf_post_date {
     font-size: 10px;
   }

   /*==========================
 SECTION TITLES
===========================*/

   .block .utf_block_title span {
     font-size: 12px;
     font-weight: 500;
     text-transform: uppercase;
   }

   /*==========================
 CATEGORY BADGE
===========================*/

   /* .block .utf_post_cat{
    font-size:11px;
    font-weight:600;
    padding:5px 10px;
} */

   /* VIEW MORE NEWS */

   .utf_more_news .utf_post_float_half {
     display: flex;
     align-items: flex-start;
     gap: 25px;
     margin-bottom: 35px;
   }

   .utf_more_news .utf_post_thumb {
     position: relative;
     width: 320px;
     min-width: 320px;
     height: 220px;
     overflow: hidden;
     border-radius: 4px;
   }

   .utf_more_news .utf_post_thumb img {
     width: 100%;
     height: 100%;
     object-fit: cover;
     display: block;
   }

   /* .utf_more_news .utf_post_cat{
    position:absolute;
    top:15px;
    left:15px;
    background:#ef4b4b;
    color:#fff;
    padding:5px 10px;
    font-size:11px;
    font-weight:500;
    border-radius:3px;
    text-transform:uppercase;
    z-index:99;
} */

   .utf_more_news .utf_post_content {
     flex: 1;
     padding-top: 5px;
   }

   .utf_more_news .utf_post_title {
     font-size: 20px;
     line-height: 26px;
     font-weight: 500;
     margin-bottom: 12px;
   }

   .utf_more_news .utf_post_title a {
     color: #222;
   }

   .utf_more_news .utf_post_meta {
     margin-bottom: 18px;
     font-size: 12px;
   }

   .utf_more_news .utf_post_author,
   .utf_more_news .utf_post_date {
     margin-right: 18px;
   }

   .utf_more_news p {
     font-size: 12px;
     line-height: 20px;
     color: #666;
   }

   /* LEFT SLIDER */
   #utf_featured_slider .item {
     height: 500px;
   }

   /* RIGHT TOP CARD */
   .hot-post-top {
     height: 255px;
     position: relative;
     overflow: hidden;
   }

   .hot-post-top .utf_post_thumb {
     width: 100%;
     height: 100%;
   }

   .hot-post-top .utf_post_thumb img {
     width: 100%;
     height: 100%;
     object-fit: cover;
     display: block;
   }

   /* RIGHT BOTTOM CARDS */
   .utf_hot_post_bottom {
     height: 255px;
     position: relative;
     overflow: hidden;
   }

   .utf_hot_post_bottom .utf_post_thumb {
     width: 100%;
     height: 100%;
   }

   .utf_hot_post_bottom .utf_post_thumb img {
     width: 100%;
     height: 100%;
     object-fit: cover;
     display: block;
   }

   /* LEFT BIG SLIDER TITLE */
   #utf_featured_slider .utf_post_title {
     font-size: 28px;
     line-height: 36px;
     font-weight: 600;
     letter-spacing: -0.5px;
   }

   /* RIGHT TOP TITLE */
   .hot-post-top .utf_post_title {
     font-size: 22px;
     line-height: 26px;
     font-weight: 600;
     letter-spacing: -0.3px;
   }

   /* RIGHT BOTTOM TITLES */
   .utf_hot_post_bottom .utf_post_title {
     font-size: 13px;
     line-height: 22px;
     font-weight: 500;
   }

   /* Category */
   .utf_featured_post_area .utf_post_cat {
     font-size: 11px;
     font-weight: 600;
     text-transform: uppercase;
     letter-spacing: 0.5px;
   }

   /* Author & Date */
   .utf_featured_post_area .utf_post_author,
   .utf_featured_post_area .utf_post_date {
     font-size: 10px;
     font-weight: 400;
   }

   /* Bottom two posts - Square images */
   .utf_featured_post_area .utf_hot_post_bottom {
     position: relative;
     overflow: hidden;
     border-radius: 4px;
   }

   .utf_featured_post_area .utf_hot_post_bottom .utf_post_thumb {
     width: 100%;
     aspect-ratio: 1 / 1;
     /* Makes it a perfect square */
     overflow: hidden;
   }

   .utf_featured_post_area .utf_hot_post_bottom .utf_post_thumb img {
     width: 100%;
     height: 100%;
     object-fit: cover;
     display: block;
   }

   /* Newsletter text black in dark mode */
body.dark-mode .utf_newsletter_introtext h4,
body.dark-mode .utf_newsletter_introtext p,
body.dark-mode .utf_newsletter_introtext span,
body.dark-mode .utf_newsletter_introtext small,
body.dark-mode .utf_newsletter_introtext{
    color:#000 !important;
}

/* =====================================
   DARK MODE - WHITE TEXT + RED HOVER
===================================== */










   @media (min-width: 1200px) {
     #utf_featured_slider .item {
       height: 520px;
     }

     .hot-post-top {
       height: 265px;
     }

     .utf_hot_post_bottom {
       height: 255px;
     }
   }

   /* ==================== DESKTOP / LG (992px - 1199px) ==================== */
   @media (max-width: 1199px) {
     #utf_featured_slider .utf_post_title {
       font-size: 26px;
       line-height: 34px;
     }
   }

   /* ==================== TABLET / MD (768px - 991px) ==================== */
   @media (max-width: 991px) {

     /* Featured Area */
     .utf_featured_post_area .col-lg-7,
     .utf_featured_post_area .col-lg-5 {
       padding-right: 15px !important;
       padding-left: 15px !important;
     }

     #utf_featured_slider .item {
       height: 420px;
     }

     .hot-post-top {
       height: auto;
       min-height: 280px;
     }

     .utf_hot_post_bottom {
       height: auto;
       min-height: 280px;
     }

     /* Featured Tab */
     .utf_featured_tab .utf_post_thumb {
       height: 280px;
     }

     /* Three column blocks */
     .block .utf_post_overaly_style .utf_post_thumb {
       height: 280px;
     }
   }

   /* ==================== SMALL TABLET / LANDSCAPE MOBILE (576px - 767px) ==================== */
   @media (max-width: 767px) {

     /* Featured Slider */
     #utf_featured_slider .item {
       height: 390px;
     }

     #utf_featured_slider .utf_post_title {
       font-size: 22px;
       line-height: 28px;
     }

     .hot-post-top .utf_post_title {
       font-size: 19px;
       line-height: 24px;
     }

     /* Latest News */
     .utf_latest_news .utf_post_thumb {
       height: 380px;
     }

     .utf_latest_news .utf_post_title {
       font-size: 16px;
       line-height: 22px;
     }

     /* Tabs */
     .utf_featured_tab .utf_post_thumb {
       height: 380px;
     }

     .utf_featured_tab .utf_post_title {
       font-size: 18px;
       line-height: 26px;
     }

     /* Three column sections */
     .col-lg-4 {
       margin-bottom: 30px;
     }

     .block .utf_post_overaly_style .utf_post_thumb {
       height: 380px;
     }

     

     /* View More News */
     .utf_more_news .utf_post_float_half {
       flex-direction: column;
       gap: 15px;
     }

     .utf_more_news .utf_post_thumb {
       width: 100%;
       min-width: 100%;
       height: 380px;
     }

     /* Sidebar */
     .utf_sidebar_right {
       margin-top: 40px;
     }


     /* Popular & Trending in Sidebar */
     .widget .utf_post_overaly_style .utf_post_thumb {
       height: 380px;
     }

     /* TRENDING NEWS */
/* =========================================*/ 

   #utf_post_slide .utf_post_thumb {
     width: 100%;
     height: 360px;
     overflow: hidden;
     border-radius: 3px;
   }

   #utf_post_slide .utf_post_thumb img {
     width: 100%;
     height: 100%;
     object-fit: cover;
   }

   #utf_post_slide .utf_post_title {
     font-size: 12px;
     line-height: 19px;
     font-weight: 400;
     margin: 12px 0;
   }
/* Mobile Tabs Fix */
.utf_featured_tab .nav-tabs {
    display: flex;
    justify-content: center;
    flex-wrap: nowrap;
    gap: 10px;
    
}

.utf_featured_tab .nav-tabs .nav-item {
    flex: 0 0 auto;
    
}

.utf_featured_tab .nav-tabs .nav-link {
    padding: 6px 14px;
    font-size: 12px;
    border-radius: 4px;
    
}

.utf_featured_tab .nav-tabs .nav-link.active{
      color:#fff;
    background: #0d6efd;
}

.utf_featured_tab .nav-tabs .nav-link.hover{
  color:#fff;
    background: #0d6efd;
}
     
   }

   /* ==================== MOBILE PORTRAIT (< 576px) ==================== */
   @media (max-width: 575px) {
     .utf_featured_post_area {
       padding-top: 10px;
     }

     #utf_featured_slider .item {
       height: 380px;
     }

     #utf_featured_slider .utf_post_title {
       font-size: 18px;
       line-height: 24px;
     }

     .utf_post_title.title-extra-large {
       font-size: 18px !important;
     }

     .hot-post-top,
     .utf_hot_post_bottom {
       height: auto;
       min-height: 280px;
     }

     .utf_hot_post_bottom .utf_post_title {
       font-size: 13px;
       line-height: 20px;
     }

     /* Latest News */
     .utf_latest_news .utf_post_thumb {
       height: 380px;
     }

     .utf_latest_news .utf_post_title {
       font-size: 13.5px;
       line-height: 20px;
     }

     /* Featured Tab */
     .utf_featured_tab .utf_post_thumb {
       height: 380px;
     }

     .utf_featured_tab .utf_post_title {
       font-size: 17px;
       line-height: 24px;
     }

     .utf_featured_tab .utf_post_content p {
       font-size: 13px;
       line-height: 18px;
     }

     /* Small floating posts */
     .post-float .utf_post_thumb {
       width: 85px;
       min-width: 85px;
       height: 85px;
     }

     .post-float .utf_post_title {
       font-size: 10px;
       line-height: 16px;
     }

     /* Block posts */
     .block .utf_post_overaly_style .utf_post_thumb {
       height: 380px;
     }

     .block .post-float .utf_post_thumb {
       width: 90px;
       min-width: 90px;
       height: 70px;
     }

     /* More News */
     .utf_more_news .utf_post_thumb {
       height: 380px;
     }

     .utf_more_news .utf_post_title {
       font-size: 13px;
       line-height: 20px;
     }

     /* Category badge */
     .utf_post_cat {
       font-size: 10px;
       padding: 4px 8px;
     }

     /* Block titles */
     .utf_block_title span {
       font-size: 15px;
     }

     /* Small floating posts */
.post-float {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    overflow: hidden;
}

.post-float .utf_post_thumb {
    width: 85px;
    min-width: 85px;
    height: 85px;
    flex-shrink: 0;
    margin-right: 0;
}

.post-float .utf_post_thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.post-float .utf_post_content {
    flex: 1;
    min-width: 0;
}

.post-float .utf_post_title {
    font-size: 10px;
    line-height: 16px;
    margin-top: 15px;
}

   .post-float .utf_post_thumb {
        width: 85px;
        min-width: 85px;
        height: 85px;
        margin-top: 15px !important; /* Move image down */
    }

     .post-float .utf_post_content {
        margin-top: 15px !important;
    }

    /* Mobile Tabs Fix */
.utf_featured_tab .nav-tabs {
    display: flex;
    justify-content: center;
    flex-wrap: nowrap;
    gap: 10px;
    
}

.utf_featured_tab .nav-tabs .nav-item {
    flex: 0 0 auto;
    
}

.utf_featured_tab .nav-tabs .nav-link {
    padding: 6px 14px;
    font-size: 12px;
    border-radius: 4px;
    
}

.utf_featured_tab .nav-tabs .nav-link.active{
      color:#fff;
    background: #0d6efd;
}

.utf_featured_tab .nav-tabs .nav-link.hover{
  color:#fff;
    background: #0d6efd;
}
    
   }

   /* ==================== EXTRA SMALL MOBILE (< 400px) ==================== */
   @media (max-width: 399px) {
     #utf_featured_slider .item {
       height: 300px;
     }

     .utf_featured_tab .utf_post_thumb {
       height: 280px;
     }

     .block .utf_post_overaly_style .utf_post_thumb {
       height: 280px;
     }

     .post-float .utf_post_thumb {
       width: 78px;
       min-width: 78px;
       height: 80px;
     }

     /* Mobile Tabs Fix */
.utf_featured_tab .nav-tabs {
    display: flex;
    justify-content: center;
    flex-wrap: nowrap;
    gap: 10px;
    
}

.utf_featured_tab .nav-tabs .nav-item {
    flex: 0 0 auto;
    
}

.utf_featured_tab .nav-tabs .nav-link {
    padding: 6px 14px;
    font-size: 10px;
    border-radius: 4px;
    
}

.utf_featured_tab .nav-tabs .nav-link.active{
      color:#fff;
    background: #0d6efd;
}

.utf_featured_tab .nav-tabs .nav-link.hover{
  color:#fff;
    background: #0d6efd;
}
    
   }

   /* ==================== OWL CAROUSEL RESPONSIVE FIXES ==================== */
   @media (max-width: 991px) {
     .owl-carousel .item {
       padding: 0 5px;
     }
   }

   /* Make images responsive everywhere */
   img.img-fluid {
     max-width: 100%;
     height: auto;
   }
 </style>
 @endsection