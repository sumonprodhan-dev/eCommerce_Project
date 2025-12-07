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
                    <a href="{{ route('admin.slider.index') }}">Slider</a>
                </li>

            </ul>
        </div>
        <div>
            <a href="{{ route('admin.slider.create') }}" class="btn btn-primary btn-sm">Add Slider</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="card-title">Slider</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table table-striped table-hover" id="brand">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Sub Title</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($sliders as $key => $slider)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <a href="{{ $slider->url ?? '#' }}">{{ Str::limit($slider->title, 20) }}</a>
                                        </td>
                                        <td>
                                            {{ Str::limit($slider->sub_title, 15) }}
                                        </td>
                                        <td>
                                            <img style="width: 50px" src="{{ asset($slider->image ?? '') }}"
                                                alt="{{ __('') }}">
                                        </td>
                                        <td>
                                            @if ($slider->deleted_at == true)
                                                <span class="badge badge-danger">Trashed</span>
                                            @elseif ($slider->status == true)
                                                <span class="badge badge-success">Published</span>
                                            @else
                                                <span class="badge badge-secondary">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($slider->deleted_at == true)
                                                <a href="{{ route('admin.slider.restore', $slider->id) }}"
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="fa fa-recycle"></i>
                                                </a>

                                                <button onclick="deleteRecord({{ $slider->id }})" type="button"
                                                    class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top"
                                                    title="Delete slider">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $slider->id }}"
                                                    action="{{ route('admin.slider.destroy', $slider->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            @else
                                                <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="{{ route('admin.slider.trash', $slider->id) }}"
                                                    onclick="return confirm('Are you sure you want to move this slider to trash?')"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fa fa-trash"></i>
                                                </a>

                                                <a href="{{ route('admin.slider.show', $slider->id) }}"
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
