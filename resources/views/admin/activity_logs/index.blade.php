@extends('layouts.admin')

@section('content')

<div class="content-inner container-fluid pb-0">

<div class="card">

<div class="card-header">
    <h4 class="card-title">
        Activity Logs
    </h4>
</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered">

<thead>

<tr>

<th>#</th>
<th>User</th>
<th>Description</th>
<th>Subject</th>
<th>Date</th>

</tr>

</thead>

<tbody>

@forelse($activities as $activity)

<tr>

<td>{{ $loop->iteration }}</td>

<td>
{{ optional($activity->causer)->name ?? 'System' }}
</td>

<td>
{{ $activity->description }}
</td>

<td>
{{ class_basename($activity->subject_type) }}
</td>

<td>
{{ $activity->created_at->format('d M Y h:i A') }}
</td>

</tr>

@empty

<tr>

<td colspan="5" class="text-center text-danger">

No activity found.

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-3">

{{ $activities->links() }}

</div>

</div>

</div>

</div>

@endsection