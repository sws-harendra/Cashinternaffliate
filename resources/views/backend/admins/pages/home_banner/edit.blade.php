@extends('backend.admins.layouts.base')

@push('title')
<title>Edit Home Banner | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">

                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Home Banner</h5>
                        <p class="m-b-0">Update homepage banner details</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.home-banner.index') }}">Home Banners</a>
                        </li>
                        <li class="breadcrumb-item">Edit</li>
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
                        <h5>Edit Banner</h5>
                    </div>

                    <div class="card-block">
                        <form method="POST"
                              action="{{ route('admins.home-banner.update', $banner->id) }}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Title *</label>
                                <input type="text"
                                       name="title"
                                       value="{{ $banner->title }}"
                                       class="form-control"
                                       required>
                            </div>

                            <div class="form-group">
                                <label>Affiliate Product *</label>
                                <select name="affiliate_product_id" class="form-control" required>
                                    @foreach($products as $p)
                                        <option value="{{ $p->id }}"
                                            {{ $banner->affiliate_product_id == $p->id ? 'selected' : '' }}>
                                            {{ $p->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Current Banner</label><br>
                                <img src="{{ asset('uploads/home-banners/'.$banner->banner) }}"
                                     width="150" class="mb-2">
                                <input type="file" name="banner" class="form-control">
                            </div>

                            <button class="btn btn-primary">Update Banner</button>
                            <a href="{{ route('admins.home-banner.index') }}"
                               class="btn btn-secondary">Back</a>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
@endsection
