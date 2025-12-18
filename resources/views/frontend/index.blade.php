<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} - Home</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .hero-section {
            padding: 90px 0;
            background: linear-gradient(to right, #4e73df, #1cc88a);
            color: #fff;
        }

        .category-card {
            border-radius: 12px;
            transition: 0.3s;
        }

        .category-card:hover {
            background: #f1f3f4;
            transform: translateY(-5px);
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Job Portal</a>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('recruiters.show.login') }}" class="nav-link">Recruiter Login</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('recruiters.show.register') }}" class="nav-link">Recruiter Register</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="fw-bold">Find Your Dream Job Today</h1>
            <p class="lead mt-3">Search from thousands of verified job postings across India</p>

            <a href="#" class="btn btn-light btn-lg mt-4">Browse Jobs</a>
        </div>
    </section>

    <!-- POPULAR CATEGORIES -->
    <section class="py-5">
        <div class="container">
            <h3 class="mb-4">Popular Job Categories</h3>

            <div class="row">

                <div class="col-md-3 mb-3">
                    <div class="p-4 bg-white shadow-sm category-card">
                        <h5>IT & Software</h5>
                        <p class="text-muted small mb-0">1200+ Jobs</p>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="p-4 bg-white shadow-sm category-card">
                        <h5>Sales & Marketing</h5>
                        <p class="text-muted small mb-0">850+ Jobs</p>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="p-4 bg-white shadow-sm category-card">
                        <h5>BPO / Customer Support</h5>
                        <p class="text-muted small mb-0">430+ Jobs</p>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="p-4 bg-white shadow-sm category-card">
                        <h5>Delivery / Field Jobs</h5>
                        <p class="text-muted small mb-0">1500+ Jobs</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-dark text-white py-3 text-center">
        <small>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All Rights Reserved.</small>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
