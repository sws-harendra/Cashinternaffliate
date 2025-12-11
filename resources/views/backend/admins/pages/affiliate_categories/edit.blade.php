@extends('backend.admins.layouts.base')

@push('title')
<title>Edit Affiliate Category | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">

                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Affiliate Category</h5>
                        <p class="m-b-0">Update details for this affiliate category</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.affiliate-categories.index') }}">Affiliate Categories</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Edit Category</a></li>
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
                            <h5>Update Category</h5>
                        </div>

                        <div class="card-block">

                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="m-0">
                                        @foreach($errors->all() as $err)
                                            <li>{{ $err }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            <form action="{{ route('admins.affiliate-categories.update', $category->id) }}"
                                  method="POST"
                                  enctype="multipart/form-data">

                                @csrf

                                <div class="row">

                                    <div class="col-md-6">
                                        <label>Name *</label>
                                        <input type="text"
                                               name="name"
                                               value="{{ $category->name }}"
                                               class="form-control"
                                               required>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Slug *</label>
                                        <input type="text"
                                               name="slug"
                                               value="{{ $category->slug }}"
                                               class="form-control"
                                               required disabled>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label>Description</label>
                                        <textarea name="description"
                                                  class="form-control"
                                                  rows="3">{{ $category->description }}</textarea>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label>Old Banner</label><br>

                                        @if($category->banner)
                                            <img src="{{ asset('uploads/affiliate-categories/'.$category->banner) }}"
                                                 height="70"
                                                 class="img-radius mb-2">
                                        @else
                                            <p class="text-muted">No Image Uploaded</p>
                                        @endif

                                        <input type="file" name="banner" class="form-control mt-2">
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active"
                                                {{ $category->status == 'active' ? 'selected' : '' }}>
                                                Active
                                            </option>

                                            <option value="inactive"
                                                {{ $category->status == 'inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>

                                </div>

                                <button class="btn btn-primary mt-4">Update Category</button>

                            </form>

                        </div>
                    </div>

                </div> <!-- page-body end -->

            </div>
        </div>
    </div>


</div>
@endsection
