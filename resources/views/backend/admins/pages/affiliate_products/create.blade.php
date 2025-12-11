@extends('backend.admins.layouts.base')

@push('title')
    <title>Add Affiliate Product | {{ env('APP_NAME') }}</title>
@endpush

@section('page-content')
    <div class="pcoded-content">

        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">

                    <div class="col-md-8">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Add Affiliate Product</h5>
                            <p>Add a new affiliate product</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admins.dashboard') }}"> <i class="fa fa-home"></i> </a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Add Product</a></li>
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
                            <h5>Create Product</h5>
                        </div>

                        <div class="card-block">

                            <form method="POST" action="{{ route('admins.affiliate-products.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <div class="col-md-6">
                                        <label>Title *</label>
                                        <input type="text" name="title" id="title" class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Slug *</label>
                                        <input type="text" name="slug" id="slug" class="form-control" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Affiliate Link *</label>
                                        <input type="text" name="affiliate_link" class="form-control"
                                            placeholder="https://dsplmedia10839873.o18a.com/c?o=21858040&m=27741&a=723943&aff_click_id={replace_it}&sub_aff_id={replace_it}"
                                            required>
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
                                        <input type="text" name="sub_title" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Earnings (₹)</label>
                                        <input type="number" name="earnings" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Category *</label>
                                        <select name="category_id" class="form-control" required>
                                            <option value="">Choose Category</option>
                                            @foreach ($categories as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Subcategory</label>
                                        <select name="subcategory_id" id="subcategory" class="form-control">
                                            <option value="">Select Subcategory</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Expiry Days</label>
                                        <input type="number" name="expiry_days" class="form-control" value="30"
                                            required>
                                    </div>



                                    <div class="col-md-12">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Product Image</label>
                                        <input type="file" name="product_image" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Banner</label>
                                        <input type="file" name="banner" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <br>
                                        <label>
                                            <input type="checkbox" name="is_top_product"> Top Product?
                                        </label>

                                        <input type="text" name="top_product_title" class="form-control mt-1"
                                            placeholder="Top product title (optional)">
                                    </div>

                                    <div class="col-md-6">
                                        <br>
                                        <label>
                                            <input type="checkbox" name="is_recommended"> Recommended?
                                        </label>
                                    </div>

                                </div>

                                <button class="btn btn-primary mt-3">Save Product</button>

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
