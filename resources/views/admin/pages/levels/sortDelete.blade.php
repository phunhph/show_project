@extends('admin.layouts.index')
@section('title',"Trang chủ")
@push('styles')
    <link href="{{ asset('theme/admin/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
          type="text/css"/>
@endpush
@section('content')

    <div class="page-content">
        <div class="container-fluid">
            @if(session('success'))
                <div id="toastContainer" class="position-fixed top-0 end-0 p-3" style="z-index: 5">
                    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="3000">
                        <div class="toast-header bg-success text-white">
                            <strong class="me-auto">Success</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif



            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Mức độ dự án</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Mức độ</a></li>
                                <li class="breadcrumb-item active">Danh sách mức độ</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Input Date -->
                                <div class="d-flex align-items-center ">
                                    <button type="button" class="btn btn-success waves-effect waves-light " id="btnSearch"><i class="ri-filter-2-fill"></i></button>
                                    <div id="dateSearch" hidden >
                                        <form action="{{ route('admin.levels.searchDelete') }}" method="POST" class="d-flex align-items-center" >
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control ms-2" placeholder="Nhập tên muốn tìm" name="nameValue" value="{{  $nameValue ?? '' }}">
                                                    @error('nameValue')
                                                    <div class="alert alert-danger h6 m-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-3">
                                                    <button type="submit" class="btn btn-danger ms-2" data-toast
                                                            data-toast-text="Đã tải dữ liệu mới" data-toast-gravity="top"
                                                            data-toast-position="right" data-toast-duration="3000"
                                                            data-toast-close="close"><i class="ri-search-line"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('admin.levels.index') }}"
                                       class="btn btn-danger waves-effect waves-light">Trở về</a>
                                    <button type="button" hidden class="btn ms-2 btn-warning waves-effect waves-light"
                                            id="deleteSelectedBtn"><i class="ri-restart-line"></i></button>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example"
                                   class="table table-bordered dt-responsive nowrap table-striped align-middle"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 10px;">
                                        <div class="form-check">
                                            <input class="form-check-input fs-15" type="checkbox" id="checkAll"
                                                   value="option" data-checked="false">
                                        </div>
                                    </th>
                                    {{--                                    <th>Ảnh</th>--}}
                                    <th>Tên cấp độ</th>
                                    <th>Mô tả</th>
                                    <th>Thời gian tạo</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($Levels->count() > 0)
                                    @foreach($Levels as $key => $level)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input fs-15" type="checkbox"
                                                           name="checkAll" value="{{ $level->id }}">
                                                </div>
                                            </th>
                                            <td>{{ $level->name }}</td>
                                            <td>
                                                {{ $level->description }}
                                            </td>
                                            <td>{{ \Illuminate\Support\Carbon::parse($level->created_at)->format('d M, Y') }}</td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill align-middle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">

                                                        <li><a class="dropdown-item edit-item-btn"
                                                               href="{{ route('admin.levels.edit',$level->id) }}"><i
                                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                Edit</a></li>
                                                        <li>
                                                        <li>

                                                            <a class="dropdown-item remove-item-btn btnRestore"
                                                               data-id="{{$level->id}}">
                                                                <i class=" ri-restart-line align-bottom me-2 text-muted"></i>
                                                                Restore
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>

                                        </tr>
                                @endforeach
                                @endif
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $Levels->links() }}
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
        <!-- container-fluid -->
    </div>
@endsection

@push('scripts')
    <!-- Sweet Alerts js -->
    <script src="{{ asset('theme/admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('theme/admin/assets/js/pages/sweetalerts.init.js') }}"></script>

    <!-- Modal Js -->
    <script src="{{ asset('theme/admin/assets/js/pages/modal.init.js') }}"></script>
    <script>
        // Delete
        const btnSearch = document.querySelector('#btnSearch');
        const dateSearch = document.querySelector('#dateSearch');

        btnSearch.addEventListener('click', function () {
            // Toggle the visibility of the date input
            dateSearch.hidden = !dateSearch.hidden;

            // Set focus to the date input when it's shown
            if (!dateSearch.hidden) {
                dateSearch.focus();
            }
        });


        // checkbox
        const selectAllBtn = document.getElementById('checkAll');
        const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
        console.log(selectAllBtn);
        selectAllBtn.addEventListener('click', function () {
            const checkboxes = document.querySelectorAll('input[name="checkAll"]');
            const checkedStatus = selectAllBtn.getAttribute('data-checked');

            checkboxes.forEach(checkbox => checkbox.checked = checkedStatus === 'false');

            // Cập nhật trạng thái của nút "Chọn tất cả"
            selectAllBtn.setAttribute('data-checked', checkedStatus === 'false' ? 'true' : 'false');


            const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            deleteSelectedBtn.setAttribute('data-ids', Array.from(checkboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value).join(',') );
            deleteSelectedBtn.hidden = !anyChecked;
        });


        document.querySelectorAll('input[name="checkAll"]').forEach(checkbox => {
            checkbox.addEventListener('click', function () {
                // Hiển thị hoặc ẩn nút "Xóa các mục đã chọn" dựa trên trạng thái của checkbox
                const anyChecked = Array.from(document.querySelectorAll('input[name="checkAll"]')).some(checkbox => checkbox.checked);
                deleteSelectedBtn.setAttribute('data-ids', Array.from(document.querySelectorAll('input[name="checkAll"]')).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value).join(',') );
                deleteSelectedBtn.hidden = !anyChecked;
            });
        });

        deleteSelectedBtn.addEventListener('click', function () {
            const ids = this.getAttribute('data-ids');
            Swal.fire({
                title: 'Bạn có chắc chắn muốn khôi phục không?',
                text: "Dữ liệu sẽ được khôi phục lại!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Khôi phục'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        {
                            title: 'Đang khôi phục...',
                            onBeforeOpen: () => {
                                Swal.showLoading();
                            }
                        }
                    );
                    window.location.href += `/restore/${ids}` ;
                }
            });
        });
    </script>
@endpush
