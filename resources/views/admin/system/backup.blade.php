@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0">

    <div class="row">

        <div class="col-lg-12">

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h4 class="card-title">
                        <i class="fas fa-database text-primary"></i>
                        Database Backup
                    </h4>

                    <form action="{{ route('admin.backup.run') }}" method="POST">
    @csrf

    <button type="submit" class="btn btn-primary">
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

                    @if(session('error'))

                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>

                    @endif

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover">

                            <thead>

                            <tr>

                                <th width="70">#</th>

                                <th>Backup File</th>

                                <th width="140">Size</th>

                                <th width="180">Created</th>

                                <th width="220">Action</th>

                            </tr>

                            </thead>

                            <tbody>

                            @forelse($backups as $backup)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>

                                        <i class="fas fa-file-archive text-warning"></i>

                                        {{ $backup['name'] }}

                                    </td>

                                    <td>

                                        {{ $backup['size'] }}

                                    </td>

                                    <td>

                                        {{ $backup['date'] }}

                                    </td>

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

                                                <i class="fas fa-trash"></i>

                                                Delete

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="text-center text-danger">

                                        No backup available.

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

<style>

.table th{

    background:#0d6efd;
    color:#fff;

}

.table td{

    vertical-align:middle;

}

@media(max-width:768px){

.table{

    font-size:13px;

}

.btn{

    margin-bottom:4px;

}

}

</style>

@endsection