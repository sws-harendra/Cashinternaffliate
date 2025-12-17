@extends('backend.admins.layouts.base')

@push('title')
    <title>Add Job Category | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
    <div class="pcoded-content">

        <!-- Page-header -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Add Job Category</h5>
                            <p class="m-b-0">Create a new job category</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admins.dashboard') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('admins.job-categories.index') }}">
                                    Job Categories
                                </a>
                            </li>
                            <li class="breadcrumb-item">Add</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @include('backend.admins.partials.alerts')

        <div class="card">
            <div class="card-block">

                <form method="POST" action="{{ route('admins.job-categories.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $jobCategory->name ?? '') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_active" class="form-control">
                            <option value="1"
                                {{ old('is_active', $jobCategory->is_active ?? 1) == 1 ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="0"
                                {{ old('is_active', $jobCategory->is_active ?? 1) == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>


                    <div class="mt-3">
                        <button type="submit" class="btn btn-success">
                            Save Category
                        </button>

                        <a href="{{ route('admins.job-categories.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
