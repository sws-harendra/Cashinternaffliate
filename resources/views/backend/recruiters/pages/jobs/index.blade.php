@extends('backend.recruiters.layouts.base')

@push('title')
<title>My Jobs | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">My Job Posts</h5>
                        <p class="m-b-0">Manage your job postings</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('backend.recruiters.partials.alerts')

    <div class="card">
        <div class="card-block table-responsive">

            <a href="{{ route('recruiters.jobs.create') }}"
               class="btn btn-primary mb-3">
                + Post New Job
            </a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Posted On</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($jobs as $job)
                    <tr>
                        <td>{{ $job->id }}</td>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->category->name }}</td>
                        <td>{{ $job->location->city }}, {{ $job->location->state }}</td>

                        <td>
                            @if($job->status === 'approved')
                                <span class="badge badge-success">Approved</span>
                            @elseif($job->status === 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($job->status === 'rejected')
                                <span class="badge badge-danger">Rejected</span>
                            @else
                                <span class="badge badge-secondary">Draft</span>
                            @endif
                        </td>

                        <td>{{ $job->created_at->format('d M Y') }}</td>

                        <td>
                            @if($job->status !== 'approved')
                                <a href="{{ route('recruiters.jobs.edit', $job->id) }}"
                                   class="btn btn-sm btn-info">
                                    Edit
                                </a>
                            @else
                                <span class="text-muted">Locked</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            No jobs posted yet.
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
