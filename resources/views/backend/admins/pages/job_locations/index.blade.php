@extends('backend.admins.layouts.base')

@push('title')
    <title>Job Locations | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Job Locations</h5>
                        <p class="m-b-0">Manage job cities & states</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Job Locations</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('backend.admins.partials.alerts')

    <div class="card">
        <div class="card-block table-responsive">

            <a href="{{ route('admins.job-locations.create') }}"
               class="btn btn-primary mb-3">
                + Add Location
            </a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($locations as $l)
                    <tr>
                        <td>{{ $l->id }}</td>
                        <td>{{ $l->city }}</td>
                        <td>{{ $l->state }}</td>
                        <td>{{ $l->country }}</td>
                        <td>
                            @if($l->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admins.job-locations.edit', $l->id) }}"
                               class="btn btn-sm btn-info">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No job locations found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $locations->links() }}

        </div>
    </div>

</div>
@endsection
