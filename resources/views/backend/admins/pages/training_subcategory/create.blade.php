@extends('backend.admins.layouts.base')

@push('title')
    <title>Add Training Sub Category | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
    <div class="pcoded-content">

        <!-- Page-header -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">

                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5>Add Sub Category</h5>
                            <p class="m-b-0">Create a new training subcategory</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admins.training-subcategory.index') }}">Subcategories</a></li>
                            <li class="breadcrumb-item"><a href="#!">Create</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h5>Create Sub Category</h5>
                        </div>

                        <div class="card-block">

                            <form action="{{ route('admins.training-subcategory.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Select Category *</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Name *</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" name="banner" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                                <button class="btn btn-primary">Save</button>
                                <a href="{{ route('admins.training-subcategory.index') }}"
                                    class="btn btn-secondary">Back</a>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
