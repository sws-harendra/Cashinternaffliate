@extends('backend.admins.layouts.base')

@push('title')
<title>KYC Details | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')

<div class="pcoded-content">

    <!-- Page-header -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">KYC Details</h5>
                        <p class="m-b-0">Review user documents</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.kyc.index') }}">KYC</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Details</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="card">
                    <div class="card-header">
                        <h5>User Information</h5>
                    </div>

                    <div class="card-block">
                        <p><b>Name:</b> {{ $kyc->user->name }}</p>
                        <p><b>Phone:</b> {{ $kyc->user->phone }}</p>
                        <p><b>Email:</b> {{ $kyc->user->email }}</p>
                        <p><b>Address:</b> {{ $kyc->address }}</p>

                        <hr>

                        <p><b>PAN Number:</b> {{ $kyc->pan_number }}</p>
                        <p><b>Aadhaar Number:</b> {{ $kyc->aadhar_number }}</p>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label>PAN Image</label><br>
                                <img src="{{ asset($kyc->pan_image) }}" class="img-fluid img-thumbnail">
                            </div>

                            <div class="col-md-4">
                                <label>Aadhaar Front</label><br>
                                <img src="{{ asset($kyc->aadhar_front_image) }}" class="img-fluid img-thumbnail">
                            </div>

                            <div class="col-md-4">
                                <label>Aadhaar Back</label><br>
                                <img src="{{ asset($kyc->aadhar_back_image) }}" class="img-fluid img-thumbnail">
                            </div>
                        </div>

                        <hr>

                        @if($kyc->kyc_status == 'pending')
                            <form method="POST" action="{{ route('admins.kyc.approve', $kyc->id) }}" class="d-inline">
                                @csrf
                                <button class="btn btn-success">Approve</button>
                            </form>

                            <form method="POST" action="{{ route('admins.kyc.reject', $kyc->id) }}" class="mt-3">
                                @csrf
                                <div class="form-group">
                                    <label>Rejection Reason</label>
                                    <textarea name="rejection_reason" class="form-control" required></textarea>
                                </div>
                                <button class="btn btn-danger">Reject</button>
                            </form>
                        @endif

                        @if($kyc->kyc_status == 'rejected')
                            <div class="alert alert-danger mt-3">
                                <b>Rejected Reason:</b> {{ $kyc->rejection_reason }}
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
