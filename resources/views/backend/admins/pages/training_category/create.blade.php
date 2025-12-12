@extends('backend.admins.layouts.base')

@push('title')
<title>Add Training Category | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')

<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Category</h5>
                        <p class="m-b-0">Create new training category</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admins.training-category.index') }}">Training Categories</a></li>
                        <li class="breadcrumb-item"><a href="#!">Create</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

             @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
            

                <div class="card">
                    <div class="card-header">
                        <h5>Create Category</h5>
                    </div>

                    <div class="card-block">

                        <form method="POST" action="{{ route('admins.training-category.store') }}">
                            @csrf

                            <div class="form-group">
                                <label>Name *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <button class="btn btn-primary">Save</button>

                            <a href="{{ route('admins.training-category.index') }}"
                               class="btn btn-secondary">Back</a>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
