@extends('admin.layouts.index')
@section('title',"Trang chủ")
@push('styles')
    <link href="{{ asset('theme/admin/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/libs/dropzone/dropzone.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/libs/filepond/filepond.min.css') }}" type="text/css"/>
    <link rel="stylesheet"
          href="{{ asset('theme/admin/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
@endpush
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Chỉnh sửa nội dung</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $setting->id }}">
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Nội dung</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <textarea class="ckeditor-classic" id="exampleFormControlTextarea5" name="content" rows="3" placeholder="Mô tả ">{{  $setting->content }}</textarea>
                                    </div>
                                    @error('content')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="text-end">
                                    <button  type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.settings.index') }}'"><i class="ri-arrow-go-back-line">Trở về</i></button>
                                        <button type="submit" data-toast data-toast-text="Cập nhật thành công" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="close"  class="btn btn-primary">Cập nhật</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>



        </div>
    </div>
@endsection
@push('scripts')

    <script src="{{ asset('theme/admin/assets/libs/prismjs/prism.js') }}"></script>

    <script src="{{ asset('theme/admin/assets/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/filepond/filepond.min.js') }}"></script>
    <script
        src="{{ asset('theme/admin/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script
        src="{{ asset('theme/admin/assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}"></script>
    <script
        src="{{ asset('theme/admin/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}"></script>
    <script
        src="{{ asset('theme/admin/assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>

    <script src="{{ asset('theme/admin/assets/js/pages/form-file-upload.init.js') }}"></script>

    <-- ckeditor -->
    <script src="{{ asset('theme/admin/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

    <-- quill js -->
    <script src="{{ asset('theme/admin/assets/libs/quill/quill.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('theme/admin/assets/js/pages/form-editor.init.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('theme/admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <-- Sweet alert init js-->
    <script src="{{ asset('theme/admin/assets/js/pages/sweetalerts.init.js') }}"></script>

@endpush
