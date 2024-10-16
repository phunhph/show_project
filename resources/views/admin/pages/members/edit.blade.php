@extends('admin.layouts.index')
@section('title',"Trang chủ")
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">Chỉnh sửa thành viên</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.members.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $member->id }}">
                                <div class="row mb-3">
                                    <div class="col-lg-12 d-flex justify-content-evenly">
                                        <img class="img-thumbnail rounded-circle avatar-xl" style="object-fit: cover;" alt="200x200" src="{{ \Illuminate\Support\Facades\Storage::url('images/member/avatar/' .$member->avatar) }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Ảnh đại diện</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="file" name="avatar" id="formFile">
                                    </div>
                                    @error('avatar')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Tên người dùng</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="{{ $member->name }}"  name="nameMember">
                                    </div>
                                    @error('nameMember')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="email" class="form-label">Email</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="{{ $member->email }}"  name="email">
                                    </div>
                                    @error('email')
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
                                        <textarea class="ckeditor-classic" id="exampleFormControlTextarea5" name="description" placeholder="Mô tả" rows="3">{{ $member->describe }}</textarea>
                                    </div>
                                    @error('description')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Mật khẩu</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="password"  name="password">
                                    </div>
                                    @error('password')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Nhập lại mật khẩu</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="password" value="{{ old('re_pass') }}" name="re_pass">
                                    </div>
                                    @error('re_pass')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>


                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="role" class="form-label">Chức vụ</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <select class="form-select rounded-pill mb-3" name="role" aria-label="Default select example">
                                            <option value="" selected>Trạng thái</option>
                                            <option value="0" {{ $member->role == 0 ? 'selected' : '' }}>User</option>
                                            <option value="1" {{ $member->role == 1 ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </div>
                                    @error('is_active')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="text-end">
                                    <button  type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.members.index') }}'"><i class="ri-arrow-go-back-line">Trở về</i></button>

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

    <!-- ckeditor -->
    <script src="{{ asset('theme/admin/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>

    <!-- quill js -->
    <script src="{{ asset('theme/admin/assets/libs/quill/quill.min.js') }}"></script>

    <!-- init js -->
    <script src="{{ asset('theme/admin/assets/js/pages/form-editor.init.js') }}"></script>
@endpush
