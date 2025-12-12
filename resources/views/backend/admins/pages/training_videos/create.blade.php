@extends('backend.admins.layouts.base')

@push('title')
<title>Add Training Video | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')

<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">

                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Training Video</h5>
                        <p class="m-b-0">Add a new training video inside a subcategory</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.training-videos.index') }}">Training Videos</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Add</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5>Add New Video</h5>
                    </div>

                    <div class="card-block">

                        <form method="POST" action="{{ route('admins.training-videos.store') }}">
                            @csrf

                            <div class="form-group">
                                <label>Sub Category *</label>
                                <select name="sub_category_id" class="form-control" required>
                                    <option value="">Select Sub Category</option>
                                    @foreach($subcategories as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Video Title *</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Video URL *</label>
                                <input type="text" name="video_url" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Duration (seconds)</label>
                                <input type="number" name="duration" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Status *</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            <button class="btn btn-primary">Save Video</button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
