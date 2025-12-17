@extends('backend.admins.layouts.base')

@push('title')
<title>Review Job | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

@include('backend.admins.partials.alerts')

<div class="card">
<div class="card-header">
    <h5>{{ $job->title }}</h5>
    <span class="text-muted">
        Recruiter: {{ $job->recruiter->name }} ({{ $job->recruiter->email }})
    </span>
</div>

<div class="card-block">

<p><strong>Category:</strong> {{ $job->category->name ?? 'N/A' }}</p>
<p><strong>Role:</strong> {{ $job->role->name ?? 'N/A' }}</p>
<p><strong>Type:</strong> {{ $job->type->name ?? 'N/A' }}</p>
<p><strong>Location:</strong>
    {{ optional($job->location)->city }},
    {{ optional($job->location)->state }}
</p>
<p><strong>Experience:</strong> {{ $job->experience->label ?? 'N/A' }}</p>
<p><strong>Salary:</strong> {{ $job->salary->label ?? 'Not Disclosed' }}</p>

<hr>

<h6>Description</h6>
<p>{{ $job->description }}</p>

@if($job->responsibilities)
<hr>
<h6>Responsibilities</h6>
<p>{{ $job->responsibilities }}</p>
@endif

@if($job->skills)
<hr>
<h6>Skills</h6>
<p>{{ $job->skills }}</p>
@endif

<hr>

<div class="row">
    <div class="col-md-6">
        <form method="POST"
              action="{{ route('admins.jobs.approve', $job->id) }}">
            @csrf
            <button class="btn btn-success btn-block">
                Approve Job
            </button>
        </form>
    </div>

    <div class="col-md-6">
        <form method="POST"
              action="{{ route('admins.jobs.reject', $job->id) }}">
            @csrf
            <textarea name="reason"
                      class="form-control mb-2"
                      placeholder="Rejection reason"
                      required></textarea>
            <button class="btn btn-danger btn-block">
                Reject Job
            </button>
        </form>
    </div>
</div>

</div>
</div>

</div>
@endsection
