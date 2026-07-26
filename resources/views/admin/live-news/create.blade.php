@extends('layouts.admin')

@section('content')

<form action="{{ route('live-news.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

<div class="mb-3">
    <label>Title</label>
    <input type="text"
           name="title"
           class="form-control">
</div>

<div class="mb-3">
    <label>Content</label>
    <textarea name="content"
              rows="10"
              class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Image</label>
    <input type="file"
           name="image"
           class="form-control">
</div>

<div class="mb-3">

    <input type="checkbox"
           name="is_live"
           checked>

    Live News

</div>

<div class="mb-3">

    <input type="checkbox"
           name="status"
           checked>

    Active

</div>

<button class="btn btn-primary">
    Save
</button>

</form>

@endsection