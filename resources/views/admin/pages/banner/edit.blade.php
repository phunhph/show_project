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
                                <h4 class="card-title">Chỉnh sửa banner</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.banner.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $banner->id }}">
                                <div class="row mb-3">
                                    <div class="col-lg-12 d-flex justify-content-center">
                                        <img width="10%" src="{{ \Illuminate\Support\Facades\Storage::url('images/banner/' .$banner->image) }}"   alt="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="nameInput" class="form-label">Ảnh</label>
                                    </div>
                                    <div class="col-lg-9">

                                            <input class="form-control" type="file" name="image" id="formFile">
                                    </div>
                                    @error('image')
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
                                            <option value="0" {{ $banner->is_active == 0 ? 'selected' : '' }}>Kích hoạt</option>
                                            <option value="1" {{ $banner->is_active == 1 ? 'selected' : '' }}>Không kích hoạt</option>
                                        </select>
                                    </div>
                                    @error('is_active')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-end">
                                    <button  type="button" class="btn btn-danger" onclick="window.location.href='{{ route('admin.banner.index') }}'"><i class="ri-arrow-go-back-line">Trở về</i></button>

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
