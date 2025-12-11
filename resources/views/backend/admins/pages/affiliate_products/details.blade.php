@extends('backend.admins.layouts.base')

@push('title')
    <title>Product Details | {{ $product->title }}</title>
@endpush

@section('page-content')
    <div class="pcoded-content">

        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5>Manage Product Details</h5>
                            <p class="m-b-0">{{ $product->title }}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item">Product Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="pcoded-inner-content">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('admins.affiliate-products.details.update', $product->id) }}">
                @csrf

                <!-- ================= BENEFITS ================= -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Benefits</h5>
                        <button type="button" class="btn btn-success btn-sm float-right" id="addBenefit">+ Add</button>
                    </div>

                    <div class="card-block" id="benefitsSection">

                        @foreach ($product->benefits as $b)
                            <div class="row mb-2 benefit-row">
                                <div class="col-md-10">
                                    <input type="text" name="benefits[]" class="form-control"
                                        value="{{ $b->benefit_title }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- ================= HOW IT WORKS ================= -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>How It Works</h5>
                        <button type="button" class="btn btn-success btn-sm float-right" id="addStep">+ Add</button>
                    </div>

                    <div class="card-block" id="stepsSection">

                        @foreach ($product->howItWorks as $step)
                            <div class="row mb-2 step-row">
                                <div class="col-md-10">
                                    <input type="text" name="steps[]" class="form-control"
                                        value="{{ $step->step_title }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- ================= WHOM TO SELL ================= -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Whom to Sell</h5>
                        <button type="button" class="btn btn-success btn-sm float-right" id="addAudience">+ Add</button>
                    </div>

                    <div class="card-block" id="audienceSection">

                        @foreach ($product->whomToSell as $aud)
                            <div class="row mb-2 audience-row">
                                <div class="col-md-10">
                                    <input type="text" name="audience[]" class="form-control"
                                        value="{{ $aud->target_audience }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- ================= TERMS ================= -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Terms & Conditions</h5>
                        <button type="button" class="btn btn-success btn-sm float-right" id="addTerm">+ Add</button>
                    </div>

                    <div class="card-block" id="termsSection">

                        @foreach ($product->termsCondition as $term)
                            <div class="row mb-2 term-row">
                                <div class="col-md-10">
                                    <input type="text" name="terms_points[]" class="form-control"
                                        value="{{ $term->terms }}" placeholder="Enter term">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- ================= TRAINING VIDEOS ================= -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>Training Videos</h5>
                        <button type="button" class="btn btn-success btn-sm float-right" id="addVideo">+ Add</button>
                    </div>

                    <div class="card-block" id="videoSection">

                        @foreach ($product->trainingVideos as $video)
                            <div class="row mb-3 video-row">
                                <div class="col-md-5">
                                    <input type="text" name="video_title[]" class="form-control"
                                        placeholder="Video Title" value="{{ $video->video_title }}">
                                </div>

                                <div class="col-md-5">
                                    <input type="text" name="video_url[]" class="form-control" placeholder="Video URL"
                                        value="{{ $video->video_url }}">
                                </div>

                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>



                <!-- ================= FAQ ================= -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5>FAQs</h5>
                        <button type="button" class="btn btn-success btn-sm float-right" id="addFaq">+ Add
                            FAQ</button>
                    </div>

                    <div class="card-block" id="faqSection">

                        @foreach ($product->faqs as $faq)
                            <div class="row mb-2 faq-row">
                                <div class="col-md-5">
                                    <input type="text" name="faq_question[]" class="form-control"
                                        placeholder="Question" value="{{ $faq->question }}">
                                </div>
                                <div class="col-md-5">
                                    <input type="text" name="faq_answer[]" class="form-control" placeholder="Answer"
                                        value="{{ $faq->answer }}">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <button class="btn btn-primary mt-4">Save All Details</button>
            </form>

        </div>
    </div>

    <!-- ================= JS FOR ADD / REMOVE FUNCTIONALITY ================= -->
    <script>
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("remove-row")) {
                e.target.closest(".row").remove();
            }
        });

        // Add Benefit
        document.getElementById("addBenefit").onclick = function() {
            document.getElementById("benefitsSection").insertAdjacentHTML('beforeend', `
        <div class="row mb-2 benefit-row">
            <div class="col-md-10">
                <input type="text" name="benefits[]" class="form-control" placeholder="Enter benefit">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
            </div>
        </div>
    `);
        };

        // Add Step
        document.getElementById("addStep").onclick = function() {
            document.getElementById("stepsSection").insertAdjacentHTML('beforeend', `
        <div class="row mb-2 step-row">
            <div class="col-md-10">
                <input type="text" name="steps[]" class="form-control" placeholder="Step title">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
            </div>
        </div>
    `);
        };

        // Add Audience
        document.getElementById("addAudience").onclick = function() {
            document.getElementById("audienceSection").insertAdjacentHTML('beforeend', `
        <div class="row mb-2 audience-row">
            <div class="col-md-10">
                <input type="text" name="audience[]" class="form-control" placeholder="Target audience">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
            </div>
        </div>
    `);
        };



        // Add Term
        document.getElementById("addTerm").onclick = function() {
            document.getElementById("termsSection").insertAdjacentHTML('beforeend', `
        <div class="row mb-2 term-row">
            <div class="col-md-10">
                <input type="text" name="terms_points[]" class="form-control" placeholder="Enter term">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
            </div>
        </div>
    `);
        };


        // Add Video
        document.getElementById("addVideo").onclick = function() {
            document.getElementById("videoSection").insertAdjacentHTML('beforeend', `
        <div class="row mb-3 video-row">
            <div class="col-md-5">
                <input type="text" name="video_title[]" class="form-control" placeholder="Video Title">
            </div>

            <div class="col-md-5">
                <input type="text" name="video_url[]" class="form-control" placeholder="Video URL">
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
            </div>
        </div>
    `);
        };



        // Add FAQ
        document.getElementById("addFaq").onclick = function() {
            document.getElementById("faqSection").insertAdjacentHTML('beforeend', `
        <div class="row mb-2 faq-row">
            <div class="col-md-5">
                <input type="text" name="faq_question[]" class="form-control" placeholder="Question">
            </div>
            <div class="col-md-5">
                <input type="text" name="faq_answer[]" class="form-control" placeholder="Answer">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
            </div>
        </div>
    `);
        };
    </script>
@endsection
