@extends("layout/main")

@section("content")
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Kiss Bunda</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Survey List</a></li>
                        <li class="breadcrumb-item active">Hasil Surevy</li>
                    </ol>
                </div>
                <h4 class="page-title">Hasil Surevy</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="fixed-header-preview">
                            <table id="datatable-buttons"
                                class="table table-striped dt-responsive nowrap table-striped w-100">
                                <thead>
                                    <tr>
                                        <th>Responden</th>
                                        <th>Tingkat Kepuasan</th>
                                        <th>Kritik atau Saran</th>
                                        <th>Tanggal pengisian survey</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($survey as $item)
                                    <tr>
                                        <td>{{ $item->Respondents->name }}</td>
                                        <td>
                                            @switch($item->tingkatKepuasan)
                                            @case(1)
                                            <h2><span class="badge badge-success-lighten">SANGAT PUAH</span>
                                            </h2>
                                            @break

                                            @case(2)
                                            <h2><span class="badge badge-warning-lighten">PUAS</span>
                                            </h2>
                                            @break

                                            @case(3)
                                            <h2><span class="badge badge-info-lighten">CUKUP PUAS</span>
                                            </h2>
                                            @break

                                            @case(4)
                                            <h2><span class="badge badge-danger-lighten">KURANG PUAS</span>
                                            </h2>

                                            @break

                                            @default
                                            <h2><span class="badge badge-dark-lighten">TIDAK TERNILAI</span>
                                            </h2>

                                            @endswitch
                                        </td>
                                        <td>{{ $item->kritik }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">Belum Ada Data</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Responden</th>
                                        <th>Tingkat Kepuasan</th>
                                        <th>Kritik atau Saran</th>
                                        <th>Tanggal pengisian survey</th>
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
@endsection
@section("plugins")
<!-- Datatables js -->
<script src="{{ url("/") }}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url("/") }}/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ url("/") }}/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ url("/") }}/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="{{ url("/") }}/assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
<script src="{{ url("/") }}/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="{{ url("/") }}/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ url("/") }}/assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="{{ url("/") }}/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{ url("/") }}/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="{{ url("/") }}/assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{ url("/") }}/assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="{{ url("/") }}/assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

<!-- Datatable Demo Aapp js -->
<script src="{{ url("/") }}/assets/js/pages/demo.datatable-init.js"></script>
@endsection