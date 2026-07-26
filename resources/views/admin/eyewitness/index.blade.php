@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0">

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h4 class="mb-0">Eyewitness News</h4>

            <a href="{{ route('admin.eyewitness.trash') }}"
               class="btn btn-danger btn-sm">
                Trash
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
                            <th>Image</th>
                            <th>Title</th>
                            <th>User</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th width="350">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @if($eyewitness && count($eyewitness))

                            @foreach($eyewitness as $news)

                                @if(is_object($news))

                                <tr>

                                    <td>{{ $news->id }}</td>

                                    <td>

                                        @if(!empty($news->image))

                                            <img src="{{ asset('storage/'.$news->image) }}"
                                                 width="80"
                                                 height="60"
                                                 style="object-fit:cover;border-radius:5px;">

                                        @else

                                            No Image

                                        @endif

                                    </td>

                                    <td>{{ $news->title }}</td>

                                    <td>
                                        {{ optional($news->user)->name ?? 'N/A' }}
                                    </td>

                                    <td>
                                        {{ $news->location ?? 'N/A' }}
                                    </td>

                                    <td>

                                        @if($news->status == 'pending')

                                            <span class="badge bg-warning">
                                                Pending
                                            </span>

                                        @elseif($news->status == 'approved')

                                            <span class="badge bg-success">
                                                Approved
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                Rejected
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        {{ $news->created_at->format('d M Y') }}
                                    </td>

                                    <td>

                                        <div class="d-flex flex-wrap gap-1">

                                            <a href="{{ route('admin.eyewitness.edit', $news->id) }}"
                                               class="btn btn-primary btn-sm">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.eyewitness.status', $news->id) }}"
                                                  method="POST">
                                                @csrf

                                                <input type="hidden"
                                                       name="status"
                                                       value="approved">

                                                <button type="submit"
                                                        class="btn btn-success btn-sm">
                                                    Approve
                                                </button>

                                            </form>

                                            <form action="{{ route('admin.eyewitness.status', $news->id) }}"
                                                  method="POST">
                                                @csrf

                                                <input type="hidden"
                                                       name="status"
                                                       value="rejected">

                                                <button type="submit"
                                                        class="btn btn-warning btn-sm">
                                                    Reject
                                                </button>

                                            </form>

                                            <form action="{{ route('admin.eyewitness.delete', $news->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Move this eyewitness news to trash?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                                @endif

                            @endforeach

                        @else

                            <tr>

                                <td colspan="8" class="text-center">
                                    No eyewitness news found.
                                </td>

                            </tr>

                        @endif

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection