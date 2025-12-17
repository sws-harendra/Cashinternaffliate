@extends('backend.admins.layouts.base')

@push('title')
    <title>Edit Job Type | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Job Type</h5>
                        <p class="m-b-0">Update job type details</p>
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
                            <a href="{{ route('admins.job-types.index') }}">Job Types</a>
                        </li>
                        <li class="breadcrumb-item">Edit</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('backend.admins.partials.alerts')

    <div class="card">
        <div class="card-block">

            <form method="POST"
                  action="{{ route('admins.job-types.update', $jobType->id) }}">
                @csrf
                @method('PUT')

                @include('backend.admins.pages.job_types._form')

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        Update Job Type
                    </button>

                    <a href="{{ route('admins.job-types.index') }}"
                       class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
