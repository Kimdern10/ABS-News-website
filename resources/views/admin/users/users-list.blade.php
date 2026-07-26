@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-sm-12">

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

        <div class="mb-3">
            <a href="{{ route('users.trashed') }}" class="btn btn-primary">
                View Deleted Users
            </a>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="header-title">
                    <h4 class="card-title mb-0">User List</h4>
                </div>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0 users-table">
                        <thead>
                            <tr>
                                <th class="bg-primary text-white">Name</th>
                                <th class="bg-primary text-white">Email</th>
                                <th class="bg-primary text-white">Role</th>
                                <th class="bg-primary text-white">Status</th>
                                <th class="bg-primary text-white">Join Date</th>
                                <th class="bg-primary text-white">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($users as $user)
                            <tr>

                                <td>{{ $user->name }}</td>

                                <td>{{ $user->email }}</td>

                                <td>
                                    @foreach($user->getRoleNames() as $role)
                                        <span class="badge bg-success">
                                            {{ ucfirst($role) }}
                                        </span>
                                    @endforeach
                                </td>

                                <td>
                                    @if($user->active)
                                        <span class="badge bg-success">
                                            Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Banned
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $user->created_at ? $user->created_at->format('j F, Y') : 'N/A' }}
                                </td>

                               <td>
    @if($user->hasRole('super-admin'))

        <span class="badge bg-danger">
            Super Admin
        </span>

    @else

    <div class="d-flex align-items-center gap-1 flex-wrap">

        @role('super-admin')
        <form action="{{ route('users.update.role', $user->id) }}" method="POST" class="d-flex gap-1">
            @csrf

            <select name="role" class="form-select form-select-sm role-select">
                <option value="user" {{ $user->hasRole('user') ? 'selected' : '' }}>User</option>
                <option value="editor" {{ $user->hasRole('editor') ? 'selected' : '' }}>Editor</option>
                <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
            </select>

            <button type="submit" class="btn btn-success btn-sm px-2">
                ✓
            </button>
        </form>
        @endrole

        <form action="{{ $user->active ? route('user.ban', $user->id) : route('user.unban', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <button type="submit" class="btn btn-warning btn-sm px-2">
                {{ $user->active ? 'Ban' : 'Unban' }}
            </button>
        </form>

        <form action="{{ route('user.delete', $user->id) }}"
              method="POST"
              onsubmit="return confirm('Are you sure you want to delete this user?');">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger btn-sm px-2">
                Delete
            </button>
        </form>

    </div>

    @endif
</td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-danger">
                                    No users found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $users->links() }}
                </div>

            </div>
        </div>

    </div>
</div>


</div>

<style>
.users-table th,
.users-table td{
    vertical-align: middle;
}

.users-table .badge{
    font-size:12px;
}

@media (max-width:768px){

    .users-table th,
    .users-table td{
        font-size:12px;
        padding:6px;
        white-space:nowrap;
    }

    .users-table .btn{
        font-size:11px;
    }

    .users-table .form-select{
        font-size:11px;
    }

    .card-title{
        font-size:16px;
    }
}

@media (max-width:480px){

    .users-table th,
    .users-table td{
        font-size:10px;
        padding:4px;
    }

    .users-table .btn{
        font-size:10px;
    }

    .users-table .form-select{
        font-size:10px;
    }

    .card-title{
        font-size:14px;
    }
}
</style>

@endsection
