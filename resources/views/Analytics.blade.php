@extends("layout/main")

@section("content")
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="card tilebox-one">
                <div class="card-body">
                    <i class='uil uil-users-alt float-end'></i>
                    <h6 class="text-uppercase mt-0">User Active</h6>
                    <h2 class="my-2" id="active-users-count">{{ $activeUser->count() }}</h2>
                </div> <!-- end card-body-->
            </div>
            <!--end card-->

            <div class="card tilebox-one">
                <div class="card-body">
                    <i class='uil uil-users-alt float-end'></i>
                    <h6 class="text-uppercase mt-0">Responden</h6>
                    <h2 class="my-2" id="active-views-count">{{ $respondent->count() }}</h2>

                </div> <!-- end card-body-->
            </div>
            <!--end card-->
            <div class="card tilebox-one">
                <div class="card-body">
                    <i class='uil uil-download-alt float-end'></i>
                    <h6 class="text-uppercase mt-0">Diunduh</h6>
                    <h2 class="my-2" id="active-views-count">{{ $downloaded->count() }}</h2>

                </div> <!-- end card-body-->
            </div>
            <!--end card-->
            <div class="card tilebox-one">
                <div class="card-body">
                    <i class='uil uil-download-alt float-end'></i>
                    <h6 class="text-uppercase mt-0">Survey</h6>
                    <h2 class="my-2" id="active-views-count">{{ $survey->count() }}</h2>

                </div> <!-- end card-body-->
            </div>
            <!--end card-->

        </div> <!-- end col -->

        <div class="col-xl-9 col-lg-8">
            <div class="card card-h-100">
                <div class="card-body">

                    <h4 class="header-title mb-3">Hasil Survey</h4>

                    <div dir="ltr">
                        <div id="surveyChart" class="apex-charts mt-3" data-colors="#0acf97,#727cf5,#ffbc00,#fa5c7c">
                        </div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    </div>


    <div class="row">
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Mengunjungi Konten</h4>
                    <a href="javascript:void(0);" class="btn btn-sm btn-light">Export <i
                            class="mdi mdi-download ms-1"></i></a>
                </div>

                <div class="card-body pt-0">

                    <div class="table-responsive">
                        <table class="table table-sm table-centered mb-0 font-14">
                            <thead class="table-light">
                                <tr>
                                    <th>Kontent</th>
                                    <th>Pengunjung</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-center fw-bold">Coming Soon</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center">
                    <h4 class="header-title">Paling Sering Mengunjungi</h4>
                    <a href="javascript:void(0);" class="btn btn-sm btn-light">Export <i
                            class="mdi mdi-download ms-1"></i></a>
                </div>

                <div class="card-body pt-0">

                    <div class="table-responsive">
                        <table class="table table-sm table-centered mb-0 font-14">
                            <thead class="table-light">
                                <tr>
                                    <th>Responden</th>
                                    <th>Jumlah Kunjungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2" class="text-center fw-bold">Coming Soon</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive-->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->


    </div>
    <!-- end row -->

</div>
<!-- container -->
@endsection

@section("js")
<script>
    var t = ["#727cf5", "#0acf97", "#fa5c7c", "#ffbc00"]
            var a = $("#sessions-overview").data("colors")
            var options = {
                chart: {
                    height: 450,
                    type: "bar"
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    curve: "smooth",
                    width: 4
                },
                series: [{
                        name: "Sangat Puas",
                        data: [
                        @foreach ($data[1] as $value)
                        {!! $value !!},
                        @endforeach
                    ],
                    },
                    {
                        name: "Puas",
                        data: [
                            @foreach ($data[2] as $value)
                            {!! $value !!},
                            @endforeach
                        ]
                    },
                    {
                        name: "Kurang Puas",
                        data: [
                            @foreach ($data[3] as $value)
                            {!! $value !!},
                            @endforeach
                        ]
                    },
                    {
                        name: "Tidak Puas",
                        data: [
                            @foreach ($data[4] as $value)
                            {!! $value !!},
                            @endforeach
                        ]
                    },
                ],
                zoom: {
                    enabled: 1
                },
                legend: {
                    show: 1
                },
                colors: t = a ? a.split(",") : t,
                xaxis: {
                    type: "string",
                    categories: [
                        @foreach ($category as $result)
                        "{!! $result !!}",
                        @endforeach
                    ],
                    tooltip: {
                        enabled: !1
                    },
                    axisBorder: {
                        show: 1
                    },
                    labels: {}
                },
                yaxis: {
                    labels: {
                        formatter: function (e) {
                            return e + " Orang"
                        },
                        offsetX: -15
                    }
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .45,
                        opacityTo: .05,
                        stops: [45, 100]
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#surveyChart"), options);

            chart.render();
</script>
@endsection
@section("plugins")
<!-- Charts js -->
<script src="assets/vendor/chart.js/chart.min.js"></script>
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
@endsection