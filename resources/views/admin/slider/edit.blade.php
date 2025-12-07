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
                    <a href="{{ route('admin.slider.index') }}">slider</a>
                </li>

            </ul>
        </div>
        <div>
            <a href="{{ route('admin.slider.index') }}" class="btn btn-danger btn-sm">Back to slider</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="card-title">Edit Slider</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.slider.update',$slider->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @isset($slider)
                            @method('put')
                        @endisset
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="tile" class="form-label">Title <strong
                                            class="text-danger">*</strong></label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $slider->title?? old('title') }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="sub_title" class="form-label">Sub Title </label>
                                    <input type="text" class="form-control" id="sub_title" name="sub_title"
                                        value="{{  $slider->sub_title??old('sub_title') }}">
                                    @error('sub_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="url" class="form-label">Slider URl/Link (Proudct link) <strong
                                            class="text-danger">*</strong></label>
                                    <input type="url" class="form-control" id="url" name="url"
                                        value="{{ $slider->url?? old('url') }}">
                                    @error('url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Slider Image <strong
                                            class="text-danger">*</strong></label>
                                    <input type="file" class="form-control dropify" data-max-file-size="2M"
                                        id="image" name="image" data-default-file="{{ asset($slider->image) }}">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Status</label>
                                    <div class="form-check pb-1">
                                        <input class="form-check-input" type="radio" @checked($slider->status ==true) name="status" id="published"
                                            value="1">
                                        <label class="form-check-label" for="published">Published</label>
                                    </div>
                                    <div class="form-check pt-1">
                                        <input class="form-check-input" type="radio" @checked($slider->status ==false)  name="status" 
                                            id="draft" value="0">
                                        <label class="form-check-label" for="draft">Draft</label>
                                    </div>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection


@push('page_css')
    <link rel="stylesheet" href="{{ asset('assets/backend/vendor/dropify/dist/css/dropify.min.css') }}">
@endpush

@push('page_js')
    <script src="{{ asset('assets/backend/vendor/dropify/dist/js/dropify.min.js') }}"></script>
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
    </script>
@endpush
