<!DOCTYPE html>
<html lang="en">
<head>
    <title>Recruiter Forgot Password</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/pages/waves/css/waves.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/icon/icofont/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
</head>

<body themebg-pattern="theme1">

<section class="login-block">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <form class="md-float-material form-material"
                      method="POST"
                      action="{{ route('recruiters.password.email') }}">
                    @csrf

                    {{-- ALERTS --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="text-center">
                        <img src="{{ asset(config_value('company_logo')) }}" style="height: 60px">
                    </div>

                    <div class="auth-box card">
                        <div class="card-block">
                            <h4 class="text-center m-b-20">Forgot Password</h4>

                            <div class="form-group form-primary">
                                <input type="email" name="email" class="form-control" required>
                                <span class="form-bar"></span>
                                <label class="float-label">Registered Email</label>
                            </div>

                            <button class="btn btn-primary btn-block">
                                Send Reset Link
                            </button>

                            <hr>
                            <div class="text-center">
                                <a href="{{ route('recruiters.show.login') }}">
                                    Back to Login
                                </a>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<script src="{{ asset('backend/assets/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
