@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0">

    <div class="row">

        <div class="col-lg-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Database Backup</h4>

                    <form action="{{ route('admin.backup.run') }}" method="POST">
                        @csrf
                        <button class="btn btn-primary">
                            <i class="fas fa-database"></i>
                            Create Backup
                        </button>
                    </form>

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

                                    <th>#</th>
                                    <th>Backup File</th>
                                    <th>Size</th>
                                    <th>Date</th>
                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                            @forelse($backups as $backup)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $backup['name'] }}</td>

                                    <td>{{ $backup['size'] }}</td>

                                    <td>{{ $backup['date'] }}</td>

                                    <td>

                                        <a href="{{ route('admin.backup.download',$backup['name']) }}"
                                           class="btn btn-success btn-sm">

                                            <i class="fas fa-download"></i>

                                            Download

                                        </a>

                                        <form action="{{ route('admin.backup.delete',$backup['name']) }}"
                                              method="POST"
                                              class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                onclick="return confirm('Delete this backup?')"
                                                class="btn btn-danger btn-sm">

                                                Delete

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center">

                                        No backup found.

                                    </td>

                                </tr>

                            @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection