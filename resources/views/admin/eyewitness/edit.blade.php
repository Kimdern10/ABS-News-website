@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0">

    <div class="card">

        <div class="card-header">
            <h4>Edit Eyewitness News</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.eyewitness.update', $news->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title</label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title', $news->title) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Location</label>

                    <input type="text"
                           name="location"
                           class="form-control"
                           value="{{ old('location', $news->location) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Content</label>

                    <textarea name="content"
                              rows="8"
                              class="form-control">{{ old('content', $news->content) }}</textarea>
                </div>

                @if($news->image)
                    <div class="mb-3">

                        <label class="form-label">
                            Current Image
                        </label>

                        <br>

                        <img src="{{ asset('storage/'.$news->image) }}"
                             width="200"
                             class="img-thumbnail">

                    </div>
                @endif

                <div class="mb-3">

                    <label class="form-label">
                        Replace Image
                    </label>

                    <input type="file"
                           name="image"
                           class="form-control">

                </div>

                <button type="submit"
                        class="btn btn-primary">
                    Update News
                </button>

            </form>

        </div>

    </div>

</div>

@endsection