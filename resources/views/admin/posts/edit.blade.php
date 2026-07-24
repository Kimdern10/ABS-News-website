@extends('layouts.admin')

@section('content')
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Edit Post</h4>
                    </div>
                </div>

                <div class="card-body">

<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- Category --}}
    <div class="mb-3">
        <label class="form-label">Category</label>

        <select name="category_id" class="form-control" required>

            @foreach($categories as $category)

                <option value="{{ $category->id }}"
                    {{ old('category_id',$post->category_id)==$category->id ? 'selected' : '' }}>

                    {{ $category->name }}

                </option>

            @endforeach

        </select>

    </div>

    {{-- Title --}}
    <div class="mb-3">
        <label class="form-label">Post Title</label>

        <input type="text"
               name="title"
               class="form-control"
               value="{{ old('title',$post->title) }}"
               required>
    </div>

    {{-- Excerpt --}}
    <div class="mb-3">

        <label class="form-label">Short Description</label>

        <textarea name="excerpt"
                  rows="3"
                  class="form-control">{{ old('excerpt',$post->excerpt) }}</textarea>

    </div>

    {{-- Content --}}
    <div class="mb-3">

        <label class="form-label">
            Full Content
        </label>

        <textarea name="content"
                  id="content"
                  rows="15"
                  class="form-control">{{ old('content',$post->content) }}</textarea>

        @error('content')
            <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    <hr>

    <h5>Post Images</h5>

    <div class="row">

        {{-- Image 1 --}}
        <div class="col-md-6 mb-3">

            <label>Image 1</label>

            @if($post->image1)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$post->image1) }}"
                         width="120"
                         class="rounded border">
                </div>
            @endif

            <input type="file" name="image1" class="form-control">

        </div>

        {{-- Image 2 --}}
        <div class="col-md-6 mb-3">

            <label>Image 2</label>

            @if($post->image2)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$post->image2) }}"
                         width="120"
                         class="rounded border">
                </div>
            @endif

            <input type="file" name="image2" class="form-control">

        </div>

        {{-- Image 3 --}}
        <div class="col-md-6 mb-3">

            <label>Image 3</label>

            @if($post->image3)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$post->image3) }}"
                         width="120"
                         class="rounded border">
                </div>
            @endif

            <input type="file" name="image3" class="form-control">

        </div>

        {{-- Image 4 --}}
        <div class="col-md-6 mb-3">

            <label>Image 4</label>

            @if($post->image4)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$post->image4) }}"
                         width="120"
                         class="rounded border">
                </div>
            @endif

            <input type="file" name="image4" class="form-control">

        </div>

        {{-- Image 5 --}}
        <div class="col-md-6 mb-3">

            <label>Image 5</label>

            @if($post->image5)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$post->image5) }}"
                         width="120"
                         class="rounded border">
                </div>
            @endif

            <input type="file" name="image5" class="form-control">

        </div>

    </div>

    <hr>

    <h5>Reporter Information</h5>

    <div class="row">

        <div class="col-md-6 mb-3">

            <label>Author Name</label>

            <input type="text"
                   name="author_name"
                   class="form-control"
                   value="{{ old('author_name',$post->author_name) }}">

        </div>

        <div class="col-md-6 mb-3">

            <label>News Source</label>

            <input type="text"
                   name="source"
                   class="form-control"
                   value="{{ old('source',$post->source) }}">

        </div>

        <div class="col-md-6 mb-3">

            <label>Reading Time</label>

            <input type="number"
                   name="reading_time"
                   class="form-control"
                   value="{{ old('reading_time',$post->reading_time) }}">

        </div>

    </div>

    <hr>

    <h5>News Options</h5>

    <div class="row">

        <div class="col-md-4">

            <div class="form-check mb-2">
                <input type="checkbox"
                       class="form-check-input"
                       name="featured"
                       value="1"
                       {{ old('featured',$post->featured) ? 'checked' : '' }}>
                <label class="form-check-label">Featured</label>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox"
                       class="form-check-input"
                       name="breaking_news"
                       value="1"
                       {{ old('breaking_news',$post->breaking_news) ? 'checked' : '' }}>
                <label class="form-check-label">Breaking News</label>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox"
                       class="form-check-input"
                       name="trending"
                       value="1"
                       {{ old('trending',$post->trending) ? 'checked' : '' }}>
                <label class="form-check-label">Trending</label>
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-check mb-2">
                <input type="checkbox"
                       class="form-check-input"
                       name="headline"
                       value="1"
                       {{ old('headline',$post->headline) ? 'checked' : '' }}>
                <label class="form-check-label">Headline</label>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox"
                       class="form-check-input"
                       name="slider"
                       value="1"
                       {{ old('slider',$post->slider) ? 'checked' : '' }}>
                <label class="form-check-label">Homepage Slider</label>
            </div>

            <div class="form-check mb-2">
                <input type="checkbox"
                       class="form-check-input"
                       name="popular"
                       value="1"
                       {{ old('popular',$post->popular) ? 'checked' : '' }}>
                <label class="form-check-label">Popular</label>
            </div>

        </div>

        <div class="col-md-4">

            <div class="form-check">

                <input type="checkbox"
                       class="form-check-input"
                       name="allow_comments"
                       value="1"
                       {{ old('allow_comments',$post->allow_comments) ? 'checked' : '' }}>

                <label class="form-check-label">
                    Allow Comments
                </label>

            </div>

        </div>

    </div>

    <hr>

    <h5>SEO</h5>

    <div class="mb-3">

        <label>Meta Title</label>

        <input type="text"
               name="meta_title"
               class="form-control"
               value="{{ old('meta_title',$post->meta_title) }}">

    </div>

    <div class="mb-3">

        <label>Meta Description</label>

        <textarea name="meta_description"
                  rows="3"
                  class="form-control">{{ old('meta_description',$post->meta_description) }}</textarea>

    </div>

    <div class="mb-3">

        <label>Meta Keywords</label>

        <textarea name="meta_keywords"
                  rows="2"
                  class="form-control">{{ old('meta_keywords',$post->meta_keywords) }}</textarea>

    </div>

    <hr>

    <div class="row">

        <div class="col-md-6">

            <label>Status</label>

            <select name="status" class="form-control">

                <option value="draft"
                    {{ old('status',$post->status)=='draft' ? 'selected' : '' }}>
                    Draft
                </option>

                <option value="published"
                    {{ old('status',$post->status)=='published' ? 'selected' : '' }}>
                    Published
                </option>

            </select>

        </div>

    </div>

    <div class="mt-4">

        <button class="btn btn-primary">
            Update Post
        </button>

        <a href="{{ route('posts.index') }}"
           class="btn btn-secondary">
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