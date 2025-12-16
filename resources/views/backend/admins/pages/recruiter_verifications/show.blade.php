@extends('backend.admins.layouts.base')

@push('title')
    <title>Verify Recruiter | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Recruiter Verification</h5>
                        <p class="m-b-0">Review recruiter document</p>
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
                            <a href="{{ route('admins.recruiter.verifications') }}">
                                Recruiter Verifications
                            </a>
                        </li>
                        <li class="breadcrumb-item">Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    @include('backend.admins.partials.alerts')

    <div class="card">
        <div class="card-header">
            <h5>Recruiter Details</h5>
        </div>

        <div class="card-block">
            <p><strong>Name:</strong> {{ $verification->recruiter->name }}</p>
            <p><strong>Email:</strong> {{ $verification->recruiter->email }}</p>
            <p><strong>Document Type:</strong> {{ $verification->document_type }}</p>

            <p>
                <strong>Uploaded Document:</strong><br>
                <a href="{{ asset( $verification->document_file) }}"
                   target="_blank"
                   class="btn btn-sm btn-info">
                    View Document
                </a>
            </p>

            <hr>

            @if($verification->status === 'pending')

                <form method="POST"
                      action="{{ route('admins.recruiter.verifications.approve', $verification->id) }}"
                      class="d-inline">
                    @csrf
                    <button class="btn btn-success">
                        Approve
                    </button>
                </form>

                <button class="btn btn-danger"
                        data-toggle="modal"
                        data-target="#rejectModal">
                    Reject
                </button>

            @else
                <span class="badge badge-info">
                    Already {{ ucfirst($verification->status) }}
                </span>
            @endif
        </div>
    </div>

</div>

{{-- Reject Modal --}}
<div class="modal fade" id="rejectModal">
    <div class="modal-dialog">
        <form method="POST"
              action="{{ route('admins.recruiter.verifications.reject', $verification->id) }}">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Reject Verification</h5>
                </div>

                <div class="modal-body">
                    <textarea name="admin_remark"
                              class="form-control"
                              placeholder="Reason for rejection"
                              required></textarea>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn btn-danger">
                        Reject
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
