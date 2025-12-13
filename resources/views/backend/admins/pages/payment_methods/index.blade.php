@extends('backend.admins.layouts.base')

@push('title')
<title>Payment Verification | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Payment Verification</h5>
                        <p class="m-b-0">Verify user UPI & Bank details</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Payment Methods</a></li>
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
                        <h5>User Payment Methods</h5>
                    </div>

                    <div class="card-block table-responsive">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Details</th>
                                    <th>Payment Type</th>
                                    <th>Payment Info</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($methods as $index => $method)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <!-- USER DETAILS -->
                                        <td>
                                            <strong>{{ $method->user->name ?? 'N/A' }}</strong><br>
                                            <small>Email: {{ $method->user->email ?? '-' }}</small><br>
                                            <small>Phone: {{ $method->user->phone ?? '-' }}</small><br>
                                            <small>User UUID: {{ $method->user_id }}</small>
                                        </td>

                                        <!-- TYPE -->
                                        <td>
                                            <span class="badge badge-info">
                                                {{ strtoupper($method->type) }}
                                            </span>
                                        </td>

                                        <!-- PAYMENT DETAILS -->
                                        <td>
                                            @if($method->type === 'upi')
                                                <b>UPI ID:</b> {{ $method->upi_id }}<br>
                                                <b>Name:</b> {{ $method->holder_name }}
                                            @else
                                                <b>Bank:</b> {{ $method->bank_name }}<br>
                                                <b>Account:</b> XXXX{{ substr($method->account_number, -4) }}<br>
                                                <b>IFSC:</b> {{ $method->ifsc_code }}<br>
                                                <b>Name:</b> {{ $method->holder_name }}
                                            @endif
                                        </td>

                                        <!-- STATUS -->
                                        <td>
                                            @if($method->verification_status === 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($method->verification_status === 'approved')
                                                <span class="badge badge-success">Approved</span><br>
                                                <small>
                                                    {{ optional($method->verified_at)->format('d M Y h:i A') }}
                                                </small>
                                            @else
                                                <span class="badge badge-danger">Rejected</span><br>
                                                <small>{{ $method->rejection_reason }}</small>
                                            @endif
                                        </td>

                                        <!-- ACTION -->
                                        <td>
                                            @if($method->verification_status === 'pending')

                                                <form method="POST"
                                                      action="{{ route('admins.payment.methods.approve', $method->id) }}"
                                                      style="display:inline">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm">
                                                        Approve
                                                    </button>
                                                </form>

                                                <button class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#rejectModal{{ $method->id }}">
                                                    Reject
                                                </button>

                                            @else
                                                —
                                            @endif
                                        </td>
                                    </tr>

                                    <!-- Reject Modal -->
                                    <div class="modal fade" id="rejectModal{{ $method->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <form method="POST"
                                                  action="{{ route('admins.payment.methods.reject', $method->id) }}">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Reject Payment Method</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Rejection Reason</label>
                                                            <textarea name="rejection_reason"
                                                                      class="form-control"
                                                                      required></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-danger">
                                                            Reject
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            No payment methods found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {{ $methods->links() }}

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
