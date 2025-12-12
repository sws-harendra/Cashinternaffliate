@extends('backend.admins.layouts.base')

@push('title')
<title>Lead Conversion | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Lead Conversion Panel</h5>
                        <p class="m-b-0">Manage and approve earning levels</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.affiliate.clicks') }}">Affiliate Clicks</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Convert</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if($isExpired)
                    <div class="alert alert-danger">
                        <strong>Expired!</strong> This lead expired on:
                        <b>{{ $click->expiryDate()->format('d M, Y h:i A') }}</b>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5>{{ $click->product->title }}</h5>
                        <p class="text-muted m-b-0">
                            Lead ID: {{ $click->lead_id }} <br>
                            Expiry Date:
                            <b>{{ $click->expiryDate()->format('d M, Y h:i A') }}</b>
                        </p>
                    </div>

                    <div class="card-block">

                        <h5 class="m-b-20">Complete Levels</h5>

                        @foreach($levels as $level)
                            <div class="card p-3 mb-3 shadow-sm"
                                 style="border-left:4px solid #3f51b5; background:#fafafa">

                                <strong>{{ $level->level_order }}. {{ $level->level_name }}</strong><br>
                                <small>{{ $level->level_description }}</small><br>
                                <b>₹{{ $level->amount }}</b>

                                @if(in_array($level->id, $completed))
                                    <span class="badge badge-success float-right mt-2">Completed</span>
                                @else

                                    @if($isExpired)
                                        <span class="badge badge-danger float-right mt-2">Expired</span>
                                    @else
                                        <form method="POST"
                                              action="{{ route('admins.affiliate.clicks.level.complete', $click->id) }}">
                                            @csrf
                                            <input type="hidden" name="level_id" value="{{ $level->id }}">
                                            <button class="btn btn-primary btn-sm float-right mt-2">
                                                Mark Complete
                                            </button>
                                        </form>
                                    @endif

                                @endif
                            </div>
                        @endforeach

                        <hr class="mt-4 mb-4">

                        @if(!$isExpired)
                            <form method="POST"
                                  action="{{ route('admins.affiliate.clicks.final.approve', $click->id) }}">
                                @csrf
                                <button class="btn btn-success btn-lg btn-block">
                                    Final Approve & Release Earnings
                                </button>
                            </form>
                        @else
                            <div class="alert alert-danger text-center">
                                Cannot approve expired lead.
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
