@extends('layouts.admin')

@section('content')
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-sm-12">

            <div class="mb-3 d-flex flex-wrap gap-2">
    <a href="{{ route('posts.index') }}" class="btn btn-primary">
        <i class="fa fa-arrow-left"></i> Back to Posts
    </a>
</div>

            <div class="card">
                <div class="card-header">
                   <h4 class="card-title mb-0">Trashed Posts</h4>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped align-middle post-table">

                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>News Options</th>
                                    <th>Views</th>
                                    <th>Published</th>
                                    <th>Created</th>
                                    <th width="170">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($posts as $post)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        @if($post->image1)
                                            <img src="{{ asset('storage/'.$post->image1) }}"
                                                 width="80"
                                                 height="60"
                                                 class="rounded">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>

                                    <td>
                                        <strong>{{ $post->title }}</strong>

                                        <br>

                                        <small class="text-muted">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($post->excerpt),60) }}
                                        </small>
                                    </td>

                                    <td>
                                        {{ $post->category->name ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $post->author_name ?: ($post->user->name ?? '-') }}
                                    </td>

                                    <td>
                                        @if($post->status == 'published')
                                            <span class="badge bg-success">
                                                Published
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Draft
                                            </span>
                                        @endif
                                    </td>

                                    <td>

                                        @if($post->featured)
                                            <div class="mb-1">
                                                <span class="badge bg-primary">Featured</span>
                                            </div>
                                        @endif

                                        @if($post->breaking_news)
                                            <div class="mb-1">
                                                <span class="badge bg-danger">Breaking</span>
                                            </div>
                                        @endif

                                        @if($post->headline)
                                            <div class="mb-1">
                                                <span class="badge bg-warning text-dark">Headline</span>
                                            </div>
                                        @endif

                                        @if($post->slider)
                                            <div class="mb-1">
                                                <span class="badge bg-info">Slider</span>
                                            </div>
                                        @endif

                                        @if($post->trending)
                                            <div class="mb-1">
                                                <span class="badge bg-success">Trending</span>
                                            </div>
                                        @endif

                                        @if($post->popular)
                                            <div>
                                                <span class="badge bg-dark">Popular</span>
                                            </div>
                                        @endif

                                    </td>

                                    <td>
                                        {{ number_format($post->views) }}
                                    </td>

                                    <td>
                                        @if($post->published_at)
                                            {{ $post->published_at->format('d M Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>
                                        {{ $post->created_at->format('d M Y') }}
                                    </td>

                                    

                                    

   <td>

    <div class="d-grid gap-2">

        {{-- Restore --}}
        <form action="{{ route('posts.restore', $post->id) }}" method="POST">
            @csrf

            <button type="submit" class="btn btn-success btn-sm">
                Restore
            </button>
        </form>

        {{-- Delete Permanently --}}
        <form action="{{ route('posts.forceDelete', $post->id) }}"
              method="POST"
              onsubmit="return confirm('Delete this post permanently?');">

            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger btn-sm">
                Delete Permanently
            </button>

        </form>

    </div>

</td>

                                </tr>

                                @empty

                                <tr>
                                    <td colspan="11" class="text-center">
                                        No posts found.
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-3">
                        {{ $posts->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>

.post-table img{
    object-fit:cover;
    border-radius:6px;
}

.badge{
    font-size:11px;
    padding:6px 10px;
}

.d-grid .btn{
    width:100%;
}

.table td{
    vertical-align:middle;
}

@media(max-width:768px){

.post-table{
    font-size:12px;
}

.post-table th,
.post-table td{
    white-space:nowrap;
    padding:6px;
}

.card-title{
    font-size:18px;
}

.btn{
    font-size:12px;
}

}

</style>

@endsection