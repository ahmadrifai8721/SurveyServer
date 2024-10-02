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
                            <li class="breadcrumb-item active">balita</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Daftar balita</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- Button trigger modal -->
        <form action="{{ route('clearBalita') }}" method="post">
            <button type="button" class="mb-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahbalita">
                <i class="mdi mdi-account-plus-outline"></i> Tambah Balita
            </button>
            <button type="button" class="mb-2 btn btn-secondary" data-bs-toggle="modal" data-bs-target="#Importbalita">
                <i class="mdi mdi-account-plus-outline"></i> Import From Excel
            </button>
            @csrf
            <button class="mb-2 btn btn-danger" type="submit">
                <i class="mdi mdi-trash"></i> Hapus Daftar Balita
            </button>
        </form>

        <!-- Modal tambah -->
        <div class="modal fade" id="tambahbalita" tabindex="-1" aria-labelledby="tambahbalitaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahbalitaLabel">Tambah Balita</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('daftarBalita.store') }}" method="post">

                            @csrf

                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" id="namaBalita" placeholder="Nama Lengkap"
                                    name="namaBalita">
                                <label for="namaBalita">Nama Balita</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" id="text" placeholder="text" name="namaIbu">
                                <label for="text">Nama Ibu</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <textarea class="form-control" id="alamat" placeholder="alamat" name="alamat"></textarea>
                                <label for="alamat">alamat</label>
                            </div>
                            <div class="gap-2 d-grid ">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Import -->
        <div class="modal fade" id="Importbalita" tabindex="-1" aria-labelledby="ImportbalitaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ImportbalitaLabel">Import Balita</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('daftarBalita.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            <a href="{{ url('/assets/tempImportBalita.xlsx') }}" class="mb-2 btn btn-secondary">
                                <i class="mdi mdi-microsoft-excel"></i> Download Template
                            </a>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Upload File</label>
                                <input class="form-control" type="file" id="formFile" name="excel">
                            </div>

                            <div class="gap-2 d-grid ">
                                <button class="btn btn-primary" type="submit">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Daftar balita</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="fixed-header-preview">
                                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr class="text-capitalize">
                                            <th>Nama balita</th>
                                            <th>Nama Ibu</th>
                                            <th>Alamat</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($balita as $item)
                                            {{-- @dd($item->email) --}}
                                            <tr>
                                                <td>{{ $item->namaBalita }}</td>
                                                <td>{{ $item->namaIbu }}</td>
                                                <td>{{ $item->alamat }}</td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center fw-bold">Null</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-capitalize">
                                            <th>Nama balita</th>
                                            <th>Nama Ibu</th>
                                            <th>Alamat</th>

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
