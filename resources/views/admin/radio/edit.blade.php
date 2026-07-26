@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0">

    <div class="card">

        <div class="card-header">
            <h4>Edit Radio Stream</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('admin.radio.update',$radio->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Radio Title
                    </label>

                    <input type="text"
                           name="title"
                           value="{{ $radio->title }}"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Stream URL
                    </label>

                    <input type="text"
                           name="stream_url"
                           value="{{ $radio->stream_url }}"
                           class="form-control"
                           required>

                </div>

                <div class="form-check mb-3">

                    <input type="checkbox"
                           name="is_live"
                           class="form-check-input"
                           {{ $radio->is_live ? 'checked' : '' }}>

                    <label class="form-check-label">
                        Live
                    </label>

                </div>

                <div class="form-check mb-3">

                    <input type="checkbox"
                           name="status"
                           class="form-check-input"
                           {{ $radio->status ? 'checked' : '' }}>

                    <label class="form-check-label">
                        Active
                    </label>

                </div>

                <button class="btn btn-success">

                    Update Stream

                </button>

            </form>

        </div>

    </div>

</div>

@endsection


