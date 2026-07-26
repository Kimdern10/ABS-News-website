@extends('layouts.app')

@section('content')

<!-- Page Title Start -->
<div class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">

        <ul class="breadcrumb">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li>Eyewitness News</li>
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

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
    <i class="fa fa-check-circle"></i>
    {{ session('success') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
    <i class="fa fa-times-circle"></i>
    {{ session('error') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
    </button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger mb-4">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">


<h3 class="utf_block_title mb-0">
<span>Eyewitness News</span>
</h3>


@auth

<button type="button"
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#eyewitnessModal">

    <i class="fa fa-plus"></i> Submit Eyewitness News

</button>

@else

<a href="{{ route('login') }}" class="btn btn-primary">
    <i class="fa fa-sign-in-alt"></i> Login to Submit News
</a>

@endauth


</div>



<div class="row">


@forelse($latestEyewitness as $news)


<div class="col-md-6">


<div class="utf_post_block_style post-grid clearfix">


<div class="utf_post_thumb">


<a href="{{ route('eyewitness.show',$news->id) }}">


<img class="img-fluid"

src="{{ $news->image ? asset('storage/'.$news->image) : asset('images/no-image.jpg') }}"

alt="{{ $news->title }}">


</a>


</div>



<a class="utf_post_cat" href="#">

Eyewitness

</a>



<div class="utf_post_content">


<h2 class="utf_post_title title-large">


<a href="{{ route('eyewitness.show',$news->id) }}">

{{ Str::limit($news->title,55) }}

</a>


</h2>



<div class="utf_post_meta">


<span class="utf_post_author">

<i class="fa fa-user"></i>

{{ $news->user->name ?? 'Citizen Reporter' }}

</span>



<span class="utf_post_date">

<i class="fa-regular fa-clock"></i>

{{ $news->created_at->format('d M, Y') }}

</span>



<span class="post-comment pull-right">

<i class="fa fa-map-marker"></i>

{{ $news->location ?? 'Unknown' }}

</span>



</div>



<p>

{{ \Illuminate\Support\Str::limit(strip_tags($news->content),150) }}

</p>



</div>


</div>


</div>


@empty


<div class="col-12">

<div class="alert alert-info">

No eyewitness reports available.

</div>

</div>


@endforelse



</div>


</div>



<div class="paging">

{{ $latestEyewitness->links() }}

</div>



</div>





<div class="col-lg-4 col-md-12">

<div class="sidebar utf_sidebar_right">


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

<a class="utf_post_cat" href="#">

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





<div class="widget text-center">

<img class="banner img-fluid"
src="images/banner-ads/ad-sidebar.png"
alt="">

</div>




<div class="widget m-bottom-0">


<h3 class="utf_block_title">

<span>Newsletter</span>

</h3>


<div class="utf_newsletter_block">


<div class="utf_newsletter_introtext">

<h4>Stay Updated with ABS</h4>


<p>
Subscribe to the ABS Radio & Television newsletter to receive the latest breaking news, live updates, exclusive stories, programmes, and special announcements directly in your inbox.
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

<!-- Eyewitness Create Modal Start -->

<div class="modal fade" id="eyewitnessModal" tabindex="-1" aria-labelledby="eyewitnessModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">


            <div class="modal-header">

                <h5 class="modal-title" id="eyewitnessModalLabel">
                    Submit Eyewitness News
                </h5>

                <button type="button" 
                        class="btn-close" 
                        data-bs-dismiss="modal">
                </button>

            </div>



            <form action="{{ route('user.eyewitness.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">

                @csrf


                <div class="modal-body">


                    <div class="form-group mb-3">

                        <label>
                            News Title
                        </label>

                        <input type="text"
                               name="title"
                               class="form-control"
                               placeholder="Enter news title"
                               required>

                    </div>



                    <div class="form-group mb-3">

                        <label>
                            Location
                        </label>

                        <input type="text"
                               name="location"
                               class="form-control"
                               placeholder="Where did it happen?">

                    </div>



                    <div class="form-group mb-3">

                        <label>
                            News Details
                        </label>

                        <textarea name="content"
                                  class="form-control"
                                  rows="5"
                                  placeholder="Describe what happened..."
                                  required></textarea>

                    </div>




                    <div class="form-group mb-3">

                        <label>
                            Upload Image
                        </label>

                        <input type="file"
                               name="image"
                               class="form-control"
                               accept="image/*">

                    </div>



                </div>




                <div class="modal-footer">


                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">

                        Close

                    </button>



                    <button type="submit"
                            class="btn btn-primary">

                        Submit Report

                    </button>


                </div>



            </form>


        </div>

    </div>

</div>
@if ($errors->any())
<script>
document.addEventListener('DOMContentLoaded', function () {
    var eyewitnessModal = new bootstrap.Modal(
        document.getElementById('eyewitnessModal')
    );
    eyewitnessModal.show();
});
</script>
@endif

<style>

/* ==========================
   EYEWITNESS NEWS PAGE
========================== */

/* News Card */
.utf_post_block_style.post-grid{
    margin-bottom:30px;
}

.utf_post_thumb img{
    width:100%;
    height:250px;
    object-fit:cover;
    border-radius:6px;
}

.utf_post_title.title-large{
    margin-top:12px;
}

.utf_post_title.title-large a{
    font-size:22px;
    line-height:1.4;
    font-weight:700;
}

.utf_post_content p{
    font-size:15px;
    line-height:1.8;
    color:#555;
}

.utf_post_meta{
    margin:12px 0;
}

.utf_post_meta span{
    font-size:13px;
}

/* Sidebar Popular News */
.utf_list_post .utf_post_thumb img{
    width:90px;
    height:70px;
    object-fit:cover;
    border-radius:4px;
}

.utf_list_post .utf_post_title a{
    font-size:14px;
    line-height:1.5;
}

.utf_list_post .utf_post_meta span{
    font-size:12px;
}

/* Follow Social Icons */
.social-icon li a{
    width:45px;
    height:45px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}

/* Newsletter */
.utf_newsletter_introtext h4{
    font-size:22px;
}

.utf_newsletter_introtext p{
    font-size:15px;
    line-height:1.7;
}


/* Heading */
.utf_block_title span{
    font-size:15px;
    font-weight:400;
}

/* Submit Button */
.btn-submit-eyewitness{
    font-size:15px;
    padding:10px 18px;
    font-weight:400;
}

/* Tablet */
@media (max-width:991px){

    .utf_block_title span{
        font-size:18px;
    }

    .btn-submit-eyewitness{
        font-size:14px;
        padding:9px 16px;
    }

}

/* Mobile */
@media (max-width:767px){

    .d-flex.justify-content-between.align-items-center{
        flex-direction:column;
        align-items:flex-start !important;
        gap:10px;
    }

    .utf_block_title span{
        font-size:18px;
    }

    .btn-submit-eyewitness{
        width:100%;
        font-size:14px;
        padding:10px;
        text-align:center;
    }

}

/* Small Mobile */
@media (max-width:575px){

    .utf_block_title span{
        font-size:14px;
    }

    .btn-submit-eyewitness{
        font-size:13px;
        padding:10px;
    }

}


/* ==========================
   TABLET
========================== */
@media (max-width:991px){

    .utf_post_thumb img{
        height:360px;
    }

    .utf_post_title.title-large a{
        font-size:18px;
    }

    .utf_post_content p{
        font-size:14px;
    }

    .utf_sidebar_right{
        margin-top:40px;
    }

}

/* ==========================
   MOBILE
========================== */
@media (max-width:767px){

    .utf_post_thumb img{
        height:390px;
    }

    .utf_post_title.title-large a{
        font-size:14px;
        line-height:1.5;
    }

    .utf_post_content p{
        font-size:12px;
        line-height:1.7;
    }

    .utf_post_meta span{
        display:block;
        margin-bottom:5px;
        font-size:12px;
    }

    .utf_block_title span{
        font-size:14px;
    }

    .btn-primary{
        font-size:14px;
    }

}

/* ==========================
   SMALL MOBILE
========================== */
@media (max-width:575px){

    .utf_post_thumb img{
        height:390px;
    }

    .utf_post_title.title-large a{
        font-size:14px;
    }

    .utf_post_content p{
        font-size:12px;
    }

    .utf_newsletter_introtext h4{
        font-size:18px;
    }

    .utf_newsletter_introtext p{
        font-size:13px;
    }

    .social-icon li a{
        width:40px;
        height:40px;
        font-size:16px;
    }

}

/* ==========================
   EXTRA SMALL
========================== */
@media (max-width:400px){

    .utf_post_thumb img{
        height:360px;
    }

    .utf_post_title.title-large a{
        font-size:15px;
    }

    .utf_post_content p{
        font-size:12px;
    }

}

</style>
<!-- Eyewitness Create Modal End -->
@endsection