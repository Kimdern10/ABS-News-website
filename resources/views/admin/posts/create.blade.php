@extends('layouts.admin')

@section('content')
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Create Post</h4>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Category --}}
    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-control" required>
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Title --}}
    <div class="mb-3">
        <label class="form-label">Post Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    {{-- Excerpt --}}
    <div class="mb-3">
        <label class="form-label">Short Description</label>
        <textarea name="excerpt" class="form-control" rows="3"></textarea>
    </div>

    
<div class="mb-3">
    <label class="form-label">
        Full Content <span class="text-danger">*</span>
    </label>

    <textarea
        name="content"
        id="content"
        class="form-control"
        rows="15"
    >{{ old('content') }}</textarea>

    @error('content')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

    <hr>

   <hr>

<h5>Post Images (Maximum 5)</h5>

<div class="mb-3">
    <label>Select Images</label>
    <input type="file"
           name="images[]"
           class="form-control"
           multiple
           accept="image/*">
    <small class="text-muted">
        You can select up to 5 images at once.
    </small>
</div>

    <hr>

    <h5>Reporter Information</h5>

    <div class="row">

        <div class="col-md-6 mb-3">
            <label>Author Name</label>
            <input type="text" name="author_name" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>News Source</label>
            <input type="text" name="source" class="form-control">
        </div>

        <div class="col-md-6 mb-3">
            <label>Reading Time (Minutes)</label>
            <input type="number" name="reading_time" value="1" class="form-control">
        </div>

    </div>

    <hr>

    <h5>News Options</h5>

    <div class="row">

        <div class="col-md-4">
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="featured" value="1">
                <label class="form-check-label">Featured</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="breaking_news" value="1">
                <label class="form-check-label">Breaking News</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="trending" value="1">
                <label class="form-check-label">Trending</label>
            </div>
        </div>

        <div class="col-md-4">

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="headline" value="1">
                <label class="form-check-label">Headline</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="slider" value="1">
                <label class="form-check-label">Homepage Slider</label>
            </div>

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="popular" value="1">
                <label class="form-check-label">Popular News</label>
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" name="allow_comments" value="1" checked>
                <label class="form-check-label">Allow Comments</label>
            </div>

        </div>

    </div>

    <hr>

    <h5>SEO</h5>

    <div class="mb-3">
        <label>Meta Title</label>
        <input type="text" name="meta_title" class="form-control">
    </div>

    <div class="mb-3">
        <label>Meta Description</label>
        <textarea name="meta_description" rows="3" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Meta Keywords</label>
        <textarea name="meta_keywords" rows="2" class="form-control"></textarea>
    </div>

    <hr>

    <div class="row">

        <div class="col-md-6 mb-3">
            <label>Status</label>

            <select name="status" class="form-control">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>

    </div>

    <div class="mt-4">

        <button type="submit" class="btn btn-primary">
            Create Post
        </button>

        <a href="{{ route('posts.index') }}" class="btn btn-secondary">
            Back
        </a>

    </div>

</form>
                </div>
            </div>

        </div>
    </div>
</div>
@push('scripts')
<script>
ClassicEditor
    .create(document.querySelector('#content'))
    .catch(error => {
        console.error(error);
    });
</script>
@endpush
@endsection