@extends('backend.admins.layouts.base')

@push('title')
<title>Home Banners | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Home Banners</h5>
                        <p class="m-b-0">Manage homepage banners</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}"><i class="fa fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Home Banners</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h5>Banner List</h5>
                        <a href="{{ route('admins.home-banner.create') }}"
                           class="btn btn-primary btn-sm float-right">Add Banner</a>
                    </div>

                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Banner</th>
                                        <th>Title</th>
                                        <th>Product</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($banners as $i => $b)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>
                                            <img src="{{ asset('uploads/home-banners/'.$b->banner) }}" width="80">
                                        </td>
                                        <td>{{ $b->title }}</td>
                                        <td>{{ $b->product->title ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('admins.home-banner.edit', $b->id) }}"
                                               class="btn btn-warning btn-sm">Edit</a>
                                            <a href="{{ route('admins.home-banner.delete', $b->id) }}"
                                               onclick="return confirm('Delete banner?')"
                                               class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        {{ $banners->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
