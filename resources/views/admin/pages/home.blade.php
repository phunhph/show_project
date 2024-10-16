@extends('admin.layouts.index')
@section('title',"Trang chủ")
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col">

                    <div class="h-100">
                        <div class="row mb-3 pb-1">
                            <div class="col-12">
                                <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                    <div class="flex-grow-1">
                                        <h4 class="fs-16 mb-1">Good Morning, {{ \Illuminate\Support\Facades\Auth::user()->name }}!</h4>
                                        <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                                    </div>
{{--                                    <div class="mt-3 mt-lg-0">--}}
{{--                                        <form action="javascript:void(0);">--}}
{{--                                            <div class="row g-3 mb-0 align-items-center">--}}
{{--                                                <div class="col-sm-auto">--}}
{{--                                                    <div class="input-group">--}}
{{--                                                        <input type="text" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">--}}
{{--                                                        <div class="input-group-text bg-primary border-primary text-white">--}}
{{--                                                            <i class="ri-calendar-2-line"></i>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <!--end col-->--}}
{{--                                            </div>--}}
{{--                                            <!--end row-->--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
                                </div><!-- end card header -->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->

                        <div class="row">

                            <div class="col-xl-12 col-md-12">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Tổng dự án</p>
                                            </div>
                                            @php
                                                $class = $percentageChange >= 0 ? 'text-success' : 'text-danger'; // Kiểm tra xem phần trăm có là tăng hay giảm
                                                $icon = $percentageChange >= 0 ? 'ri-arrow-right-up-line' : 'ri-arrow-right-down-line'; // Chọn icon tương ứng
                                            @endphp
                                            <div class="flex-shrink-0">
                                                <h5 class="{{ $class }} fs-14 mb-0">
                                                    <i class="{{ $icon }} fs-13 align-middle"></i>
                                                    {{ abs($percentageChange) }} %
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{ $totalProjects }}">0</span></h4>
                                                <a href="{{ route('admin.projects.index') }}" class="text-decoration-underline">Xem tất cả dự án</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                                            <i class="bx bx-shopping-bag text-info"></i>
                                                        </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->


                        </div> <!-- end row-->

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header border-0 align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Các dự án theo lĩnh vực</h4>

                                    </div><!-- end card header -->


                                    <div class="card-body p-0 pb-2">
                                        <div class="w-100">
                                            <div id="column_chart_datalabel" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                        </div>



                    </div> <!-- end .h-100-->

                </div> <!-- end col -->

            </div>

        </div>
        <!-- container-fluid -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('theme/admin/assets/js/pages/datatables.init.js') }}"></script>
    <!-- apexcharts -->
    <script src="{{ asset('theme/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/dayjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/plugin/quarterOfYear.min.js"></script>

    <!-- apexcharts init -->
    <script src="{{ asset('theme/admin/assets/js/pages/apexcharts-column.init.js') }}"></script>

    <script>
        @php
            $categories = $projectsPerDomain->map(function($da) {
            return $da->domain_name;
        })->toArray();

             $project_count = $projectsPerDomain->map(function($da) {
            return $da->project_count;
        })->toArray();
        @endphp
        chart.destroy();
        chartColumnColors = getChartColorsArray("column_chart"),chartColumnStackedColors =(chartColumnDatatalabelColors &&
                ((options = {
                    chart: { height: 350, type: "bar", toolbar: { show: !1 } },
                    plotOptions: { bar: { dataLabels: { position: "top" } } },
                    dataLabels: {
                        enabled: !0,
                        formatter: function (e) {
                            return e ;
                        },
                        offsetY: -20,
                        style: { fontSize: "12px", colors: ["#adb5bd"] },
                    },
                    series: [
                        {
                            name: "Số lượng dự án",
                            data:@json($project_count),
                        },
                    ],
                    colors: chartColumnDatatalabelColors,
                    grid: { borderColor: "#f1f1f1" },
                    xaxis: {
                        categories: @json($categories),
                        position: "top",
                        labels: { offsetY: -18 },
                        axisBorder: { show: !1 },
                        axisTicks: { show: !1 },
                        crosshairs: {
                            fill: {
                                type: "gradient",
                                gradient: {
                                    colorFrom: "#D8E3F0",
                                    colorTo: "#BED1E6",
                                    stops: [0, 100],
                                    opacityFrom: 0.4,
                                    opacityTo: 0.5,
                                },
                            },
                        },
                        tooltip: { enabled: !0, offsetY: -35 },
                    },
                    fill: {
                        gradient: {
                            shade: "light",
                            type: "horizontal",
                            shadeIntensity: 0.25,
                            gradientToColors: void 0,
                            inverseColors: !0,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [50, 0, 100, 100],
                        },
                    },
                    yaxis: {
                        axisBorder: { show: !1 },
                        axisTicks: { show: !1 },
                        labels: {
                            show: !1,
                            formatter: function (e) {
                                return e + "%";
                            },
                        },
                    },
                    title: {
                        text: "Bản đồ thống kê dự án theo lĩnh vực",
                        floating: !0,
                        offsetY: 320,
                        align: "center",
                        style: { fontWeight: 500 },
                    },
                }),
                    (chart = new ApexCharts(
                        document.querySelector("#column_chart_datalabel"),
                        options
                    )).render()))
    </script>
@endpush
