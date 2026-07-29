@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0" id="page_layout">
    <div id="content-page" class="content-page">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success') }}
                </div>
            @endif

            {{-- WELCOME CARD START --}}
<div class="col-12 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>
                    <h2 class="fw-bold mb-1">
                        Welcome Back,
                        {{ auth()->user()->name }}
                    </h2>

                    <h5 class="text-primary mb-2">

                        @if(auth()->user()->hasRole('super-admin'))
                            Super Administrator Dashboard
                        @elseif(auth()->user()->hasRole('admin'))
                            Administrator Dashboard
                        @elseif(auth()->user()->hasRole('editor'))
                            Editor Dashboard
                        @else
                            User Dashboard
                        @endif

                    </h5>

                    <p class="text-muted mb-0">
                        Manage Posts, Categories, Live News,
                        YouTube Streams, Eyewitness Reports
                        and Subscribers.
                    </p>
                </div>

                <div class="text-end">
                    <h4 class="mb-1">
                        {{ now()->format('h:i A') }}
                    </h4>

                    <small class="text-muted">
                        {{ now()->format('l, d F Y') }}
                    </small>
                </div>

            </div>

        </div>
    </div>
</div>
{{-- WELCOME CARD END --}}

            {{-- Header Actions --}}
            <div class="row mb-4">
                <div class="col-md-6">
                    <h3 class="mb-0">Dashboard Analytics</h3>
                    <small class="text-muted">ABS Radio & Television Admin Panel</small>
                </div>

                <div class="col-md-6 text-md-end">
                    <a href="" class="btn btn-primary">
                        Send Newsletter
                    </a>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="row g-3">

                <div class="col-xl-2 col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6>Total Posts</h6>
                            <h2>{{ $totalPosts }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6>Published</h6>
                            <h2>{{ $publishedPosts }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6>Drafts</h6>
                            <h2>{{ $draftPosts }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6>Subscribers</h6>
                            <h2>{{ $subscribers }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6>Total Views</h6>
                            <h2>{{ number_format($views) }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-lg-3 col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6>Categories</h6>
                            <h2>{{ $totalCategories }}</h2>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Second Row --}}
            <div class="row g-3 mt-1">

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6>Comments</h6>
                            <h2>{{ $totalComments }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6>Today's Views</h6>
                            <h2>{{ number_format($todayViews) }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6>Live News</h6>
                            <h2>{{ $liveNewsCount }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6>YouTube Live</h6>
                            <h2>{{ $youtubeStreams }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6>Eyewitness</h6>
                            <h2>{{ $eyewitnessReports }}</h2>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Charts --}}
            <div class="row mt-4 g-4">

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Posts Per Month</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="postsChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Views Per Day</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="viewsChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Subscriber Growth</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="subscriberChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Latest Posts --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Latest Posts</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($latestPosts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category->name ?? 'N/A' }}</td>
                                <td>{{ $post->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Most Viewed Posts --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Most Viewed Posts</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Views</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mostViewedPosts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ number_format($post->views) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Top Categories --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Top Categories</h4>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Category</th>
                            <th>Total Posts</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topCategories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->posts_count }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('postsChart'), {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($postsPerMonth->toArray())) !!},
        datasets: [{
            label: 'Posts',
            data: {!! json_encode(array_values($postsPerMonth->toArray())) !!}
        }]
    }
});

new Chart(document.getElementById('viewsChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($viewsPerDay->pluck('date')) !!},
        datasets: [{
            label: 'Views',
            data: {!! json_encode($viewsPerDay->pluck('total')) !!}
        }]
    }
});

new Chart(document.getElementById('subscriberChart'), {
    type: 'line',
    data: {
        labels: {!! json_encode($subscriberGrowth->pluck('date')) !!},
        datasets: [{
            label: 'Subscribers',
            data: {!! json_encode($subscriberGrowth->pluck('total')) !!}
        }]
    }
});
</script>

@endsection