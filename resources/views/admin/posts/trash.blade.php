@extends('layouts.admin')

@section('content')
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-sm-12">

            <!-- Back Button -->
            <div class="mb-3">
                <a href="{{ route('posts.index') }}" class="btn btn-primary">
                    <i class="fa fa-arrow-left"></i> Back to Posts
                </a>
            </div>

            <!-- Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Trashed Posts</h4>
                </div>

                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped align-middle post-table">

                            <thead class="table-primary">
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Deleted At</th>
                                    <th width="220">Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($posts as $post)

                                <tr>


                                    <!-- Title -->
                                    <td>
                                        {{ Str::limit($post->title, 15) }}
                                    </td>

                                    <!-- Category -->
                                    <td>
                                        {{ $post->category->name ?? 'No Category' }}
                                    </td>

                                    <!-- Author -->
                                    <td>
                                        {{ $post->author_name ?: ($post->user->name ?? '-') }}
                                    </td>

                                    <!-- Status -->
                                    <td>
                                        @if($post->status == 'published')
                                            <span class="badge bg-success">
                                                Published
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Draft
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Views -->
                                   

                                    <!-- Published Date -->

                                    <!-- Deleted Date -->
                                    <td>
                                        @if($post->deleted_at)
                                            {{ $post->deleted_at->format('d M Y h:i A') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <!-- Actions -->
                                    <td>
                                        <div class="d-flex flex-column gap-1">

                                            <!-- Restore -->
                                            <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-success btn-sm w-100">
                                                    <i class="fa fa-undo"></i> Restore
                                                </button>
                                            </form>

                                            <!-- Delete Permanently -->
                                            <form action="{{ route('posts.forceDelete', $post->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this post permanently?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm w-100">
                                                    <i class="fa fa-trash"></i> Delete Permanently
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                                @empty

                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        No trashed posts found.
                                    </td>
                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $posts->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<style>
.post-table img{
    object-fit: cover;
    border-radius: 6px;
}

.badge{
    font-size: 9px;
    padding: 4px 9px;
}

.table td,
.table th{
    vertical-align: middle;
}

.card{
    border-radius: 10px;
}

.card-header{
    background: #fff;
    border-bottom: 1px solid #eee;
}

/* Small action icons */
.btn i.fa,
.btn i.fa-solid,
.btn i.fas {
    font-size: 11px !important;
    margin-right: 4px;
}

/* Smaller buttons in trash table */
.post-table .btn-sm {
    font-size: 11px;
    padding: 4px 8px;
}
@media(max-width:768px){

    .post-table{
        font-size: 12px;
    }

    .post-table th,
    .post-table td{
        white-space: nowrap;
        padding: 8px;
    }

    .card-title{
        font-size: 18px;
    }

    .btn{
        font-size: 12px;
    }

    .d-flex.flex-column .btn{
        width: 100%;
    }

}

/* =========================
   Responsive Design
========================= */

/* Tablet */
@media (max-width: 991px) {

    .card-body{
        padding: 15px;
    }

    .card-title{
        font-size: 18px;
    }

    .post-table{
        font-size: 13px;
    }

    .post-table th,
    .post-table td{
        padding: 10px 8px;
        white-space: nowrap;
        vertical-align: middle;
    }

    .post-table .btn-sm{
        font-size: 11px;
        padding: 5px 8px;
    }

    .btn i.fa,
    .btn i.fa-solid,
    .btn i.fas{
        font-size: 10px !important;
    }
}

/* Mobile */
@media (max-width: 768px) {

    .content-inner{
        padding-left: 10px;
        padding-right: 10px;
    }

    .card{
        border-radius: 8px;
    }

    .card-header{
        padding: 12px 15px;
    }

    .card-body{
        padding: 12px;
    }

    .card-title{
        font-size: 16px;
        font-weight: 600;
    }

    .table-responsive{
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .post-table{
        min-width: 750px;
        font-size: 12px;
    }

    .post-table th,
    .post-table td{
        padding: 8px 6px;
        white-space: nowrap;
    }

    .badge{
        font-size: 8px;
        padding: 4px 7px;
    }

    .post-table .btn-sm{
        font-size: 10px;
        padding: 4px 6px;
    }

    .btn i.fa,
    .btn i.fa-solid,
    .btn i.fas{
        font-size: 9px !important;
        margin-right: 3px;
    }

    .pagination{
        justify-content: center;
        flex-wrap: wrap;
    }
}

/* Small Mobile */
@media (max-width: 576px) {

    .card-title{
        font-size: 15px;
    }

    .post-table{
        min-width: 700px;
        font-size: 11px;
    }

    .post-table th,
    .post-table td{
        padding: 6px 5px;
    }

    .badge{
        font-size: 7px;
        padding: 3px 6px;
    }

    .post-table .btn-sm{
        font-size: 9px;
        padding: 4px 5px;
    }

    .btn i.fa,
    .btn i.fa-solid,
    .btn i.fas{
        font-size: 8px !important;
    }

    .alert{
        font-size: 12px;
    }
}

/* Extra Small Devices */
@media (max-width: 400px) {

    .card-title{
        font-size: 14px;
    }

    .post-table{
        min-width: 650px;
        font-size: 10px;
    }

    .post-table .btn-sm{
        font-size: 8px;
        padding: 3px 5px;
    }

    .btn i.fa,
    .btn i.fa-solid,
    .btn i.fas{
        font-size: 7px !important;
    }
}
</style>

@endsection