@extends('backend.admins.layouts.base')

@push('title')
    <title>Recruiter Details | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Recruiter Details</h5>
                        <p class="m-b-0">Complete recruiter information</p>
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
                            <a href="{{ route('admins.recruiters.index') }}">
                                Recruiters
                            </a>
                        </li>
                        <li class="breadcrumb-item">Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('backend.admins.partials.alerts')

    {{-- BASIC --}}
    <div class="card">
        <div class="card-header"><h5>Basic Information</h5></div>
        <div class="card-block">
            <p><strong>Name:</strong> {{ $recruiter->name }}</p>
            <p><strong>Email:</strong> {{ $recruiter->email }}</p>
            <p><strong>Mobile:</strong> {{ $recruiter->mobile }}</p>
            <p><strong>Status:</strong>
                @if($recruiter->is_active)
                    <span class="badge badge-success">Active</span>
                @else
                    <span class="badge badge-danger">Inactive</span>
                @endif
            </p>
        </div>
    </div>

    {{-- PROFILE --}}
    @if($recruiter->profile)
    <div class="card mt-3">
        <div class="card-header"><h5>Company Profile</h5></div>
        <div class="card-block">
            @if($recruiter->profile->logo)
                <img src="{{ asset($recruiter->profile->logo) }}"
                     style="height:70px"><hr>
            @endif
            <p><strong>Industry:</strong> {{ $recruiter->profile->industry }}</p>
            <p><strong>Company Size:</strong> {{ $recruiter->profile->company_size }}</p>
            <p><strong>Address:</strong> {{ $recruiter->profile->address }}</p>
            <p><strong>Website:</strong> {{ $recruiter->profile->website }}</p>
            <p><strong>HR:</strong>
                {{ $recruiter->profile->hr_name }} ({{ $recruiter->profile->hr_contact }})
            </p>
        </div>
    </div>
    @endif

    {{-- VERIFICATION --}}
    <div class="card mt-3">
        <div class="card-header"><h5>Verification Status</h5></div>
        <div class="card-block">
            @if(!$recruiter->verification)
                <span class="badge badge-secondary">Not Uploaded</span>
            @else
                <span class="badge badge-info">
                    {{ ucfirst($recruiter->verification->status) }}
                </span>
                <br><br>
                <a href="{{ asset($recruiter->verification->document_file) }}"
                   target="_blank"
                   class="btn btn-info btn-sm">
                    View Document
                </a>
            @endif
        </div>
    </div>

</div>
@endsection
