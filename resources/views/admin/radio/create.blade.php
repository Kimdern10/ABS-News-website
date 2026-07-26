@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0">

    <div class="card">

        <div class="card-header">
            <h4>Add Radio Stream</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.radio.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Radio Title
                    </label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Stream URL
                    </label>

                    <input type="text"
                           name="stream_url"
                           class="form-control"
                           placeholder="https://your-stream-url.com/live.mp3"
                           required>

                </div>

                <div class="form-check mb-3">

                    <input type="checkbox"
                           name="is_live"
                           class="form-check-input"
                           checked>

                    <label class="form-check-label">
                        Live
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

                <button class="btn btn-primary">

                    Save Stream

                </button>

            </form>

        </div>

    </div>

</div>

@endsection