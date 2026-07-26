@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>{{ $stream->title }}</h2>

    <span class="badge badge-danger mb-3">
        🔴 LIVE
    </span>

    <div class="ratio ratio-16x9 mb-4">
        <iframe
            width="100%"
            height="600"
            src="https://www.youtube.com/embed/{{ $videoId }}"
            title="{{ $stream->title }}"
            frameborder="0"
            allowfullscreen>
        </iframe>
    </div>

    <div class="row">

        <div class="col-lg-8">

            <h4>Latest News</h4>

            @foreach($latestNews as $news)
                <div class="mb-3">
                    <a href="{{ route('posts.show', $news->slug) }}">
                        {{ $news->title }}
                    </a>
                </div>
            @endforeach

        </div>

        <div class="col-lg-4">

            <h4>Trending News</h4>

            @foreach($trendingNews as $news)
                <div class="mb-3">
                    <a href="{{ route('posts.show', $news->slug) }}">
                        {{ $news->title }}
                    </a>
                </div>
            @endforeach

        </div>

    </div>

</div>

@endsection