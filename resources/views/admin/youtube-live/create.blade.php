@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0">

    <div class="card">

        <div class="card-header">
            <h4>Add YouTube Live Stream</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.youtube-live.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Title
                    </label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        YouTube URL
                    </label>

                    <input type="url"
                           name="youtube_url"
                           class="form-control"
                           placeholder="https://www.youtube.com/watch?v=xxxxx"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Thumbnail
                    </label>

                    <input type="file"
                           name="thumbnail"
                           class="form-control">
                </div>

                <div class="form-check mb-3">

                    <input type="checkbox"
                           name="is_live"
                           class="form-check-input"
                           checked>

                    <label class="form-check-label">
                        Live Stream
                    </label>

                </div>

                <div class="form-check mb-3">

                    <input type="checkbox"
                           name="status"
                           class="form-check-input"
                           checked>

                    <label class="form-check-label">
                        Active
                    </label>

                </div>

                <button type="submit"
                        class="btn btn-primary">

                    Save Stream

                </button>

            </form>

        </div>

    </div>

</div>

@endsection