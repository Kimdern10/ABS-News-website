@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0">

    <div class="card">

        <div class="card-header d-flex justify-content-between">

            <h4>Eyewitness Trash</h4>

            <a href="{{ route('admin.eyewitness.index') }}"
               class="btn btn-primary btn-sm">
                Back
            </a>

        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Title</th>

                            <th>User</th>

                            <th>Deleted At</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($eyewitness as $news)

                            <tr>

                                <td>{{ $news->id }}</td>

                                <td>{{ $news->title }}</td>

                                <td>{{ $news->user->name ?? 'N/A' }}</td>

                                <td>{{ $news->deleted_at }}</td>

                                <td>

                                    <div class="d-flex gap-1">

                                        <a href="{{ route('admin.eyewitness.restore', $news->id) }}"
                                           class="btn btn-success btn-sm">
                                            Restore
                                        </a>

                                        <form action="{{ route('admin.eyewitness.delete', $news->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete permanently?')">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm">
                                                Permanent Delete
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center">
                                    Trash is empty.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection