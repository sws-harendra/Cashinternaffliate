@extends('backend.admins.layouts.base')

@push('title')
    <title>Settings | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
    <div class="pcoded-content">

        <!-- Page-header start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5 class="m-b-10">App Settings</h5>
                            <p class="m-b-0">Manage all configuration settings</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admins.dashboard') }}"> <i class="fa fa-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Settings</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">

                    <div class="page-body">
                        <div class="card">
                            <div class="card-header">
                                <h5>Manage Settings</h5>
                            </div>

                            <div class="card-block">

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <form method="POST" action="{{ route('admins.settings.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">

                                        <div class="col-md-6">
                                            <label>Playstore App Link</label>
                                            <input type="text" class="form-control" name="playstore_app_link"
                                                value="{{ $settings['playstore_app_link'] ?? '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Website Link</label>
                                            <input type="text" class="form-control" name="website_link"
                                                value="{{ $settings['website_link'] ?? '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Terms & Condition Link</label>
                                            <input type="text" class="form-control" name="terms_link"
                                                value="{{ $settings['terms_link'] ?? '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Privacy Policy Link</label>
                                            <input type="text" class="form-control" name="privacy_link"
                                                value="{{ $settings['privacy_link'] ?? '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Telegram Link</label>
                                            <input type="text" class="form-control" name="telegram_link"
                                                value="{{ $settings['telegram_link'] ?? '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Facebook Link</label>
                                            <input type="text" class="form-control" name="facebook_link"
                                                value="{{ $settings['facebook_link'] ?? '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Instagram Link</label>
                                            <input type="text" class="form-control" name="instagram_link"
                                                value="{{ $settings['instagram_link'] ?? '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>YouTube Link</label>
                                            <input type="text" class="form-control" name="youtube_link"
                                                value="{{ $settings['youtube_link'] ?? '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Support Email</label>
                                            <input type="email" class="form-control" name="support_email"
                                                value="{{ $settings['support_email'] ?? '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Referral Bonus (%)</label>
                                            <input type="number" class="form-control" name="referral_bonus"
                                                value="{{ $settings['referral_bonus'] ?? 0 }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Minimum Withdraw (₹)</label>
                                            <input type="number" class="form-control" name="min_withdraw"
                                                value="{{ $settings['min_withdraw'] ?? 0 }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Company Logo</label><br>
                                            <input type="file" name="company_logo" class="form-control">

                                            @if (!empty($settings['company_logo']))
                                                <img src="{{ asset($settings['company_logo']) }}" class="img-60 mt-2"
                                                    alt="Company Logo">
                                            @endif
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label>Referral Banner</label><br>
                                            <input type="file" name="refer_banner" class="form-control">

                                            @if (!empty($settings['refer_banner']))
                                                <img src="{{ asset($settings['refer_banner']) }}" class="img-60 mt-2"
                                                    alt="Referral Banner">
                                            @endif
                                        </div>


                                    </div>

                                    <button class="btn btn-primary mt-4">Save Settings</button>

                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
