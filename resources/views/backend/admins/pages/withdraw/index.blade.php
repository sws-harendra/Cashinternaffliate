@extends('backend.admins.layouts.base')

@push('title')
<title>Withdraw Requests | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page-header -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Withdraw Requests</h5>
                        <p class="m-b-0">Approve or reject user withdrawals</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}">
                                <i class="fa fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Withdraws</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5>Withdraw Requests</h5>
                    </div>

                    <div class="card-block table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Requested At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($withdraws as $i => $w)
                                <tr>
                                    <td>{{ $i + 1 }}</td>

                                    <td>
                                        <b>{{ $w->user->name ?? 'N/A' }}</b><br>
                                        <small>{{ $w->user->phone ?? '' }}</small><br>
                                        <small>ID: {{ $w->user_id }}</small>
                                    </td>

                                    <td>₹{{ $w->amount }}</td>

                                    <td>
                                        @if($w->paymentMethod->type === 'upi')
                                            <b>UPI:</b> {{ $w->paymentMethod->upi_id }}
                                        @else
                                            <b>Bank:</b> {{ $w->paymentMethod->bank_name }}<br>
                                            A/C: ****{{ substr($w->paymentMethod->account_number, -4) }}
                                        @endif
                                    </td>

                                    <td>
                                        @if($w->status === 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($w->status === 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span><br>
                                            <small>{{ $w->rejection_reason }}</small>
                                        @endif
                                    </td>

                                    <td>{{ $w->created_at->format('d M Y h:i A') }}</td>

                                    <td>
                                        @if($w->status === 'pending')
                                            <form method="POST"
                                                action="{{ route('admins.withdraw.approve', $w->id) }}"
                                                style="display:inline">
                                                @csrf
                                                <button class="btn btn-success btn-sm">
                                                    Approve
                                                </button>
                                            </form>

                                            <button class="btn btn-danger btn-sm"
                                                data-toggle="modal"
                                                data-target="#rejectModal{{ $w->id }}">
                                                Reject
                                            </button>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>

                                <!-- Reject Modal -->
                                <div class="modal fade" id="rejectModal{{ $w->id }}">
                                    <div class="modal-dialog">
                                        <form method="POST"
                                            action="{{ route('admins.withdraw.reject', $w->id) }}">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5>Reject Withdraw</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <textarea name="reason"
                                                        class="form-control"
                                                        placeholder="Rejection reason"
                                                        required></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger">Reject</button>
                                                    <button class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $withdraws->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
