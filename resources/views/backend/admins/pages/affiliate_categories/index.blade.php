@extends('backend.admins.layouts.base')

@push('title')
<title>Affiliate Categories | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Affiliate Categories</h5>
                        <p class="m-b-0">Manage all affiliate categories created by admin</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Affiliate</a></li>
                        <li class="breadcrumb-item"><a href="#!">Categories</a></li>
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

                    <!-- Success message -->
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h5>Category List</h5>
                            <div class="card-header-right">
                                <a href="{{ route('admins.affiliate-categories.create') }}" 
                                   class="btn btn-primary btn-sm">
                                    + Add Category
                                </a>
                            </div>
                        </div>

                        <div class="card-block">

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Banner</th>
                                            <th>Status</th>
                                            <th width="150px">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>

                                            <td>
                                                @if($category->banner)
                                                    <img src="{{ asset('uploads/affiliate-categories/'.$category->banner) }}" 
                                                         height="40" class="img-radius">
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if($category->status === 'active')
                                                    <span class="label label-success">Active</span>
                                                @else
                                                    <span class="label label-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>

                                                <a href="{{ route('admins.affiliate-categories.edit', $category->id) }}" 
                                                   class="btn btn-info btn-sm">
                                                    Edit
                                                </a>

                                                <a href="{{ route('admins.affiliate-categories.delete', $category->id) }}"
                                                   onclick="return confirm('Are you sure you want to delete this category?')"
                                                   class="btn btn-danger btn-sm">
                                                   Delete
                                                </a>

                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">
                                                    No Categories Found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>

                            <!-- Pagination links -->
                            <div>
                                {{ $categories->links() }}
                            </div>

                        </div>
                    </div>

                </div> <!-- page-body end -->

            </div>
        </div>
    </div>

</div>
@endsection
