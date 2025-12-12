@extends('backend.admins.layouts.base')

@push('title')
<title>Affiliate Clicks | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')

<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Affiliate Clicks</h5>
                        <p class="m-b-0">View & manage all leads</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Affiliate Clicks</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="card">
                    <div class="card-header">
                        <h5>Click Logs</h5>
                    </div>

                    <div class="card-block">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Lead ID</th>
                                        <th>Product</th>
                                        <th>User</th>
                                        <th>Click ID</th>
                                        <th>Completion</th>
                                        <th>Status</th>
                                        <th>Expiry</th>
                                        <th>Clicked At</th>
                                        <th>Convert</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($clicks as $i => $click)
                                        @php
                                            $isExpired = $click->isExpired();
                                            $expiryDate = $click->expiryDate();
                                        @endphp

                                        <tr>
                                            <td>{{ $i + 1 }}</td>

                                            <td>{{ $click->lead_id }}</td>

                                            <td>{{ $click->product->title ?? 'N/A' }}</td>

                                            <td>{{ $click->user->name ?? 'Guest' }}</td>

                                            <td>{{ $click->click_id }}</td>

                                            <td>
                                                @if ($isExpired)
                                                    <span class="badge badge-danger">Expired</span>
                                                @elseif ($click->is_converted)
                                                    <span class="badge badge-success">Completed</span>
                                                @else
                                                    <span class="badge badge-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($click->status == 0)
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($click->status == 1)
                                                    <span class="badge badge-success">Progress</span>
                                                @elseif($click->status == 2)
                                                    <span class="badge badge-danger">Rejected</span>
                                                @elseif($click->status == 3)
                                                    <span class="badge badge-info">Completed</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($expiryDate)
                                                    {{ $expiryDate->format('d M Y h:i A') }}
                                                @else
                                                    —
                                                @endif
                                            </td>

                                            <td>{{ $click->clicked_at }}</td>

                                            <td>
                                                @if ($isExpired)
                                                    <button class="btn btn-secondary btn-sm" disabled>Expired</button>
                                                @else
                                                    <a href="{{ route('admins.affiliate.clicks.convert', $click->id) }}"
                                                       class="btn btn-primary btn-sm">
                                                        Convert
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        {{ $clicks->links() }}

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
