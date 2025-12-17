@extends('backend.admins.layouts.base')

@push('title')
    <title>Add Experience Level | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Experience Level</h5>
                        <p class="m-b-0">Create a new experience level</p>
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
                            <a href="{{ route('admins.experience-levels.index') }}">Experience Levels</a>
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

            <form method="POST" action="{{ route('admins.experience-levels.store') }}">
                @csrf

                @include('backend.admins.pages.experience_levels._form')

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">
                        Save Experience Level
                    </button>

                    <a href="{{ route('admins.experience-levels.index') }}"
                       class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
