@extends('backend.admins.layouts.base')

@push('title')
    <title>Edit Earning Level | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
    <div class="pcoded-content">

        <!-- Page-header start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Edit Earning Level</h5>
                            <p class="m-b-0">Modify earning level details</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admins.dashboard') }}"> <i class="fa fa-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admins.earning-levels.index', $level->affiliate_product_id) }}">Earning
                                    Levels</a></li>
                            <li class="breadcrumb-item"><a href="#!">Edit</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">

                    <div class="card">
                        <div class="card-header">
                            <h5>Update Level</h5>
                        </div>

                        <div class="card-block">

                            <form method="POST" action="{{ route('admins.earning-levels.update', $level->id) }}">
                                @csrf

                                <div class="form-group">
                                    <label>Level Name</label>
                                    <input type="text" name="level_name" value="{{ $level->level_name }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Level Description</label>
                                    <input type="text" name="level_description" value="{{ $level->level_description }}"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Level Order *</label>
                                    <input type="number" name="level_order" class="form-control"
                                        value="{{ $level->level_order }}" min="1" required>
                                    <small class="text-muted">Example: 1 = first step, 2 = second step...</small>
                                </div>

                                <div class="form-group">
                                    <label>Amount (₹)</label>
                                    <input type="number" step="0.01" name="amount" value="{{ $level->amount }}"
                                        class="form-control" required>
                                </div>

                                <button class="btn btn-primary">Update</button>

                                <a href="{{ route('admins.earning-levels.index', $level->affiliate_product_id) }}"
                                    class="btn btn-secondary">Back</a>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection
