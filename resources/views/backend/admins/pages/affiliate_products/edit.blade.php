@extends('backend.admins.layouts.base')

@push('title')
    <title>Edit Affiliate Product | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
    <div class="pcoded-content">

        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">

                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Edit Affiliate Product</h5>
                            <p>Edit product details</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admins.dashboard') }}"> <i class="fa fa-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Edit Product</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">

                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Product</h5>
                        </div>

                        <div class="card-block">

                            <form method="POST" action="{{ route('admins.affiliate-products.update', $product->id) }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-md-6">
                                        <label>Title *</label>
                                        <input type="text" name="title" id="title" value="{{ $product->title }}"
                                            class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Slug *</label>
                                        <input type="text" name="slug" id="slug" value="{{ $product->slug }}"
                                            class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Affiliate Link *</label>
                                        <input type="text" name="affiliate_link" value="{{ $product->affiliate_link }}"
                                            class="form-control" required>
                                        <small class="text-muted">
                                            Example:
                                            https://example.com/c?o=12345&m=888&a=999&aff_click_id={CLICK_ID}&sub_aff_id={USER_ID}
                                            <br>
                                            <b>{CLICK_ID}</b> auto-generate hoga when user clicks the link.
                                            <br>
                                            <b>{USER_ID}</b> user ka ID/subid store karne ke liye hota hai.
                                        </small>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Subtitle</label>
                                        <input type="text" name="sub_title" value="{{ $product->sub_title }}"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Earnings (₹)</label>
                                        <input type="number" name="earnings" value="{{ $product->earnings }}"
                                            class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Category *</label>
                                        <select name="category_id" class="form-control" required>
                                            @foreach ($categories as $c)
                                                <option value="{{ $c->id }}"
                                                    {{ $product->category_id == $c->id ? 'selected' : '' }}>
                                                    {{ $c->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Subcategory</label>
                                        <select name="subcategory_id" id="subcategory" class="form-control">
                                            @foreach ($subcategories as $sc)
                                                <option value="{{ $sc->id }}"
                                                    {{ $product->subcategory_id == $sc->id ? 'selected' : '' }}>
                                                    {{ $sc->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-md-12">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Product Image</label>
                                        <input type="file" name="product_image" class="form-control">

                                        @if ($product->product_image)
                                            <img src="{{ asset('uploads/affiliate-products/' . $product->product_image) }}"
                                                width="80" class="mt-2">
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label>Banner</label>
                                        <input type="file" name="banner" class="form-control">

                                        @if ($product->banner)
                                            <img src="{{ asset('uploads/affiliate-products/' . $product->banner) }}"
                                                width="80" class="mt-2">
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="inactive"
                                                {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <br>
                                        <label>
                                            <input type="checkbox" name="is_top_product"
                                                {{ $product->is_top_product ? 'checked' : '' }}>
                                            Top Product?
                                        </label>

                                        <input type="text" name="top_product_title"
                                            value="{{ $product->top_product_title }}" class="form-control mt-1">
                                    </div>

                                    <div class="col-md-6">
                                        <br>
                                        <label>
                                            <input type="checkbox" name="is_recommended"
                                                {{ $product->is_recommended ? 'checked' : '' }}>
                                            Recommended?
                                        </label>
                                    </div>

                                </div>

                                <button class="btn btn-primary mt-3">Update Product</button>

                            </form>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>

    <script>
        document.getElementById("title").addEventListener("keyup", function() {
            let slug = this.value.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
            document.getElementById("slug").value = slug;
        });
    </script>
    <script>
        document.querySelector("select[name='category_id']").addEventListener("change", function() {

            let categoryId = this.value;

            fetch(`/admins/get-subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    let subcat = document.getElementById("subcategory");
                    subcat.innerHTML = `<option value="">Select Subcategory</option>`;

                    data.forEach(item => {
                        subcat.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                    });
                });
        });
    </script>
@endsection
