@extends('backend.admins.layouts.base')

@push('title')
    <title>Job Categories | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page-header -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Job Categories</h5>
                        <p class="m-b-0">Manage job categories</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Job Categories</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('backend.admins.partials.alerts')

    <div class="card">
        <div class="card-block table-responsive">

            <a href="{{ route('admins.job-categories.create') }}"
               class="btn btn-primary mb-3">
                + Add Category
            </a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($categories as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->name }}</td>
                        <td>
                            @if($c->is_active)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admins.job-categories.edit', $c->id) }}"
                               class="btn btn-sm btn-info">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            No job categories found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{ $categories->links() }}

        </div>
    </div>

</div>
@endsection
