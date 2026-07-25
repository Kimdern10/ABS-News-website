@extends('layouts.app')

@section('content')
<!-- Page Title Start -->
<div class="page-title">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>About Us</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Page Title End -->

<!-- 1rd Block Wrapper Start -->
<div class="utf_block_wrapper about-block-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="single-post">
                    <div class="utf_post_content-area">
                        <div class="entry-content">

                            <p>
                                <strong>Anambra Broadcasting Service (ABS)</strong> is the official public broadcasting
                                organization of Anambra State, Nigeria. ABS is committed to delivering accurate,
                                timely and balanced news, quality entertainment, educational programmes and
                                informative content that promotes the culture, values and development of Anambra State.
                                Through radio, television and digital platforms, ABS continues to serve millions of
                                viewers and listeners across Nigeria and beyond.
                            </p>

                          <p>
    <img class="pull-left"
        src="{{ asset('assets/images/ABS.png') }}"
        alt="About ABS"
        style="width:300px; height:auto; margin-right:20px; margin-bottom:15px;">
</p>

                            <p>
                                With its headquarters located along the Enugu–Onitsha Expressway near Aroma Junction,
                                Awka, and an operational office in Oraifite Street, Awada Layout, Onitsha,
                                ABS has remained one of the most trusted sources of news and public information.
                                The station operates ABS FM 88.5 in Awka, ABS FM 90.7 in Onitsha,
                                ABS TV Channel 24 in Awka, and ABS TV Channel 27 in Onitsha,
                                and satellite broadcasting on NigComSat: Channel Frequency 2,  Frequency: 12.731 GHz, 
                                Polarization: Horizontal (H) Symbol Rate: 26250 KBPS

                            </p>

                            <p>
                                Our mission is to inform, educate and entertain while promoting transparency,
                                good governance, cultural heritage and community development.
                                We are dedicated to producing credible journalism, engaging talk shows,
                                documentaries, sports coverage, entertainment programmes and special broadcasts
                                that reflect the aspirations and achievements of the people of Anambra State.
                            </p>

                            <p>
                                As media continues to evolve, ABS remains committed to innovation by expanding
                                its digital presence through its official website and social media platforms,
                                ensuring that viewers and listeners can access reliable news and quality programming
                                anytime and anywhere. We value integrity, professionalism, creativity and public
                                service, and we strive every day to remain the broadcaster of choice for our audience.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 1rd Block Wrapper End -->
 @endsection