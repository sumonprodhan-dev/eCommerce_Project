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
            <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm">Add Product</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="card-title">Products</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-striped table-hover" id="brand">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Is Featured</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ Str::limit($product->name, 30) }}</td>
                                        <td>{{ $product->category->name ?? '' }}</td>
                                        <td>{{ $product->subCategory->name ?? '' }}</td>
                                        <td>{{ $product->brand->name ?? '' }}</td>
                                        <td>
                                            @if ($product->discount != null)
                                                <del> {{ $product->price }}</del> <br>
                                                <span>{{ $product->discount_price }} ({{ $product->discount }}%)</span>
                                            @else
                                                {{ $product->price }}
                                            @endif
                                        </td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>
                                            @if ($product->is_featured == true)
                                                <span class="badge badge-primary">Featured</span>
                                            @else
                                                <span class="badge badge-info">Regular</span>
                                            @endif

                                        </td>
                                        <td>
                                            @if ($product->deleted_at == true)
                                                <span class="badge badge-danger">Trashed</span>
                                            @elseif ($product->status == true)
                                                <span class="badge badge-success">Published</span>
                                            @else
                                                <span class="badge badge-secondary">Draft</span>
                                            @endif
                                        </td>
                                        <td width="16%">

                                            @if ($product->deleted_at == true)
                                                <a href="{{ route('admin.product.restore', $product->id) }}"
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="fa fa-recycle"></i>
                                                </a>

                                                <button onclick="deleteRecord({{ $product->id }})" type="button"
                                                    class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                                    title="Delete product">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $product->id }}"
                                                    action="{{ route('admin.product.destroy', $product->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @else
                                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="{{ route('admin.product.trash', $product->id) }}"
                                                    onclick="return confirm('Are you sure you want to move this product to trash?')"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fa fa-trash"></i>
                                                </a>

                                                <a href="{{ route('admin.product.show', $product->id) }}"
                                                    class="btn btn-sm btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                @endforelse


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('page_css')
    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css
    " rel="stylesheet">
@endpush

@push('page_js')
    <!-- Datatables -->
    <script src="{{ asset('assets/backend/js/plugin/datatables/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
@endpush

@push('custom_js')
    <script>
        $(document).ready(function() {

            $("#brand").DataTable({});

        });

        function deleteRecord(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.value) {
                        $('#delete-form-' + id).submit();
                    }
                    /* swalWithBootstrapButtons.fire({
                     title: "Deleted!",
                     text: "Your file has been deleted.",
                     icon: "success"
                     });*/
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        icon: "error"
                    });
                }
            });
            /*   swal({
                   title: 'Are you sure?',
                   text: "You won't be able to revert this!",
                   type: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Yes, Delete!'
               }).then((result) => {
                   if (result.value) {
                       $('#delete-form-' + id).submit();
                   }
               })
                   */
        }
    </script>
@endpush
