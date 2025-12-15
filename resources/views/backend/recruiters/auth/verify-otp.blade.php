<!DOCTYPE html>
<html lang="en">

<head>
    <title>Verify OTP</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('backend/assets/images/favicon.ico') }}" type="image/x-icon">

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">

    <!-- Required Framework -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/bootstrap/css/bootstrap.min.css') }}">

    <!-- waves.css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/pages/waves/css/waves.min.css') }}" type="text/css">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/icon/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/icon/icofont/css/icofont.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/assets/icon/font-awesome/css/font-awesome.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style.css') }}">
</head>

<body themebg-pattern="theme1">

<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <!-- OTP Form -->
                <form class="md-float-material form-material"
                      method="POST"
                      action="{{ route('recruiters.otp.verify') }}">
                    @csrf

                    {{-- FLASH MESSAGES --}}
                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="text-center">
                        <img src="{{ asset('backend/assets/images/logo.png') }}" alt="logo">
                    </div>

                    <div class="auth-box card">
                        <div class="card-block">

                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center">Verify OTP</h3>
                                    <p class="text-center text-muted mb-0">
                                        Enter OTP sent to your Email & Mobile
                                    </p>
                                </div>
                            </div>

                            {{-- EMAIL OTP --}}
                            <div class="form-group form-primary">
                                <input type="text"
                                       name="email_otp"
                                       class="form-control"
                                       maxlength="6"
                                       required>
                                <span class="form-bar"></span>
                                <label class="float-label">Email OTP</label>
                            </div>

                            {{-- MOBILE OTP --}}
                            <div class="form-group form-primary">
                                <input type="text"
                                       name="mobile_otp"
                                       class="form-control"
                                       maxlength="6"
                                       required>
                                <span class="form-bar"></span>
                                <label class="float-label">Mobile OTP</label>
                            </div>

                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit"
                                            class="btn btn-primary btn-md btn-block waves-effect waves-light">
                                        Verify OTP
                                    </button>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <p class="text-inverse mb-0">
                                        Didn’t receive OTP?
                                    </p>
                                    <a href="{{ route('recruiters.otp.resend') }}">
                                        <b>Resend OTP</b>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
                <!-- End form -->

            </div>
        </div>
    </div>
</section>

<!-- Scripts -->
<script src="{{ asset('backend/assets/js/jquery/jquery.min.js') }}"></cript>
<script src="{{ asset('backend/assets/js/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/popper.js/popper.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/assets/pages/waves/js/waves.min.js') }}"></script>

</body>
</html>
