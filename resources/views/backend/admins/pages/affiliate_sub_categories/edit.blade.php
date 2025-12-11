@extends('backend.admins.layouts.base')

@push('title')
<title>Edit Affiliate Subcategory | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
<div class="pcoded-content">
    <!-- Page-header start -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Affiliate Subcategory</h5>
                        <p class="m-b-0">Update subcategory details</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="breadcrumb-title">
                        <li class="breadcrumb-item"><a href="{{ route('admins.dashboard') }}"><i class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admins.affiliate-subcategories.index') }}">Subcategories</a></li>
                        <li class="breadcrumb-item">Edit</li>
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
                        <div class="card-header"><h5>Update Subcategory</h5></div>

                        <div class="card-block">

                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="m-0">
                                        @foreach($errors->all() as $err) <li>{{ $err }}</li> @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('admins.affiliate-subcategories.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-md-6">
                                        <label>Name *</label>
                                        <input type="text" name="name" class="form-control" value="{{ $subcategory->name }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Slug *</label>
                                        <input type="text" name="slug" class="form-control" value="{{ $subcategory->slug }}" required>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label>Category *</label>
                                        <select name="category_id" class="form-control" required>
                                            <option value="">-- Select Category --</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ $cat->id == $subcategory->category_id ? 'selected':'' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active" {{ $subcategory->status == 'active' ? 'selected': '' }}>Active</option>
                                            <option value="inactive" {{ $subcategory->status == 'inactive' ? 'selected': '' }}>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control" rows="3">{{ $subcategory->description }}</textarea>
                                    </div>

                                    <div class="col-md-6 mt-3">
                                        <label>Old Banner</label><br>
                                        @if($subcategory->banner)
                                            <img src="{{ asset('uploads/affiliate-subcategories/'.$subcategory->banner) }}" height="80" class="img-radius mb-2">
                                        @else
                                            <p class="text-muted">No Image</p>
                                        @endif
                                        <input type="file" name="banner" class="form-control mt-2">
                                    </div>

                                </div>

                                <button class="btn btn-primary mt-4">Update Subcategory</button>
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
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-');
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
