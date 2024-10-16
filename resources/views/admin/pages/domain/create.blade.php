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
                                <h4 class="card-title">Lĩnh vực</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.domain.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Tên lĩnh vực</label>
                                    </div>
                                    <div class="col-lg-9">
                                            <input class="form-control" type="text" value="{{ old('nameDomain') }}" name="nameDomain">
                                    </div>
                                    @error('nameDomain')
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    </div>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Trạng thái</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <select class="form-select rounded-pill mb-3" name="is_active" aria-label="Default select example">
                                            <option value="" selected>Trạng thái</option>
                                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Kích hoạt</option>
                                            <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Không kích hoạt</option>
                                        </select>
                                    </div>
                                    @error('is_active')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-end">
                                    <button  type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.domain.index') }}'"><i class="ri-arrow-go-back-line">Trở về</i></button>

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
