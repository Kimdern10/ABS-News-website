@extends('layouts.admin')

@section('content')
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-sm-12">

            <div class="mb-3">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    ← Back to Categories List
                </a>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Deleted Categories</h4>
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
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Deleted At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($trashedCategories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $category->name }}</td>

                                        <td>
                                            {{ $category->description ? Str::limit($category->description, 50) : '—' }}
                                        </td>

                                        <td>
                                            {{ optional($category->deleted_at)->format('d M Y h:i A') }}
                                        </td>

                                        <td>
                                            <div class="d-flex gap-2">

                                                <form action="{{ route('admin.categories.restore', $category->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        Restore
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.categories.forceDelete', $category->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Permanently delete this category?');">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Delete Permanently
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-danger">
                                            No deleted categories found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $trashedCategories->links() }}
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


{{-- Custom CSS for responsiveness --}}
<style>
@media (max-width: 768px) {
    .trashed-category-table th,
    .trashed-category-table td {
        font-size: 12px;
        padding: 4px 6px;
        white-space: nowrap;
    }

    .trashed-category-table {
        font-size: 12px;
    }

    .card-title {
        font-size: 16px;
    }
}

@media (max-width: 480px) {
    .trashed-category-table th,
    .trashed-category-table td {
        font-size: 10px;
        padding: 2px 4px;
    }

    .card-title {
        font-size: 14px;
    }
}
</style>
@endsection