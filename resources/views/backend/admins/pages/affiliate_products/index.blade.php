@extends('backend.admins.layouts.base')

@push('title')
    <title>Affiliate Products | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
    <div class="pcoded-content">

        <!-- Page-header start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Affiliate Products</h5>
                            <p class="m-b-0">Manage all affiliate products</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admins.dashboard') }}"> <i class="fa fa-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Affiliate Products</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h5>Products List</h5>
                            <a href="{{ route('admins.affiliate-products.create') }}"
                                class="btn btn-primary btn-sm float-right">Add New</a>
                        </div>

                        <div class="card-block">

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Earnings</th>
                                            <th>Status</th>
                                            <th>Top Product</th>
                                            <th>Recommended</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($products as $key => $p)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>

                                                <td>
                                                    @if ($p->product_image)
                                                        <img src="{{ asset('uploads/affiliate-products/' . $p->product_image) }}"
                                                            width="50">
                                                    @else
                                                        No Image
                                                    @endif
                                                </td>

                                                <td>{{ $p->title }}</td>

                                                <td>{{ $p->category->name ?? '' }}</td>

                                                <td>₹{{ $p->earnings }}</td>

                                                <td>
                                                    <span
                                                        class="badge 
                                                {{ $p->status == 'active' ? 'badge-success' : 'badge-danger' }}">
                                                        {{ ucfirst($p->status) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    @if ($p->is_top_product)
                                                        <span class="badge badge-info">Yes</span>
                                                    @else
                                                        <span class="badge badge-secondary">No</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if ($p->is_recommended)
                                                        <span class="badge badge-info">Yes</span>
                                                    @else
                                                        <span class="badge badge-secondary">No</span>
                                                    @endif
                                                </td>

                                                <td >
                                                    <a href="{{ route('admins.affiliate-products.edit', $p->id) }}"
                                                        class="btn btn-warning btn-sm">Edit</a>

                                                    <a href="{{ route('admins.affiliate-products.details', $p->id) }}"
                                                        class="btn btn-info btn-sm">
                                                        Manage Details
                                                    </a>


                                                    <a onclick="return confirm('Delete this product?')"
                                                        href="{{ route('admins.affiliate-products.delete', $p->id) }}"
                                                        class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            {{ $products->links() }}

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
