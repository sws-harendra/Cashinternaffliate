@extends('backend.admins.layouts.base')

@push('title')
<title>Affiliate Subcategories | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Affiliate Subcategories</h5>
                        <p class="m-b-0">Manage sub-categories for affiliate categories</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item">Affiliate</li>
                        <li class="breadcrumb-item">Subcategories</li>
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

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h5>Subcategory List</h5>
                            <div class="card-header-right">
                                <a href="{{ route('admins.affiliate-subcategories.create') }}" class="btn btn-primary btn-sm">+ Add Subcategory</a>
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
                                            <th>Category</th>
                                            <th>Banner</th>
                                            <th>Status</th>
                                            <th width="160px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($subcategories as $sub)
                                            <tr>
                                                <td>{{ $sub->id }}</td>
                                                <td>{{ $sub->name }}</td>
                                                <td>{{ $sub->slug }}</td>
                                                <td>{{ optional($sub->category)->name }}</td>
                                                <td>
                                                    @if($sub->banner)
                                                        <img src="{{ asset('uploads/affiliate-subcategories/'.$sub->banner) }}" height="40" class="img-radius">
                                                    @else
                                                        <span class="text-muted">No Image</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($sub->status === 'active')
                                                        <span class="label label-success">Active</span>
                                                    @else
                                                        <span class="label label-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admins.affiliate-subcategories.edit', $sub->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                                    <a href="{{ route('admins.affiliate-subcategories.delete', $sub->id) }}"
                                                       onclick="return confirm('Delete this subcategory?')"
                                                       class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">No subcategories found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $subcategories->links() }}
                            </div>

                        </div>
                    </div>

                </div> {{-- page-body end --}}
            </div>
        </div>
    </div>
</div>
@endsection
