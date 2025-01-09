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
                            <li class="breadcrumb-item active">Food Recal Report</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Food Recal Report</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="my-2">

            <a href="{{ route('foodRecall.create') }}" class="btn btn-soft-primary"><strong>Buat laporan</strong></a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Food Recal Report</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="fixed-header-preview">
                                <table id="datatable-buttons"
                                    class="table table-striped dt-responsive nowrap w-100 text-capitalize">
                                    <thead>
                                        <tr>
                                            <th>Nama Balita</th>
                                            <th>Petugas</th>
                                            <th>Tanggal Pelaksanaan</th>
                                            <th>Tanggal Input</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($foodRecall as $result)
                                            <tr>
                                                <td>{{ $result->daftarBalita->namaBalita }}</td>
                                                <td>{{ $result->penyuluh->name }} <br> (
                                                    {{ $result->penyuluh->posyandu ? $result->penyuluh->posyandu->nama : 'Posyandu Belum Dipilih' }}
                                                    )</td>
                                                <td>
                                                    {!! '<strong>' . $result->waktu . '</strong> ' . '<br>( ' . $result->tanggal . ' )' !!}
                                                </td>
                                                <td>{{ $result->created_at }}</td>
                                                <td>
                                                    <form action="{{ route('foodRecall.destroy', $result->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('foodRecallCetak', $result->daftarBalita->id) }}">
                                                            <span class="badge badge-info bg-info">Cetak</span>
                                                        </a>
                                                        <button type="submit" class="btn btn-link">
                                                            <span class="badge badge-danger bg-danger">Hapus Data</span>
                                                        </button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">Data Masih Kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Balita</th>
                                            <th>Petugas</th>
                                            <th>Tanggal Pelaksanan</th>
                                            <th>Tanggal Input</th>
                                            <th></th>
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
    <script src="assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

    <!-- Datatable Demo Aapp js -->
    <script src="assets/js/pages/demo.datatable-init.js"></script>
@endsection

</body>

</html>
