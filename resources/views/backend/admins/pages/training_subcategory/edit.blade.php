@extends('backend.admins.layouts.base')

@push('title')
    <title>Edit Training Sub Category | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
    <div class="pcoded-content">

        <!-- Page-header -->
        <div class="page-header">
            <div class="page-block">

                <div class="row align-items-center">

                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5>Edit Sub Category</h5>
                            <p class="m-b-0">Update training subcategory</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"><i
                                        class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admins.training-subcategory.index') }}">Subcategories</a></li>
                            <li class="breadcrumb-item"><a href="#!">Edit</a></li>
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
                            <h5>Update Sub Category</h5>
                        </div>

                        <div class="card-block">

                            <form action="{{ route('admins.training-subcategory.update', $subcategory->id) }}"
                                method="POST" enctype="multipart/form-data">

                                @csrf

                                <div class="form-group">
                                    <label>Select Category *</label>
                                    <select name="category_id" class="form-control" required>
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->id }}"
                                                {{ $subcategory->category_id == $c->id ? 'selected' : '' }}>
                                                {{ $c->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Name *</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $subcategory->name }}" required>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control">{{ $subcategory->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" name="banner" class="form-control">

                                    @if ($subcategory->banner)
                                        <img src="{{ asset('uploads/training-subcategory/' . $subcategory->banner) }}"
                                            width="80" class="mt-2">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" {{ $subcategory->status ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ !$subcategory->status ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>
                                </div>

                                <button class="btn btn-primary">Update</button>

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
