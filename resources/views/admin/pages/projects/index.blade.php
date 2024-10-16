@extends('admin.layouts.index')
@section('title',"Trang chủ")
@push('styles')
    <link href="{{ asset('theme/admin/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
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
                        <h4 class="mb-sm-0">Quản lí công nghệ</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Công nghệ sử dụng</a></li>
                                <li class="breadcrumb-item active">Danh sách công nghệ</li>
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
                                <div class="d-flex align-items-center " style="flex:1;">
                                    <button type="button" class="btn btn-success waves-effect waves-light "
                                            id="btnSearch"><i class="ri-filter-2-fill"></i></button>
                                    <div id="dateSearch" class="px-2" style="flex:1;" hidden>
                                        <form action="{{ route('admin.projects.search') }}" method="POST"
                                         >
                                            @csrf
                                            <div class="row mb-2">
                                                <div class="col-lg-12">
                                                    <!-- Input with Label -->
                                                    <input type="text" name="nameProject" class="form-control" value="{{ !empty($nameProjectOld) ? $nameProjectOld : ''  }}" placeholder="Tên dự án">
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-12">
                                                    <!-- Input with Label -->
                                                        <label for="labelInput" class="form-label">Người thực hiện</label>
                                                    <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="author[]" multiple>
                                                        @forelse($users as $key => $user)
                                                            @if(!empty($authorOld))
                                                                @forelse($authorOld as $key1 => $authorOldItem)
                                                                    <option value="{{ $user->id }}" {{ $authorOldItem == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                                @empty
                                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                                @endforelse
                                                            @else
                                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endif
                                                        @empty
                                                            <option value="">Không có người thực hiện</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-lg-12">
                                                    <label for="labelInput" class="form-label">Công nghệ dự án</label>
                                                    <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="technical[]" multiple>
                                                        @forelse($technicals as $key => $technical)
                                                            @if(!empty($technicalOld))
                                                                @forelse($technicalOld as $key1 => $technicalOldItem)
                                                                    <option value="{{ $technical->id }}" {{ $technicalOldItem == $technical->id ? 'selected' : '' }}>{{ $technical->name }}</option>
                                                                @empty
                                                                    <option value="{{ $technical->id }}">{{ $technical->name }}</option>
                                                                @endforelse
                                                            @else
                                                            <option value="{{ $technical->id }}">{{ $technical->name }}</option>
                                                            @endif
                                                        @empty
                                                            <option value="">Không có công nghệ</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-12">
                                                    <label for="labelInput" class="form-label">Lĩnh vực dự án</label>
                                                    <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="domains[]" multiple>
                                                        @forelse($domains as $key => $domain)
                                                            @if(!empty($domainOld))
                                                                @forelse($domainOld as $key1 => $domainOldItem)
                                                                    <option value="{{ $domain->id }}" {{ $domainOldItem == $domain->id ? 'selected' : '' }}>{{ $domain->name }}</option>
                                                                @empty
                                                                    <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                                                                @endforelse
                                                            @else
                                                                <option value="{{ $domain->id }}">{{ $domain->name }}</option>
                                                            @endif
                                                        @empty
                                                            <option value="">Không có lĩnh vực</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb- align-items-center mb-2">
                                                <div class="col-lg-3">
                                                    <select class="js-example-basic-single" name="level">
                                                        @forelse($levels as $key => $level)
                                                            <option value="{{ $level->id }}" {{ !empty($levelOld) && $levelOld == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                                                        @empty
                                                            <option value="">Không có cấp độ</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <input type="date" class="form-control ms-2" name="startDate"
                                                           value="{{ !empty($startDate) ? \Illuminate\Support\Carbon::parse($startDate)->format('Y-m-d') : "" }}">
                                                    @error('startDate')
                                                    <div class="alert alert-danger h6 m-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-1 d-flex align-items-center justify-content-center">
                                                    <i class="ri-arrow-left-right-line fs-5"></i></div>
                                                <div class="col-lg-4">
                                                    <input type="date" class="form-control ms-2" name="endDate"
                                                           value="{{ !empty($endDate) ? \Illuminate\Support\Carbon::parse($endDate)->format('Y-m-d') : "" }}">
                                                    @error('endDate')
                                                    <div class="alert alert-danger h6 m-2">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 ">
                                                    <button type="submit" class="btn btn-danger w-100" data-toast
                                                            data-toast-text="Đã tải dữ liệu mới"
                                                            data-toast-gravity="top"
                                                            data-toast-position="right" data-toast-duration="3000"
                                                            data-toast-close="close"><i class="ri-search-line"></i>
                                                    </button>
                                                </div>
                                            </div>



                                        </form>

                                    </div>

                                </div>
                                {{--                                <div class="row mt-3">--}}
                                {{--                                    <div class="col-lg-6">--}}
                                {{--                                        <input type="text" class="form-control" name="projectName" placeholder="Tên dự án" value="{{ $projectName ?? '' }}">--}}
                                {{--                                    </div>--}}
                                {{--                                    <div class="col-lg-6">--}}
                                {{--                                        <select class="form-select" name="projectLevel">--}}
                                {{--                                            <option value="">Chọn cấp độ dự án</option>--}}
                                {{--                                            <option value="1" {{ isset($projectLevel) && $projectLevel == 1 ? 'selected' : '' }}>Cấp độ 1</option>--}}
                                {{--                                            <option value="2" {{ isset($projectLevel) && $projectLevel == 2 ? 'selected' : '' }}>Cấp độ 2</option>--}}
                                {{--                                            <!-- Thêm các option cho các cấp độ khác nếu cần thiết -->--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                    --}}
                                {{--                                </div>--}}
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('admin.projects.create') }}"
                                       class="btn btn-primary waves-effect waves-light">Thêm mới</a>
                                    <button type="button" onclick="window.location.href='{{ route('admin.projects.sortDeleteRecord') }}'" class="btn ms-2 btn-warning waves-effect waves-light"
                                           ><i class="ri-install-fill me-2"></i>Thùng rác</button>
                                    <button type="button" hidden class="btn ms-2 btn-danger waves-effect waves-light"
                                            id="deleteSelectedBtn"><i class="ri-delete-bin-line"></i></button>
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
                                    <th>Tên dự án</th>
                                    <th>Link deloy</th>
                                    <th>Cấp độ dự án</th>
                                    <th>Người thực hiện</th>
                                    <th>Công nghệ</th>
                                    <th>Lĩnh vực</th>
                                    <th>Lượt xem</th>
                                    <th>Trạng thái</th>
                                    <th>Thời gian tạo</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($projects->count() > 0)
                                    @foreach($projects as $key => $project)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input fs-15" type="checkbox"
                                                           name="checkAll" value="{{ $project->id }}">
                                                </div>
                                            </th>
                                            {{--                                            <td><img class="img-banner" src="{{ \Illuminate\Support\Facades\Storage::url('images/banner/' .$banner->image) }}" alt="" ></td>--}}
                                            <td>
                                                {{ $project->name }}
                                            </td>
                                            <td>
                                                <a class="text-decoration-underline link-offset-3"
                                                   href="{{ $project->deploy_link }}">{{ $project->name }}</a>
                                            </td>
                                            <td>
                                                {{ $project->level->name }}
                                            </td>
                                            <td>
                                                @php
                                                    $members = explode(',', $project->added_by);
                                                @endphp
                                                @forelse($members as $key => $member)
                                                    <span
                                                        class="badge bg-secondary">{{ !empty($member) ? $member : ''  }}</span>
                                                @empty
                                                    <span class="badge bg-secondary">Không có thành viên tham dự</span>
                                                @endforelse
                                            </td>

                                            <td>
                                                @php
                                                    $technicals = \App\Models\technical_projects::with(['technical' => function ($query) {
                                                        $query->withTrashed();
                                                    }])->where('projects_id', $project->id)->get();
                                                @endphp
                                                @forelse($technicals as $key => $technical)
                                                    <span
                                                        class="badge bg-secondary">{{ !empty($technical->technical->name) ? $technical->technical->name : ''  }}</span>
                                                @empty
                                                    <span class="badge bg-secondary">Không có công nghệ sử dụng</span>
                                                @endforelse

                                            </td>

                                            <td>
                                                @php
                                                    $domains = \App\Models\project_domains::with(['domain' => function ($query) {
                                                        $query->withTrashed();
                                                    }])->where('projects_id', $project->id)->get();
                                                @endphp
                                                @forelse($domains as $key => $domain)
                                                    <span
                                                        class="badge bg-secondary">{{  !empty($domain->domain->name) ? $domain->domain->name : '' }}</span>
                                                @empty
                                                    <span class="badge bg-secondary">Không thuộc lĩnh vực nào</span>
                                                @endforelse

                                            </td>
                                            <td>
                                                {{ $project->views }}
                                            </td>

                                            <td>
                                                @if($project->is_active == 0)
                                                    <span class="badge bg-success">Đang hoạt động</span>
                                                @else
                                                    <span class="badge bg-danger">Đã xóa</span>
                                                @endif
                                            </td>
                                            <td>{{ \Illuminate\Support\Carbon::parse($project->created_at)->format('d M, Y') }}</td>

                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill align-middle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-item-btn"
                                                               href="{{ route('admin.projects.edit',$project->id) }}"><i
                                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                Edit</a></li>
                                                        <li>

                                                            <a class="dropdown-item remove-item-btn btnDelete"
                                                               data-id="{{$project->id}}">
                                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                Delete
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
                                {{ $projects->links() }}
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
    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('theme/admin/assets/js/pages/select2.init.js') }}"></script>
    <script>
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
        selectAllBtn.addEventListener('click', function () {
            const checkboxes = document.querySelectorAll('input[name="checkAll"]');
            const checkedStatus = selectAllBtn.getAttribute('data-checked');

            checkboxes.forEach(checkbox => checkbox.checked = checkedStatus === 'false');

            // Cập nhật trạng thái của nút "Chọn tất cả"
            selectAllBtn.setAttribute('data-checked', checkedStatus === 'false' ? 'true' : 'false');


            const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            deleteSelectedBtn.setAttribute('data-ids', Array.from(checkboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value).join(','));
            deleteSelectedBtn.hidden = !anyChecked;
        });


        document.querySelectorAll('input[name="checkAll"]').forEach(checkbox => {
            checkbox.addEventListener('click', function () {
                // Hiển thị hoặc ẩn nút "Xóa các mục đã chọn" dựa trên trạng thái của checkbox
                const anyChecked = Array.from(document.querySelectorAll('input[name="checkAll"]')).some(checkbox => checkbox.checked);
                deleteSelectedBtn.setAttribute('data-ids', Array.from(document.querySelectorAll('input[name="checkAll"]')).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value).join(','));
                deleteSelectedBtn.hidden = !anyChecked;
            });
        });

        deleteSelectedBtn.addEventListener('click', function () {
            const ids = this.getAttribute('data-ids');
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
                    Swal.fire(
                        {
                            title: 'Đang xóa...',
                            onBeforeOpen: () => {
                                Swal.showLoading();
                            }
                        }
                    );
                    window.location.href += `/delete/${ids}`;
                }
            });
        });
    </script>
@endpush
