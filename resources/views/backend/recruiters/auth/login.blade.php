<!DOCTYPE html>
<html lang="en">

<head>
    <title>Recruiter Login</title>

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

                    <!-- Login Form -->
                    <form class="md-float-material form-material" method="POST"
                        action="{{ route('recruiters.login.submit') }}">
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
                            <img src="{{ asset(config_value('company_logo')) }}" style="height:60px">
                        </div>

                        <div class="auth-box card">
                            <div class="card-block">

                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Recruiter Login</h3>
                                    </div>
                                </div>

                                {{-- EMAIL --}}
                                <div class="form-group form-primary">
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control" required>
                                    <span class="form-bar"></span>
                                    <label class="float-label">Email Address</label>
                                </div>

                                {{-- PASSWORD --}}
                                <div class="form-group form-primary">
                                    <input type="password" name="password" class="form-control" required>
                                    <span class="form-bar"></span>
                                    <label class="float-label">Password</label>
                                </div>

                                <div class="row m-t-25 text-left">
                                    <div class="col-12">
                                        {{-- future: remember me / forgot password --}}
                                    </div>
                                </div>

                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit"
                                            class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">
                                            Login
                                        </button>
                                    </div>
                                </div>
                                <div class="row m-t-2 text-right">
                                    <div class="col-12">
                                        <a href="{{ route('recruiters.password.request') }}" class="text-primary">
                                            Forgot Password?
                                        </a>
                                    </div>
                                </div>


                                <hr />

                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <p class="text-inverse">
                                            New Recruiter?
                                            <a href="{{ route('recruiters.register') }}">
                                                <b>Create Account</b>
                                            </a>
                                        </p>
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
    <script src="{{ asset('backend/assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/popper.js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('backend/assets/pages/waves/js/waves.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('backend/assets/js/modernizr/modernizr.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>

</body>

</html>
