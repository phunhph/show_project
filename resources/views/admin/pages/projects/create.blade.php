@extends('admin.layouts.index')
@section('title',"Trang chủ")
@push('styles')
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/libs/dropzone/dropzone.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/libs/filepond/filepond.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
@endpush
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Dự án</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Tên dự án</label>
                                    </div>
                                    <div class="col-lg-9">
                                            <input class="form-control" type="text" placeholder="tên dự án" name="nameProject">
                                    </div>
                                    @error('nameProject')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="exampleFormControlTextarea5" class="form-label">Mô tả</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <!-- Example Textarea -->
                                            <textarea class="ckeditor-classic" id="exampleFormControlTextarea5" name="description" placeholder="Mô tả" rows="3"></textarea>
                                    </div>
                                    @error('description')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Đường dẫn dựa án</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" placeholder="đường dẫn dự án"  name="linkDeloy">
                                    </div>
                                    @error('linkDeloy')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Ảnh Đại diện</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="file" name="imageProjectAvatar" id="formFile">
                                    </div>
                                    @error('imageProjectAvatar')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Ảnh mô tả</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="file" class="filepond filepond-input-multiple" multiple name="imagesDescription[]" data-allow-reorder="true" data-max-file-size="5MB" data-max-files="5">
                                        <ul class="list-unstyled mb-0" id="dropzone-preview">
                                            <li class="mt-2" id="dropzone-preview-list">
                                                <!-- This is used as the file preview template -->
                                                <div class="border rounded">
                                                    <div class="d-flex p-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm bg-light rounded">
                                                                <img data-dz-thumbnail class="img-fluid rounded d-block" src="assets/images/new-document.png" alt="Dropzone-Image" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="pt-1">
                                                                <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                                <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-3">
                                                            <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    @error('imagesDescription')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Cấp độ dự án</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="choices-single-no-sorting" name="level" data-choices data-choices-sorting-false>
                                            @if($levels->count() > 0)
                                            @foreach($levels as $level)
                                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                                            @endforeach
                                                @endif
                                        </select>
                                    </div>
                                    @error('level')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Công nghệ sử dụng</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="technicalsUse[]" multiple>
                                            @if($technicals->count() > 0)
                                                @foreach($technicals as $key => $technical)
                                                    <option value="{{ $technical->id }}">{{ $technical->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('technicalsUse')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>



                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Lĩnh vực dự án</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="domains[]" multiple>
                                            @if($domains->count() > 0)
                                                @foreach($domains as $key => $domain)
                                                    <option value="{{ $domain->id }}" >{{ $domain->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('domains')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>


                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Thành viên tham gia</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input class="form-control" id="choices-text-remove-button" data-choices="" data-choices-limit="7" name="members" data-choices-removeitem="" type="text">
{{--                                        <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="members[]" multiple>--}}
{{--                                            @if($users->count() > 0)--}}
{{--                                                @foreach($users as $key => $member)--}}
{{--                                                    <option value="{{ $member->id }}">{{ $member->name }}</option>--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}
{{--                                        </select>--}}
                                    </div>
                                    @error('members')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>

{{--                                <div class="row mb-3">--}}
{{--                                    <div class="col-lg-3">--}}
{{--                                        <label for="nameInput" class="form-label">Trạng thái dự án</label>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-9">--}}
{{--                                        <!-- Switches Color -->--}}
{{--                                        <div  class="d-flex">--}}
{{--                                            <div class="form-check">--}}
{{--                                                <input class="form-check-input" type="radio" name="is_active" value="1" id="is_active1" >--}}
{{--                                                <label class="form-check-label" for="is_active1">--}}
{{--                                                    Chưa thực hiện--}}
{{--                                                </label>--}}
{{--                                            </div>--}}

{{--                                            <div class="form-check ms-2">--}}
{{--                                                <input class="form-check-input" type="radio" name="is_active" value="0" id="is_active2" checked>--}}
{{--                                                <label class="form-check-label" for="is_active2">--}}
{{--                                                    Đã hoàn thành--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    @error('is_active')--}}
{{--                                    <div class="col-lg-12">--}}
{{--                                        <div class="alert alert-danger mt-2">{{ $message }}</div>--}}
{{--                                    </div>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}


                                <div class="text-end">
                                    <button  type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.projects.index') }}'"><i class="ri-arrow-go-back-line">Trở về</i></button>

                                        <button type="submit" data-toast data-toast-text="Thêm mới thành công" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="close"  class="btn btn-primary">Thêm</button>

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
    <script src="{{ asset('theme/admin/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>

    <script src="{{ asset('theme/admin/assets/js/pages/form-file-upload.init.js') }}"></script>

    <!-- ckeditor -->
    <script src="{{ asset('theme/admin/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

    <!-- quill js -->
    <script src="{{ asset('theme/admin/assets/libs/quill/quill.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('theme/admin/assets/js/pages/form-editor.init.js') }}"></script>
@endpush
