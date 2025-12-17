@extends('backend.admins.layouts.base')

@push('title')
    <title>Salary Ranges | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page-header -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Salary Ranges</h5>
                        <p class="m-b-0">Manage job salary ranges</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Salary Ranges</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('backend.admins.partials.alerts')

    <div class="card">
        <div class="card-block table-responsive">

            <a href="{{ route('admins.salary-ranges.create') }}"
               class="btn btn-primary mb-3">
                + Add Salary Range
            </a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Label</th>
                        <th>Min</th>
                        <th>Max</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($ranges as $range)
                    <tr>
                        <td>{{ $range->id }}</td>
                        <td>{{ $range->label }}</td>
                        <td>{{ $range->min_salary ? '₹'.$range->min_salary : '-' }}</td>
                        <td>{{ $range->max_salary ? '₹'.$range->max_salary : '-' }}</td>
                        <td>
                            @if($range->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admins.salary-ranges.edit', $range->id) }}"
                               class="btn btn-sm btn-info">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No salary ranges found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $ranges->links() }}

        </div>
    </div>

</div>
@endsection
