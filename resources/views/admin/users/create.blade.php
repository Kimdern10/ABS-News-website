@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <div class="row">

        <div class="col-lg-8 mx-auto">

            <div class="card">

                <div class="card-header">
                    <h4>Create Admin / Editor</h4>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.users.store') }}" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label>Name</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required>
                        </div>

                        <div class="mb-3">

                            <label>Role</label>

                            <select
                                name="role"
                                class="form-select"
                                required>

                                <option value="">Select Role</option>

                                <option value="admin">Admin</option>

                                <option value="editor">Editor</option>

                            </select>

                        </div>

                        <button class="btn btn-primary">
                            Create Account
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection