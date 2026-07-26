@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0">

    <div class="card">

        <div class="card-header">
            <h4>Edit YouTube Live Stream</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.youtube-live.update',$stream->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">
                        Title
                    </label>

                    <input type="text"
                           name="title"
                           value="{{ $stream->title }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        YouTube URL
                    </label>

                    <input type="url"
                           name="youtube_url"
                           value="{{ $stream->youtube_url }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Current Thumbnail
                    </label>

                    <br>

                    @if($stream->thumbnail)

                        <img src="{{ asset('storage/'.$stream->thumbnail) }}"
                             width="150"
                             class="mb-2">

                    @endif

                    <input type="file"
                           name="thumbnail"
                           class="form-control">

                </div>

                <div class="form-check mb-3">

                    <input type="checkbox"
                           name="is_live"
                           class="form-check-input"
                           {{ $stream->is_live ? 'checked' : '' }}>

                    <label class="form-check-label">
                        Live Stream
                    </label>

                </div>

                <div class="form-check mb-3">

                    <input type="checkbox"
                           name="status"
                           class="form-check-input"
                           {{ $stream->status ? 'checked' : '' }}>

                    <label class="form-check-label">
                        Active
                    </label>

                </div>

                <button type="submit"
                        class="btn btn-success">

                    Update Stream

                </button>

            </form>

        </div>

    </div>

</div>

@endsection