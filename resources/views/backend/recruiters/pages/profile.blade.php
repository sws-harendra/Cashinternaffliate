@extends('backend.recruiters.layouts.base')

@push('title')
    <title>Recruiter Profile | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
    <div class="pcoded-content">

        <!-- Page Header -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Company Profile</h5>
                            <p class="m-b-0">Complete your company details</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="{{ route('recruiters.dashboard') }}">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @include('backend.recruiters.partials.alerts')

        <!-- Profile Card -->
        <div class="card">
            <div class="card-header">
                <h5>Company Information</h5>
            </div>

            <div class="card-block">
                <form method="POST" action="{{ route('recruiters.profile.update') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- LOGO --}}
                    <div class="form-group">
                        <label>Company Logo</label><br>

                        @if ($profile && $profile->logo)
                            <img src="{{ asset($profile->logo) }}" class="img-radius mb-2" style="height:80px;">
                        @endif

                        <input type="file" name="logo" class="form-control">
                        <small class="text-muted">JPG / PNG (Max 2MB)</small>
                    </div>

                    <div class="form-group">
                        <label>Company Description</label>
                        <textarea name="company_description" class="form-control" rows="4" required>{{ $profile->company_description ?? '' }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Industry</label>
                            <input type="text" name="industry" class="form-control"
                                value="{{ $profile->industry ?? '' }}">
                        </div>

                        <div class="col-md-6">
                            <label>Company Size</label>
                            <input type="text" name="company_size" class="form-control" placeholder="1-10 / 10-50 / 50+"
                                value="{{ $profile->company_size ?? '' }}">
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label>Company Address</label>
                        <input type="text" name="address" class="form-control" value="{{ $profile->address ?? '' }}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>HR Name</label>
                            <input type="text" name="hr_name" class="form-control" value="{{ $profile->hr_name ?? '' }}">
                        </div>

                        <div class="col-md-6">
                            <label>HR Contact</label>
                            <input type="text" name="hr_contact" class="form-control"
                                value="{{ $profile->hr_contact ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group mt-2">
                        <label>Company Website</label>
                        <input type="url" name="website" class="form-control" placeholder="https://www.example.com"
                            value="{{ $profile->website ?? '' }}">
                    </div>


                    <div class="mt-4">
                        <button class="btn btn-primary">
                            Save Profile
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
@endsection
