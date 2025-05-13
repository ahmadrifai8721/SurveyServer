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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">APP</a></li>
                            <li class="breadcrumb-item active">Materi</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Daftar Materi</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- Button trigger modal -->
        <button type="button" class="mb-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahMateri">
            <i class="mdi mdi-account-plus-outline"></i> Buat Materi Baru
        </button>


        {{-- model Tambah materi --}}
        <div class="modal fade" id="tambahMateri" tabindex="-1" aria-labelledby="tambahMateriLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahMateriLabel">Buat Materi Baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('materi.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3 form-floating">
                                <select class="form-select select2 text-uppercase fw-bold" id="menu"
                                    aria-label="Pilih Menu" name="menu">
                                    <option value="" disabled selected>Pilih Menu</option>
                                    <option value="tb"> Tubercolosis </option>
                                    <option value="batra"> Pengobatan Tradisional </option>
                                    <option value="farmasi"> farmasi </option>
                                    <option value="gigi"> gigi </option>
                                    <option value="gizi"> gizi </option>
                                    <option value="imunisasi"> imunisasi </option>
                                    <option value="kb"> Keluarga Berencana </option>
                                    <option value="kesling"> Kesehatan Lingkungan </option>
                                    <option value="kia"> Kesehatan Ibu Dan Anak </option>
                                    <option value="krr"> Kesehatan Reproduksi Remaja </option>
                                    <option value="laboratorium"> laboratorium </option>
                                    <option value="lansia"> Lanjut Usia </option>
                                    <option value="promkes"> Promosi Kesehatan </option>
                                    <option value="ptm"> Penyakit Tidak Menular </option>
                                </select>
                                <label for="menu">Pilih Menu</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="cp" id="cp"
                                    placeholder="contact person" />
                                <label for="cp">contact person</label>
                            </div>


                            <div class="mb-3">
                                <label for="formFile" class="form-label">File Materi</label>
                                <input class="form-control" type="file" id="formFile" name="file_materi" accept=".pdf">
                            </div>
                            <div class="gap-2 d-grid ">
                                <button class="btn btn-primary" type="submit">Simpan</button>
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
                        <h4 class="header-title">Daftar Materi</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="fixed-header-preview">
                                <table id="fixed-header-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr class="text-capitalize">
                                            <th>Menu</th>
                                            <th>Materi</th>
                                            <th>CP</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($materi as $id => $item)
                                            <tr>
                                                <td>{{ $item->menu }}</td>
                                                <td><a href="#viewMateri-{{ $item->menu }}" data-bs-toggle="modal"
                                                        data-bs-target="#viewMateri-{{ $item->menu }}">{{ $item->materi }}</a>
                                                </td>
                                                <td>{{ $item->cp }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm" href="#editMateri-{{ $item->id }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editMateri-{{ $item->id }}">Edit</a>
                                                    <form action="{{ route('materi.destroy', $item->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- Modal View Materi -->
                                            <div class="modal fade" id="viewMateri-{{ $item->menu }}" tabindex="-1"
                                                aria-labelledby="viewMateri-{{ $item->menu }}Label" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="viewMateri-{{ $item->menu }}Label">Lihat Materi
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <iframe id="materiViewer" src="{{ url($item->materi) }}"
                                                                frameborder="0"
                                                                style="width: 100%; height: 500px;"></iframe>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- model Edit materi --}}
                                            <div class="modal fade" id="editMateri-{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="editMateri-{{ $item->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="editMateri-{{ $item->id }}Label">Edit
                                                                Materi</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('materi.update', $item->id) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @method('PUT')
                                                                @csrf

                                                                <div class="mb-3 form-floating">
                                                                    <select
                                                                        class="form-select select2 text-uppercase fw-bold"
                                                                        id="menu" aria-label="Pilih Menu"
                                                                        name="menu" aria-readonly="true">
                                                                        <option value="" disabled selected>Pilih Menu
                                                                        </option>
                                                                        <option value="tb" aria-readonly=""
                                                                            {{ $item->menu == 'tb' ? 'selected' : '' }}>
                                                                            Tubercolosis
                                                                        </option>
                                                                        <option value="batra" aria-readonly=""
                                                                            {{ $item->menu == 'batra' ? 'selected' : '' }}>
                                                                            Pengobatan
                                                                            Tradisional
                                                                        </option>
                                                                        <option value="farmasi" aria-readonly=""
                                                                            {{ $item->menu == 'farmasi' ? 'selected' : '' }}>
                                                                            farmasi </option>
                                                                        <option value="gigi" aria-readonly=""
                                                                            {{ $item->menu == 'gigi' ? 'selected' : '' }}>
                                                                            gigi </option>
                                                                        <option value="gizi" aria-readonly=""
                                                                            {{ $item->menu == 'gizi' ? 'selected' : '' }}>
                                                                            gizi </option>
                                                                        <option value="imunisasi" aria-readonly=""
                                                                            {{ $item->menu == 'imunisasi' ? 'selected' : '' }}>
                                                                            imunisasi
                                                                        </option>
                                                                        <option value="kb" aria-readonly=""
                                                                            {{ $item->menu == 'kb' ? 'selected' : '' }}>
                                                                            Keluarga Berencana
                                                                        </option>
                                                                        <option value="kesling" aria-readonly=""
                                                                            {{ $item->menu == 'kesling' ? 'selected' : '' }}>
                                                                            Kesehatan
                                                                            Lingkungan
                                                                        </option>
                                                                        <option value="kia" aria-readonly=""
                                                                            {{ $item->menu == 'kia' ? 'selected' : '' }}>
                                                                            Kesehatan Ibu Dan
                                                                            Anak
                                                                        </option>
                                                                        <option value="krr" aria-readonly=""
                                                                            {{ $item->menu == 'krr' ? 'selected' : '' }}>
                                                                            Kesehatan
                                                                            Reproduksi Remaja
                                                                        </option>
                                                                        <option value="laboratorium" aria-readonly=""
                                                                            {{ $item->menu == 'laboratorium' ? 'selected' : '' }}>
                                                                            laboratorium
                                                                        </option>
                                                                        <option value="lansia" aria-readonly=""
                                                                            {{ $item->menu == 'lansia' ? 'selected' : '' }}>
                                                                            Lanjut Usia
                                                                        </option>
                                                                        <option value="promkes" aria-readonly=""
                                                                            {{ $item->menu == 'promkes' ? 'selected' : '' }}>
                                                                            Promosi Kesehatan
                                                                        </option>
                                                                        <option value="ptm" aria-readonly=""
                                                                            {{ $item->menu == 'ptm' ? 'selected' : '' }}>
                                                                            Penyakit Tidak
                                                                            Menular
                                                                        </option>
                                                                    </select>
                                                                    <label for="menu">Pilih Menu</label>
                                                                </div>
                                                                <div class="mb-3 form-floating">
                                                                    <input type="text" class="form-control"
                                                                        name="cp" id="cp"
                                                                        placeholder="contact person" />
                                                                    <label for="cp">contact person</label>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="formFile" class="form-label">File
                                                                        Materi</label>
                                                                    <input class="form-control" type="file"
                                                                        id="formFile" name="file_materi" accept=".pdf">
                                                                </div>
                                                                <div class="gap-2 d-grid ">
                                                                    <button class="btn btn-primary"
                                                                        type="submit">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-capitalize">
                                            <th>Menu</th>
                                            <th>Materi</th>
                                            <th>cp</th>
                                            <th>Actions</th>
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
