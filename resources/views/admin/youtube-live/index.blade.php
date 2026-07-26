@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0">

    <div class="row">
        <div class="col-sm-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">YouTube Live Streams</h4>

                    <a href="{{ route('admin.youtube-live.create') }}"
                       class="btn btn-primary">
                        Add Stream
                    </a>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Live</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($streams as $stream)

                                <tr>

                                    <td>{{ $stream->id }}</td>

                                    <td>
                                        @if($stream->thumbnail)
                                            <img src="{{ asset('storage/'.$stream->thumbnail) }}"
                                                 width="100">
                                        @endif
                                    </td>

                                    <td>{{ $stream->title }}</td>

                                    <td>
                                        @if($stream->is_live)
                                            <span class="badge bg-danger">
                                                LIVE
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($stream->status)
                                            <span class="badge bg-success">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td>

                                        <a href="{{ route('admin.youtube-live.edit',$stream->id) }}"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.youtube-live.delete',$stream->id) }}"
                                              method="POST"
                                              style="display:inline-block;">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete this stream?')">
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                                @empty

                                <tr>
                                    <td colspan="6" class="text-center">
                                        No Streams Found
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    {{ $streams->links() }}

                </div>

            </div>

        </div>
    </div>

</div>

@endsection