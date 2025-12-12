@extends('backend.admins.layouts.base')

@push('title')
    <title>Earning Levels | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
    <div class="pcoded-content">

        <!-- Page-header start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Earning Levels — {{ $product->title }}</h5>
                            <p class="m-b-0">Manage earning levels for this product</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admins.dashboard') }}"> <i class="fa fa-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admins.affiliate-products.index') }}">Products</a></li>
                            <li class="breadcrumb-item"><a href="#!">Earning Levels</a></li>
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

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h5>Add New Level</h5>
                        </div>

                        <div class="card-block">

                            <form method="POST" action="{{ route('admins.earning-levels.store', $product->id) }}">
                                @csrf

                                <div class="row">

                                    <div class="col-md-4">
                                        <label>Level Name</label>
                                        <input type="text" name="level_name" class="form-control" required>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Level Description</label>
                                        <input type="text" name="level_description" class="form-control" required>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Level Order *</label>
                                        <input type="number" name="level_order" class="form-control"
                                            value="{{ $nextOrder ?? 1 }}" min="1" required>
                                    </div>


                                    <div class="col-md-3">
                                        <label>Amount (₹)</label>
                                        <input type="number" step="0.01" name="amount" class="form-control" required>
                                    </div>


                                    <div class="col-md-1">
                                        <label>&nbsp;</label>
                                        <button class="btn btn-primary btn-block">Add</button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>

                    <!-- Levels List -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h5>Existing Levels</h5>
                        </div>

                        <div class="card-block table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Level Name</th>
                                        <th>Level Order</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($levels as $level)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $level->level_name }}</td>
                                            <td>{{ $level->level_order }}</td>
                                            <td>{{ $level->level_description }}</td>
                                            <td>₹{{ $level->amount }}</td>

                                            <td>
                                                <a href="{{ route('admins.earning-levels.edit', $level->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>

                                                <form action="{{ route('admins.earning-levels.delete', $level->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Delete this level?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
