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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">Responden</li>
                    </ol>
                </div>
                <h4 class="page-title">Daftar Responden</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Daftar Responden</h4>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="fixed-header-preview">
                            <table id="fixed-header-datatable"
                                class="table table-striped dt-responsive nowrap table-striped w-100 text-capitalize">
                                <thead>
                                    <tr>
                                        <th>nama</th>
                                        <th>tempat lahir</th>
                                        <th>tanggal lahir</th>
                                        <th>alamat</th>
                                        <th>tanggal registrasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($responden as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->tempatLahir }}</td>
                                        <td>{{ $item->tanggalLahir }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->created_at }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center fw-bold">Null</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>nama</th>
                                        <th>tempat lahir</th>
                                        <th>tanggal lahir</th>
                                        <th>alamat</th>
                                        <th>tanggal registrasi</th>
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
@section("plugins")
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