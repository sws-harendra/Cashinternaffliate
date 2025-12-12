@extends('backend.admins.layouts.base')

@push('title')
<title>Training Categories | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')

<div class="pcoded-content">

    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Training Categories</h5>
                        <p class="m-b-0">Manage all training categories</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admins.dashboard') }}"> <i class="fa fa-home"></i> </a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!">Training Categories</a></li>
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
                        <h5>Category List</h5>
                        <a href="{{ route('admins.training-category.create') }}" 
                           class="btn btn-primary btn-sm float-right">Add New</a>
                    </div>

                    <div class="card-block">

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th width="20%">Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($categories as $i => $cat)
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $cat->name }}</td>

                                        <td>
                                            <a href="{{ route('admins.training-category.edit', $cat->id) }}"
                                               class="btn btn-warning btn-sm">Edit</a>

                                            <a onclick="return confirm('Delete this category?')"
                                               href="{{ route('admins.training-category.delete', $cat->id) }}"
                                               class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        {{ $categories->links() }}

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
