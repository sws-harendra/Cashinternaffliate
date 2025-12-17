@extends('backend.admins.layouts.base')

@push('title')
<title>Pending Jobs | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

<div class="page-header">
    <div class="page-block">
        <h5 class="m-b-10">Pending Job Approvals</h5>
        <p class="m-b-0">Review recruiter job postings</p>
    </div>
</div>

@include('backend.admins.partials.alerts')

<div class="card">
<div class="card-block table-responsive">

<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Recruiter</th>
            <th>Category</th>
            <th>Location</th>
            <th>Posted On</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
    @forelse($jobs as $job)
        <tr>
            <td>{{ $job->id }}</td>
            <td>{{ $job->title }}</td>
            <td>{{ $job->recruiter->name ?? 'N/A' }}</td>
            <td>{{ $job->category->name ?? 'N/A' }}</td>
            <td>
                {{ optional($job->location)->city }},
                {{ optional($job->location)->state }}
            </td>
            <td>{{ $job->created_at->format('d M Y') }}</td>
            <td>
                <a href="{{ route('admins.jobs.show', $job->id) }}"
                   class="btn btn-sm btn-primary">
                    Review
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center text-muted">
                No pending jobs found.
            </td>
        </tr>
    @endforelse
    </tbody>
</table>

{{ $jobs->links() }}

</div>
</div>

</div>
@endsection
