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
                                <h4 class="card-title">Dự án</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.projects.update') }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $project->id }}">
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Tên dự án</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" placeholder="tên dự án"
                                               name="nameProject" value="{{ $project->name }}">
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
                                        <textarea class="ckeditor-classic" id="exampleFormControlTextarea5"
                                                  name="description" placeholder="Mô tả"
                                                  rows="3">{{ $project->description }}</textarea>
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
                                        <input class="form-control" type="text" placeholder="đường dẫn dự án"
                                               value="{{ $project->deploy_link }}" name="linkDeloy">
                                    </div>
                                    @error('linkDeloy')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="row mb-3 align-items-center">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Ảnh Đại diện</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="row align-items-center">
                                            <div class="col-lg-2 d-flex justify-content-center">
                                                <!-- Rounded-circle Image -->
                                                <img class="rounded-circle avatar-xl" alt="200x200"
                                                     style="object-fit: cover;"
                                                     src="{{  \Illuminate\Support\Facades\Storage::url('images/projects/avatar/' .$avatar->image) }}">
                                            </div>
                                            <div class="col-lg-10 ">
                                                <input class="form-control" type="file" name="imageProjectAvatar"
                                                       id="formFile">
                                            </div>

                                        </div>
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

                                        <input type="file" class="filepond filepond-input-multiple" multiple
                                               name="imagesDescription[]" data-allow-reorder="true"
                                               data-max-file-size="5MB" data-max-files="5">
                                        <input type="hidden" name="oldImagesDescription" value="{{ $imagesDesOld}}">
                                        <ul class="list-unstyled mb-0" id="dropzone-preview">
                                            @forelse($imagesDes as $desimg)
                                                <div class="border rounded" id="desimg-{{ $desimg->id }}">
                                                    <div class="d-flex p-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm bg-light rounded">
                                                                <img data-dz-thumbnail class="img-fluid rounded d-block"
                                                                     src="{{  \Illuminate\Support\Facades\Storage::url('description/' .$desimg->image) }}"
                                                                     alt="Dropzone-Image"/>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="pt-1">
                                                                <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                                <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                                <strong class="error text-danger"
                                                                        data-dz-errormessage></strong>
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-3">
                                                            <button type="button"  class="btn btn-sm btn-danger btn-remove-image-des" data-id="{{ $desimg->id }}">
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-lg-12">
                                                    <div class="alert alert-danger mt-2">Không có ảnh mô tả</div>
                                                </div>
                                            @endforelse
                                            <li class="mt-2" id="dropzone-preview-list">
                                                <!-- This is used as the file preview template -->


                                            </li>
                                        </ul>
{{--                                        <div class="row">--}}
{{--                                            @forelse($imagesDes as $desimg)--}}
{{--                                                <div class="col-lg-2">--}}
{{--                                                    <img--}}
{{--                                                        src="{{  \Illuminate\Support\Facades\Storage::url('description/' .$desimg->image) }}"--}}
{{--                                                        style="object-fit: cover;" alt="" class="rounded avatar-xl">--}}
{{--                                                </div>--}}
{{--                                            @empty--}}
{{--                                                <div class="col-lg-12">--}}
{{--                                                    <div class="alert alert-danger mt-2">Không có ảnh mô tả</div>--}}
{{--                                                </div>--}}
{{--                                            @endforelse--}}
{{--                                        </div>--}}
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
                                        <select class="form-control" id="choices-single-no-sorting" name="level"
                                                data-choices data-choices-sorting-false>
                                            @if($levels->count() > 0)
                                                @foreach($levels as $level)
                                                    <option
                                                        value="{{ $level->id }}" {{ $level->id == $project->level_id ? 'selected' : '' }}>{{ $level->name }}</option>
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
                                        <select class="form-control" id="choices-multiple-remove-button" data-choices
                                                data-choices-removeItem name="technicalsUse[]" multiple>
                                            @forelse($technicals as $key => $technical)
                                                @php
                                                    $selectedTechnicalId = null; // Khởi tạo biến để lưu ID công nghệ được chọn
                                                @endphp
                                                @foreach($technicalUse as $techUse)
                                                    @if($technical->id == $techUse->technicals_id)
                                                        @php
                                                            $selectedTechnicalId = $techUse->technicals_id; // Gán ID công nghệ được chọn
                                                            break; // Thoát khỏi vòng lặp nếu đã tìm thấy ID công nghệ được chọn
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <option value="{{ $technical->id }}" {{ $technical->id == $selectedTechnicalId ? 'selected' : ''}}>{{ $technical->name }}</option>
                                            @empty
                                                <option value="">Không có công nghệ</option>
                                            @endforelse
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
                                        <select class="form-control" id="choices-multiple-remove-button" data-choices
                                                data-choices-removeItem name="domains[]" multiple>
                                            @forelse($domains as $key => $domain)
                                                @php
                                                    $selectedDomainId = null; // Khởi tạo biến để lưu ID lĩnh vực được chọn
                                                @endphp
                                                @foreach($domainProjects as $domainProject)
                                                    @if($domain->id == $domainProject->domains_id)
                                                        @php
                                                            $selectedDomainId = $domainProject->domains_id; // Gán ID lĩnh vực được chọn
                                                            break; // Thoát khỏi vòng lặp nếu đã tìm thấy ID lĩnh vực được chọn
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <option value="{{ $domain->id }}" {{ $domain->id == $selectedDomainId ? 'selected' : ''}}>{{ $domain->name }}</option>
                                            @empty
                                                <option value="">Không có lĩnh vực</option>
                                            @endforelse
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
                                        <input class="form-control" id="choices-text-remove-button" data-choices="" data-choices-limit="7" data-choices-removeitem="" name="members" type="text" value="{{ $project->added_by }}">
{{--                                        <select class="form-control" id="choices-multiple-remove-button" data-choices--}}
{{--                                                data-choices-removeItem name="members[]" multiple>--}}
{{--                                            @forelse($users as $key => $member)--}}
{{--                                                @php--}}
{{--                                                    $selectedAuthorId = null; // Khởi tạo biến để lưu ID tác giả được chọn--}}
{{--                                                @endphp--}}
{{--                                                @foreach($members as $memberCreate)--}}
{{--                                                    @if($member->id == $memberCreate->author_id)--}}
{{--                                                        @php--}}
{{--                                                            $selectedAuthorId = $memberCreate->author_id; // Gán ID tác giả được chọn--}}
{{--                                                        @endphp--}}
{{--                                                        @break; // Thoát khỏi vòng lặp nếu đã tìm thấy ID tác giả được chọn--}}
{{--                                                    @endif--}}
{{--                                                @endforeach--}}
{{--                                                <option value="{{ $member->id }}" {{ $member->id == $selectedAuthorId ? 'selected' : ''}}>{{ $member->name }}</option>--}}
{{--                                            @empty--}}
{{--                                                <option value="">Không có thành viên tham gia</option>--}}
{{--                                            @endforelse--}}
{{--                                        </select>--}}
                                    </div>
                                    @error('members')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>


                                <div class="text-end">
                                    <button type="button" class="btn btn-danger"
                                            onclick="window.location.href='{{ route('admin.projects.index') }}'"><i
                                            class="ri-arrow-go-back-line">Trở về</i></button>

                                    <button type="submit" data-toast data-toast-text="Cập nhật thành công"
                                            data-toast-gravity="top" data-toast-position="right"
                                            data-toast-duration="3000" data-toast-close="close" class="btn btn-primary">
                                        Cập nhật
                                    </button>

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
    <script>
        const btnRemoves = document.querySelectorAll('.btn-remove-image-des');
        const inputImageOld = document.querySelector('input[name=oldImagesDescription]');
        console.log(inputImageOld.value);
        btnRemoves.forEach(btnRemove => {
            btnRemove.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa không?',
                    text: "Dữ liệu sẽ không thể khôi phục lại sau khi xóa!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "Bạn đã xóa thành công ảnh.",
                            icon: "success",
                            confirmButtonClass: "btn btn-primary w-xs mt-2",
                            buttonsStyling: !1,
                        });
                        const rowImageOld = document.getElementById('desimg-' + id);
                        rowImageOld.remove();
                        let array = inputImageOld.value.split(',');
                        let index = array.indexOf(id);
                        if (index !== -1) {
                            array.splice(index, 1);
                        }
                        inputImageOld.value = array.join(',')
                    }
                });


            });
        });
    </script>
@endpush
