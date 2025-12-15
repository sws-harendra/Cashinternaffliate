<!DOCTYPE html>
<html lang="en">
<head>
    <title>Recruiter Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('backend/assets/images/favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/pages/waves/css/waves.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/icon/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/icon/icofont/css/icofont.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/icon/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
</head>

<body themebg-pattern="theme1">

<section class="login-block">
<div class="container">
<div class="row">
<div class="col-sm-12">

<form class="md-float-material form-material" method="POST"
      action="{{ route('recruiters.register') }}">
@csrf


<div class="text-center">
    <img src="{{ asset('backend/assets/images/logo.png') }}">
</div>

{{-- FLASH MESSAGES --}}
@if(session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger mt-3">
        <ul class="mb-0">
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="auth-box card">
<div class="card-block">

<h3 class="text-center mb-4">Recruiter Registration</h3>

<div class="form-group form-primary">
    <select name="recruiter_type" class="form-control" required>
        <option value="">Select Recruiter Type</option>
        <option value="individual">Individual</option>
        <option value="company">Company</option>
    </select>
    <span class="form-bar"></span>
</div>

<div class="form-group form-primary">
    <input type="text" name="name" class="form-control" required>
    <span class="form-bar"></span>
    <label class="float-label">Recruiter / HR Name</label>
</div>

<div class="form-group form-primary">
    <input type="text" name="company_name" class="form-control">
    <span class="form-bar"></span>
    <label class="float-label">Company Name (Optional)</label>
</div>

<div class="form-group form-primary">
    <input type="email" name="email" class="form-control" required>
    <span class="form-bar"></span>
    <label class="float-label">Email Address</label>
</div>

<div class="form-group form-primary">
    <input type="text" name="mobile" class="form-control" required>
    <span class="form-bar"></span>
    <label class="float-label">Mobile Number</label>
</div>

<div class="form-group form-primary">
    <input type="password" name="password" class="form-control" required>
    <span class="form-bar"></span>
    <label class="float-label">Password</label>
</div>

<div class="form-group form-primary">
    <input type="password" name="password_confirmation" class="form-control" required>
    <span class="form-bar"></span>
    <label class="float-label">Confirm Password</label>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <button type="submit"
            class="btn btn-primary btn-md btn-block waves-effect waves-light">
            Register
        </button>
    </div>
</div>

<hr>
<p class="text-center">
    Already registered?
    <a href="{{ route('recruiters.login.submit') }}">Login</a>
</p>

</div>
</div>
</form>

</div>
</div>
</div>
</section>

<script src="{{ asset('backend/assets/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/assets/pages/waves/js/waves.min.js') }}"></script>
</body>
</html>
