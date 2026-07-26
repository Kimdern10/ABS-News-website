@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4>Radio Streams</h4>

            <a href="{{ route('admin.radio.create') }}"
               class="btn btn-primary">
                <i class="fa fa-plus"></i> Add Radio Stream
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
                            <th>Title</th>
                            <th>Stream URL</th>
                            <th>Live</th>
                            <th>Status</th>
                            <th width="300">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($radios as $radio)

                        <tr>

                            <td>{{ $radio->id }}</td>

                            <td>{{ $radio->title }}</td>

                            <td>
                                <small>
                                    {{ Str::limit($radio->stream_url, 50) }}
                                </small>
                            </td>

                            <td>
                                @if($radio->is_live)
                                    <span class="badge bg-danger">
                                        LIVE
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        OFF
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if($radio->status)
                                    <span class="badge bg-success">
                                        Active
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td>

                                <div class="d-flex gap-2 flex-wrap">

                                    <!-- Edit -->
                                    <a href="{{ route('admin.radio.edit', $radio->id) }}"
                                       class="btn btn-warning btn-sm">
                                       <i class="fa fa-edit me-1" style="font-size:12px;"></i>
                                    </a>

                                    <!-- Toggle -->
                                    <form action="{{ route('admin.radio.toggle', $radio->id) }}"
                                          method="POST">
                                        @csrf

                                        @if($radio->status)

                                            <button type="submit"
                                                    class="btn btn-secondary btn-sm">
                                               <i class="fa fa-power-off me-1" style="font-size:12px;"></i>
                                                Turn OFF
                                            </button>

                                        @else

                                            <button type="submit"
                                                    class="btn btn-success btn-sm">
                                               <i class="fa fa-power-off me-1" style="font-size:12px;"></i>
                                                Turn ON
                                            </button>

                                        @endif

                                    </form>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.radio.delete', $radio->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this radio stream?')">

                                            <i class="fa fa-trash me-1" style="font-size:12px;"></i>
                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                No Radio Streams Found
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

            <div class="mt-3">
                {{ $radios->links() }}
            </div>

        </div>

    </div>

</div>

@endsection