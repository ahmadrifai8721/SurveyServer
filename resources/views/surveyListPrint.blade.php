@extends('layout/main')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="m-0 breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Kiss Bunda</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                            <li class="breadcrumb-item active">Survey Report</li>
                        </ol>
                    </div>
                    <h4 class="page-title">{{ $pageTitle }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="my-2">

            <a href="#print" onclick="window.print();" class="btn btn-soft-primary d-print-none"><strong>Buat
                    laporan</strong></a>
        </div>

        <div class="content row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Survey Report</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="fixed-header-preview">
                                <table id="datatable-buttons"
                                    class="table table-striped dt-responsive nowrap w-100 text-capitalize">
                                    <thead style=" font-size: 0.5vw">
                                        <tr>
                                            <th style=" font-size: 0.5vw" class="text-center align-middle" rowspan="2">
                                                Tingkat Kepuasan</th>
                                            <th style=" font-size: 0.5vw" class="text-center align-middle" colspan="31">
                                                Tanggal</th>
                                            <th style=" font-size: 0.5vw" class="text-center align-middle" rowspan="2">
                                                Total</th>
                                        </tr>
                                        <tr>
                                            <th style=" font-size: 0.5vw">1</th>
                                            <th style=" font-size: 0.5vw">2</th>
                                            <th style=" font-size: 0.5vw">3</th>
                                            <th style=" font-size: 0.5vw">4</th>
                                            <th style=" font-size: 0.5vw">5</th>
                                            <th style=" font-size: 0.5vw">6</th>
                                            <th style=" font-size: 0.5vw">7</th>
                                            <th style=" font-size: 0.5vw">8</th>
                                            <th style=" font-size: 0.5vw">9</th>
                                            <th style=" font-size: 0.5vw">10</th>
                                            <th style=" font-size: 0.5vw">11</th>
                                            <th style=" font-size: 0.5vw">12</th>
                                            <th style=" font-size: 0.5vw">13</th>
                                            <th style=" font-size: 0.5vw">14</th>
                                            <th style=" font-size: 0.5vw">15</th>
                                            <th style=" font-size: 0.5vw">16</th>
                                            <th style=" font-size: 0.5vw">17</th>
                                            <th style=" font-size: 0.5vw">18</th>
                                            <th style=" font-size: 0.5vw">19</th>
                                            <th style=" font-size: 0.5vw">20</th>
                                            <th style=" font-size: 0.5vw">21</th>
                                            <th style=" font-size: 0.5vw">22</th>
                                            <th style=" font-size: 0.5vw">23</th>
                                            <th style=" font-size: 0.5vw">24</th>
                                            <th style=" font-size: 0.5vw">25</th>
                                            <th style=" font-size: 0.5vw">26</th>
                                            <th style=" font-size: 0.5vw">27</th>
                                            <th style=" font-size: 0.5vw">28</th>
                                            <th style=" font-size: 0.5vw">29</th>
                                            <th style=" font-size: 0.5vw">30</th>
                                            <th style=" font-size: 0.5vw">31</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                @switch($key)
                                                    @case(1)
                                                        <td><span class="badge badge-success-lighten">SANGAT PUAH</span>
                                                        </td>
                                                    @break

                                                    @case(2)
                                                        <td><span class="badge badge-warning-lighten">PUAS</span>
                                                        </td>
                                                    @break

                                                    @case(3)
                                                        <td><span class="badge badge-info-lighten">CUKUP PUAS</span>
                                                        </td>
                                                    @break

                                                    @case(4)
                                                        <td><span class="badge badge-danger-lighten">KURANG PUAS</span>
                                                        </td>
                                                    @break

                                                    @default
                                                        <td><span class="badge badge-dark-lighten">TIDAK TERNILAI</span>
                                                        </td>
                                                @endswitch
                                                @for ($i = 1; $i < 32; $i++)
                                                    @if ($item->has($i))
                                                        <td style=" font-size: 0.5vw">
                                                            {{ $item[$i]->count('tingkatKepuasan') }}
                                                        </td>
                                                    @else
                                                        <td style=" font-size: 0.5vw">0</td>
                                                    @endif
                                                @endfor
                                                <td style=" font-size: 0.5vw">{{ $item->flatten()->count() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style=" font-size: 0.5vw" class="text-center align-middle" rowspan="2">
                                                Tingkat Kepuasan</th>
                                            <th style=" font-size: 0.5vw" class="text-center align-middle" colspan="31">
                                                Tanggal</th>
                                            <th style=" font-size: 0.5vw" class="text-center align-middle" rowspan="2">
                                                Total</th>
                                        </tr>
                                        <tr>
                                            <th style=" font-size: 0.5vw">1</th>
                                            <th style=" font-size: 0.5vw">2</th>
                                            <th style=" font-size: 0.5vw">3</th>
                                            <th style=" font-size: 0.5vw">4</th>
                                            <th style=" font-size: 0.5vw">5</th>
                                            <th style=" font-size: 0.5vw">6</th>
                                            <th style=" font-size: 0.5vw">7</th>
                                            <th style=" font-size: 0.5vw">8</th>
                                            <th style=" font-size: 0.5vw">9</th>
                                            <th style=" font-size: 0.5vw">10</th>
                                            <th style=" font-size: 0.5vw">11</th>
                                            <th style=" font-size: 0.5vw">12</th>
                                            <th style=" font-size: 0.5vw">13</th>
                                            <th style=" font-size: 0.5vw">14</th>
                                            <th style=" font-size: 0.5vw">15</th>
                                            <th style=" font-size: 0.5vw">16</th>
                                            <th style=" font-size: 0.5vw">17</th>
                                            <th style=" font-size: 0.5vw">18</th>
                                            <th style=" font-size: 0.5vw">19</th>
                                            <th style=" font-size: 0.5vw">20</th>
                                            <th style=" font-size: 0.5vw">21</th>
                                            <th style=" font-size: 0.5vw">22</th>
                                            <th style=" font-size: 0.5vw">23</th>
                                            <th style=" font-size: 0.5vw">24</th>
                                            <th style=" font-size: 0.5vw">25</th>
                                            <th style=" font-size: 0.5vw">26</th>
                                            <th style=" font-size: 0.5vw">27</th>
                                            <th style=" font-size: 0.5vw">28</th>
                                            <th style=" font-size: 0.5vw">29</th>
                                            <th style=" font-size: 0.5vw">30</th>
                                            <th style=" font-size: 0.5vw">31</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div> <!-- end preview-->

                        </div> <!-- end tab-content-->
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->
    </div> <!-- container -->
    </div>
    </div>
@endsection

@section('plugins')
    <!-- Datatables js -->
    <script src="{{ url('/') }}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js">
    </script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ url('/') }}/assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

    <!-- Datatable Demo Aapp js -->
    <script src="{{ url('/') }}/assets/js/pages/demo.datatable-init.js"></script>
@endsection

</body>

</html>
