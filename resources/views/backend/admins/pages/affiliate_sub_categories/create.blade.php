@extends('backend.admins.layouts.base')

@push('title')
<title>Add Affiliate Subcategory | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Add Affiliate Subcategory</h5>
                        <p class="m-b-0">Create a new affiliate subcategory</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admins.affiliate-subcategories.index') }}">Subcategories</a></li>
                        <li class="breadcrumb-item">Add</li>
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

                    <div class="card">
                        <div class="card-header"><h5>Create New Subcategory</h5></div>

                        <div class="card-block">

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="m-0">
                                        @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admins.affiliate-subcategories.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-md-6">
                                        <label>Name *</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Slug *</label>
                                        <input type="text" name="slug" class="form-control" required>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label>Category *</label>
                                        <select name="category_id" class="form-control" required>
                                            <option value="">-- Select Category --</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active" selected>Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label>Banner</label>
                                        <input type="file" name="banner" class="form-control">
                                    </div>

                                </div>

                                <button class="btn btn-primary mt-4">Save Subcategory</button>
                            </form>

                        </div>
                    </div>

                </div> {{-- page-body end --}}
            </div>
        </div>
    </div>
</div>


<script>
    function slugify(text) {
        return text.toString().toLowerCase().trim()
            .replace(/\s+/g, '-')           // spaces to dash
            .replace(/[^\w\-]+/g, '')       // remove invalid chars
            .replace(/\-\-+/g, '-');        // collapse dashes
    }

    document.addEventListener('DOMContentLoaded', function(){
        const nameInput = document.querySelector("input[name='name']");
        const slugInput = document.querySelector("input[name='slug']");
        if(nameInput && slugInput){
            nameInput.addEventListener('keyup', function(){
                slugInput.value = slugify(this.value);
            });
        }
    });
</script>


@endsection
