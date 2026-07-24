@extends('layouts.app')

@section('content')

<!-- Breadcrumb -->
<section class="utf_inner_banner_area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="utf_inner_banner_content">
                    <h2>Contact Us</h2>
                    <ul class="breadcrumb">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="utf_contact_area py-5">
    <div class="container">

        <div class="row">

            <!-- Contact Information -->
            <div class="col-lg-6">

                <div class="utf_block_wrapper mb-4">

                    <h3 class="utf_block_title">
                        <span>Head Office - Awka</span>
                    </h3>

                    <p>
                        <i class="fa fa-map-marker text-danger"></i>
                        Enugu–Onitsha Express Way,<br>
                        Near Aroma Junction,<br>
                        Awka, Anambra State.
                    </p>

                    <hr>

                    <h5>Broadcast Services</h5>

                    <ul class="list-unstyled">
                        <li><strong>ABS FM:</strong> 88.5 FM</li>
                        <li><strong>ABS TV:</strong> Channel 24</li>
                        <li><strong>NigComSat:</strong> Channel Frequency 2</li>
                        <li><strong>Frequency:</strong> 12.731 GHz</li>
                        <li><strong>Polarization:</strong> Horizontal (H)</li>
                        <li><strong>Symbol Rate:</strong> 26250 KBPS</li>
                    </ul>

                </div>

                <div class="utf_block_wrapper mb-4">

                    <h3 class="utf_block_title">
                        <span>Onitsha Office</span>
                    </h3>

                    <p>
                        <i class="fa fa-map-marker text-danger"></i>
                        Oraifite Street,<br>
                        Awada Layout,<br>
                        Onitsha, Anambra State.
                    </p>

                    <hr>

                    <h5>Broadcast Services</h5>

                    <ul class="list-unstyled">
                        <li><strong>ABS FM:</strong> 90.7 FM</li>
                        <li><strong>ABS TV:</strong> Channel 27</li>
                    </ul>

                </div>

            </div>

            <!-- Right Side -->
            <div class="col-lg-6">

                <div class="utf_block_wrapper mb-4">

                    <h3 class="utf_block_title">
                        <span>Contact Information</span>
                    </h3>

                    <p>
                        <i class="fa fa-globe text-danger"></i>
                        <strong>Website:</strong><br>
                        <a href="https://www.absradiotv.com" target="_blank">
                            www.absradiotv.com
                        </a>
                    </p>

                    <hr>

                    <p>
                        <i class="fa fa-envelope text-danger"></i>
                        <strong>Email:</strong><br>
                        <a href="mailto:absradiotv@yahoo.com">
                            absradiotv@yahoo.com
                        </a>
                    </p>

                </div>

                <div class="utf_block_wrapper mb-4">

                    <h3 class="utf_block_title">
                        <span>Follow Us</span>
                    </h3>

                <ul class="list-unstyled">

    <li class="mb-3">
        <i class="fa-brands fa-facebook-f text-primary"></i>
        <a href="https://www.facebook.com/absradiotelevision?mibextid=wwXIfr" target="_blank">
            Facebook
        </a>
    </li>

    <li class="mb-3">
        <i class="fa-brands fa-instagram text-danger"></i>
        <a href="https://www.instagram.com/absradiotv" target="_blank">
            Instagram
        </a>
    </li>

    <li class="mb-3">
        <i class="fa-brands fa-x-twitter"></i>
        <a href="https://x.com/absradiotv" target="_blank">
            X (Twitter)
        </a>
    </li>

    <li>
        <i class="fa-brands fa-youtube text-danger"></i>
        <a href="https://youtube.com/@absradiotelevision" target="_blank">
            YouTube
        </a>
    </li>

</ul>

                </div>

                <div class="utf_block_wrapper">

                    <h3 class="utf_block_title">
                        <span>Our Location</span>
                    </h3>

                    <iframe
                        src="https://maps.google.com/maps?q=Aroma%20Junction%20Awka&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        width="100%"
                        height="350"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection