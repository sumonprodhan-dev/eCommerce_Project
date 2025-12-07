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
                    <h4 class="card-title">Product Details</h4>
                </div>
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                        </div>

                        <div class="col-md-6">

                            <p>{{ $product->category->name??'' }} > {{ $product->subCategory->name??'' }}</p>

                            <h5>{{ $product->name }}</h5>

                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection


@push('page_css')
@endpush

@push('page_js')
@endpush

@push('custom_js')
@endpush
