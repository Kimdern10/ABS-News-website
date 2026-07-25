@extends('layouts.admin')

@section('content')
<div class="content-inner container-fluid pb-0" id="page_layout">
    <div class="row">
        <div class="col-sm-12">

            <!-- Top Buttons -->
            <div class="mb-3 d-flex flex-wrap gap-2">
                <a href="{{ route('posts.trash') }}" class="btn btn-primary">
                    <i class="fa fa-trash"></i> Trashed Posts
                </a>

                <a href="{{ route('posts.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add New Post
                </a>
            </div>

            <!-- Posts Card -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Posts List</h4>
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
                                    <th>Author</th>
                                    <th>Status</th>
                                    <th>Views</th>
                                    <th>Created</th>
                                    <th width="190">Actions</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($posts as $post)

                                <tr>

                                     <td>
                                        {{ Str::limit($post->title, 15) }}
                                    </td>

                                    <td>
                                        {{ $post->author_name ?: ($post->user->name ?? '-') }}
                                    </td>

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

                                    <td>
                                        {{ number_format($post->views) }}
                                    </td>

                                    <td>
                                        {{ $post->created_at->format('d M Y') }}
                                    </td>

                                    <td>
                                        <div class="d-flex flex-wrap gap-1">

                                            {{-- Publish / Unpublish --}}
                                            <form action="{{ route('posts.toggle-status',$post->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')

                                                @if($post->status == 'published')
                                                    <button type="submit" class="btn btn-secondary btn-sm">
                                                        Unpublish
                                                    </button>
                                                @else
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        Publish
                                                    </button>
                                                @endif
                                            </form>

                                            {{-- Edit --}}
                                            <a href="{{ route('posts.edit',$post->id) }}"
                                               class="btn btn-warning btn-sm">
                                                Edit
                                            </a>

                                            {{-- Trash --}}
                                            <form action="{{ route('posts.destroy',$post->id) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Move this post to trash?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm">
                                                    Trash
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                                @empty

                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        No posts found.
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
    font-size: 11px;
    padding: 6px 10px;
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



.post-table img{
    object-fit: cover;
    border-radius: 6px;
}

.badge{
    font-size: 10px;
    padding: 4px 8px;
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

/* Small icons */
.btn i.fa,
.btn i.fas,
.btn i.fa-solid{
    font-size: 10px !important;
    margin-right: 3px;
}

/* Small action buttons */
.post-table .btn-sm{
    font-size: 11px;
    padding: 4px 8px;
}

/* Top buttons */
.mb-3 .btn{
    font-size: 12px;
    padding: 6px 10px;
}

/* Table styling */
.post-table th{
    white-space: nowrap;
    font-size: 13px;
}

.post-table td{
    font-size: 12px;
}

/* Mobile */
@media(max-width:768px){

    .card-title{
        font-size: 16px;
    }

    .table-responsive{
        overflow-x: auto;
    }

    .post-table{
        min-width: 650px;
        font-size: 11px;
    }

    .post-table th,
    .post-table td{
        white-space: nowrap;
        padding: 6px;
    }

    .badge{
        font-size: 8px;
        padding: 3px 6px;
    }

    .btn{
        font-size: 11px;
    }

    .post-table .btn-sm{
        font-size: 10px;
        padding: 4px 6px;
    }

    .btn i.fa,
    .btn i.fas,
    .btn i.fa-solid{
        font-size: 8px !important;
        margin-right: 2px;
    }

    .mb-3 .btn{
        font-size: 11px;
        padding: 5px 8px;
    }

    .d-flex.gap-1{
        flex-direction: column;
    }

    .d-flex.gap-1 .btn{
        width: 100%;
    }
}

/* Very small phones */
@media(max-width:480px){

    .card-title{
        font-size: 14px;
    }

    .post-table{
        min-width: 600px;
    }

    .btn i.fa,
    .btn i.fas,
    .btn i.fa-solid{
        font-size: 7px !important;
    }

    .post-table .btn-sm{
        font-size: 9px;
        padding: 3px 5px;
    }
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

    .d-flex.gap-1{
        flex-direction: column;
    }

    .d-flex.gap-1 .btn{
        width: 100%;
    }
}

</style>
@endsection