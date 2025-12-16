@extends('backend.recruiters.layouts.base')

@push('title')
    <title>Recruiter Verification | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Account Verification</h5>
                        <p class="m-b-0">Recruiter verification status</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('recruiters.dashboard') }}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Verification</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Alerts --}}
    @include('backend.recruiters.partials.alerts')

    {{-- ================= STATUS CARD ================= --}}
    @if($verification)

        <div class="card">
            <div class="card-header">
                <h5>Verification Status</h5>
            </div>

            <div class="card-block">

                {{-- PENDING --}}
                @if($verification->status === 'pending')
                    <div class="alert alert-warning">
                        <strong>Status:</strong> Pending Admin Review
                        <br>
                        <small>
                            Your document has been submitted and is under verification.
                        </small>
                    </div>

                {{-- APPROVED --}}
                @elseif($verification->status === 'approved')
                    <div class="alert alert-success">
                        <strong>Status:</strong> Approved
                        <br>
                        <small>
                            Your account has been verified successfully.
                        </small>
                    </div>

                {{-- REJECTED --}}
                @elseif($verification->status === 'rejected')
                    <div class="alert alert-danger">
                        <strong>Status:</strong> Rejected
                        <br>
                        <small>
                            Reason: {{ $verification->admin_remark ?? 'Not specified' }}
                        </small>
                    </div>

                    {{-- Re-upload option --}}
                    <hr>
                    <h6>Re-upload Verification Document</h6>

                    <form method="POST"
                          action="{{ route('recruiters.verification.store') }}"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Document Type</label>
                            <select name="document_type" class="form-control" required>
                                <option value="">Select Document</option>
                                <option value="GST_CERTIFICATE">GST Certificate</option>
                                <option value="PAN_CARD">PAN Card</option>
                                <option value="MSME_CERTIFICATE">MSME Certificate</option>
                                <option value="ID_CARD">ID Card</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Upload Document</label>
                            <input type="file"
                                   name="document_file"
                                   class="form-control"
                                   required>
                        </div>

                        <button class="btn btn-primary">
                            Re-submit Document
                        </button>
                    </form>
                @endif

            </div>
        </div>

    {{-- ================= UPLOAD FORM (FIRST TIME) ================= --}}
    @else

        <div class="card">
            <div class="card-header">
                <h5>Upload Verification Document</h5>
            </div>

            <div class="card-block">
                <form method="POST"
                      action="{{ route('recruiters.verification.store') }}"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Document Type</label>
                        <select name="document_type" class="form-control" required>
                            <option value="">Select Document</option>
                            <option value="GST_CERTIFICATE">GST Certificate</option>
                            <option value="PAN_CARD">PAN Card</option>
                            <option value="MSME_CERTIFICATE">MSME Certificate</option>
                            <option value="ID_CARD">ID Card</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Upload Document</label>
                        <input type="file"
                               name="document_file"
                               class="form-control"
                               required>
                    </div>

                    <button class="btn btn-primary">
                        Submit for Verification
                    </button>
                </form>
            </div>
        </div>

    @endif

</div>
@endsection
