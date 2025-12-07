@extends('layouts.backend.master')

@section('content')
    <div class="page-header d-flex justify-between">
        <div>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.product.index') }}">Product</a>
                </li>

            </ul>
        </div>
        <div>
            <a href="{{ route('admin.product.index') }}" class="btn btn-danger btn-sm">Back to Products</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="card-title">Add New Product</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        value="{{ old('slug') }}">
                                    @error('slug')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="short_description" class="form-label">Short Description <strong
                                            class="text-danger">*</strong></label>
                                    <textarea type="text" class="form-control" id="short_description" rows="4" name="short_description">{{ old('short_description') }}</textarea>
                                    @error('short_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Product Description <strong
                                            class="text-danger">*</strong></label>
                                    <textarea type="text" class="form-control" id="description" rows="4" name="description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price <strong
                                                    class="text-danger">*</strong></label>
                                            <input type="number" class="form-control" id="price" min="0"
                                                name="price" value="{{ old('price') }}">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="quantity" class="form-label">Quantity <strong
                                                    class="text-danger">*</strong></label>
                                            <input type="number" class="form-control" min="0" id="quantity"
                                                name="quantity" value="{{ old('quantity') }}">
                                            @error('quantity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="discount" class="form-label">Discount</label>
                                            <input type="number" class="form-control" min="0" id="discount"
                                                name="discount" value="{{ old('discount') }}">
                                            @error('discount')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="discount_price" class="form-label">Discount_price Price </label>
                                            <input type="number" class="form-control" id="discount_price"
                                                name="discount_price" value="{{ old('discount_price') }}">
                                            @error('discount_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4">

                                <div class="mb-3">
                                    <label for="status" class="form-label">Select Category</label>
                                    <select name="category" id="category" class="form-select">
                                        <option value="" selected disabled>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Select Sub Category</label>
                                    <select name="subCategory" id="subCategory" class="form-select">

                                    </select>

                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Select Brand</label>
                                    <select name="brand" id="brand" class="form-select">
                                        <option value="" selected disabled>Select Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Product Images <strong
                                            class="text-danger">*</strong></label>
                                    <input type="file" class="form-control" multiple id="images" name="images[]">
                                    @error('images')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label>Is Featured?</label>
                                    <div class="form-check pb-1">
                                        <input class="form-check-input" type="radio" name="is_featured" id="yes"
                                            value="1">
                                        <label class="form-check-label" for="yes">Yes</label>
                                    </div>
                                    <div class="form-check pt-1">
                                        <input class="form-check-input" type="radio" name="is_featured" checked
                                            id="no" value="0">
                                        <label class="form-check-label" for="no">No</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Status</label>
                                    <div class="form-check pb-1">
                                        <input class="form-check-input" type="radio" name="status" id="published"
                                            value="1">
                                        <label class="form-check-label" for="published">Published</label>
                                    </div>
                                    <div class="form-check pt-1">
                                        <input class="form-check-input" type="radio" name="status" checked
                                            id="draft" value="0">
                                        <label class="form-check-label" for="draft">Draft</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center py-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection


@push('page_css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/dropify/dist/css/dropify.min.css') }}">
    <!-- include summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@push('page_js')
    <script src="{{ asset('assets/backend/vendor/dropify/dist/js/dropify.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
@endpush

@push('custom_js')
    <script>
        $(document).ready(function() {
            $('#name').keyup(function() {
                let name = $(this).val();
                $('#slug').val(slugify(name));
            });
        });


        function slugify(text) {
            return text.toString().toLowerCase().trim()
                .replace(/&/g, '-and-') // Replace & with 'and'
                .replace(/[\s\W-]+/g, '-') // Remove all non-word chars
                .replace(/-+$/, '');
        }

        // Dropify
        $('.dropify').dropify({
            height: 120,
        });

        $('#description').summernote({
            placeholder: 'Product Description',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });

        $('#category').change(function() {

            let category_id = $(this).val();

            $.ajax({
                url: "{{ route('admin.get.subcategory') }}",
                type: "GET",
                data: {
                    category_id: category_id
                },
                success: function(response) {

                    //console.log(response);

                    $('#subCategory').html(response);
                }
            })
        })


        $('#discount').keyup(function() {
            let discount = $(this).val();
            let price = $('#price').val();

            let discounted_price = price - (price * discount) / 100;
            if (discounted_price > 0) {

                $('#discount_price').val(discounted_price);
            } else {
                $('#discount_price').val('');
            }
        });

        $('#price').keyup(function() {
            $('#discount_price').val('');
        })
    </script>
@endpush
