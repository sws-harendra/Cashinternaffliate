@extends('backend.admins.layouts.base')

@push('title')
<title>User KYC | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')

<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">User KYC</h5>
                        <p class="m-b-0">Verify & manage user KYC requests</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">KYC</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5>KYC Requests</h5>
                    </div>

                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User</th>
                                        <th>PAN</th>
                                        <th>Aadhaar</th>
                                        <th>Status</th>
                                        <th>Submitted</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kycs as $i => $kyc)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>

                                        <td>
                                            <b>{{ $kyc->user->name }}</b><br>
                                            <small>{{ $kyc->user->phone }}</small>
                                        </td>

                                        <td>{{ $kyc->pan_number }}</td>
                                        <td>{{ $kyc->aadhar_number }}</td>

                                        <td>
                                            @if($kyc->kyc_status == 'approved')
                                                <span class="badge badge-success">Approved</span>
                                            @elseif($kyc->kyc_status == 'rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>

                                        <td>{{ $kyc->created_at->format('d M Y') }}</td>

                                        <td>
                                            <a href="{{ route('admins.kyc.show', $kyc->id) }}"
                                               class="btn btn-primary btn-sm">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $kycs->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
