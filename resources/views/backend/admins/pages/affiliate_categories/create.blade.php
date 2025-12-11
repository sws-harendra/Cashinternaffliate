@extends('backend.admins.layouts.base')

@push('title')
<title>Add Affiliate Category | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Affiliate Category</h5>
                        <p class="m-b-0">Create a new affiliate category for campaigns</p>
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
                        <li class="breadcrumb-item">
                            <a href="#!">Add Category</a>
                        </li>
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
                            <h5>Create New Category</h5>
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

                            <form action="{{ route('admins.affiliate-categories.store') }}" 
                                  method="POST" 
                                  enctype="multipart/form-data">

                                @csrf

                                <div class="row">

                                    <div class="col-md-6">
                                        <label>Name *</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Slug *</label>
                                        <input type="text" name="slug" class="form-control" required>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label>Banner</label>
                                        <input type="file" name="banner" class="form-control">
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                </div>

                                <button class="btn btn-primary mt-4">Save Category</button>

                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<script>
    function slugify(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')        // replace spaces with -
            .replace(/[^\w\-]+/g, '')    // remove invalid chars
            .replace(/\-\-+/g, '-');     // collapse dashes
    }

    document.addEventListener('DOMContentLoaded', function () {
        const nameInput = document.querySelector("input[name='name']");
        const slugInput = document.querySelector("input[name='slug']");

        if (nameInput && slugInput) {
            nameInput.addEventListener("keyup", function () {
                slugInput.value = slugify(this.value);
            });
        }
    });
</script>

@endsection
