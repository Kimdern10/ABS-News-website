@extends('layouts.admin')

@section('content')

<div class="container">

    <a href="{{ route('live-news.create') }}"
       class="btn btn-primary mb-3">
       Add Live News
    </a>

    <table class="table table-bordered">

        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Live</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        @foreach($news as $item)

        <tr>

            <td>{{ $item->id }}</td>

            <td>
                @if($item->image)
                <img src="{{ asset('storage/'.$item->image) }}"
                     width="80">
                @endif
            </td>

            <td>{{ $item->title }}</td>

            <td>
                @if($item->is_live)
                    🔴 Live
                @endif
            </td>

            <td>
                {{ $item->status ? 'Active' : 'Inactive' }}
            </td>

            <td>

                <a href="{{ route('live-news.edit',$item->id) }}"
                   class="btn btn-warning btn-sm">
                   Edit
                </a>

                <form action="{{ route('live-news.destroy',$item->id) }}"
                      method="POST">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

        @endforeach

    </table>

</div>

@endsection