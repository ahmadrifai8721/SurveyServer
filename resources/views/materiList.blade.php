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
                            <li class="breadcrumb-item active">Admin</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Daftar admin</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- Button trigger modal -->
        <button type="button" class="mb-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahAdmin">
            <i class="mdi mdi-account-plus-outline"></i> Buat Akun Baru
        </button>
        {{-- <button type="button" class="mb-2 btn btn-danger" data-bs-toggle="modal" data-bs-target="#daftarPosyandu">
            <i class="mdi mdi-hospital-marker"></i> Daftar Posyandu
        </button>

        <div class="modal fade" id="daftarPosyandu" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
            role="dialog" aria-labelledby="daftarPosyanduTitle" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen modal-dialog-scrollable modal-dialog-centered modal-sm"
                role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="daftarPosyanduTitle">
                            Daftar Posyandu
                        </h5>
                        <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('posyandu.store') }}" enctype="multipart/form-data" method="post"
                            class="col-md-3">

                            @csrf

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Upload Template</label>
                                <input class="form-control" type="file" id="formFile" name="posyandu">
                            </div>
                            <a href="{{ url('/assets/tempImportPosyandu.xlsx') }}" class="btn btn-secondary">Template Import
                                Posyandu</a>
                            <button class="btn btn-primary" type="submit">Import</button>
                        </form>
                        <table id="fixed-header-datatable" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr class="text-capitalize">
                                    <th>nama</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posyandu as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Data Posyandu Belum di Import</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="text-capitalize">
                                    <th>nama</th>
                                    <th>Alamat</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Kembali
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- model Tambah User --}}
        <div class="modal fade" id="tambahAdmin" tabindex="-1" aria-labelledby="tambahAdminLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahAdminLabel">Buat Akun Baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('Administrator.store') }}" method="post">

                            @csrf

                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" id="Addname" placeholder="Nama Lengkap"
                                    name="name">
                                <label for="name">Nama Lengkap</label>
                            </div>
                            {{-- <div class="mb-3 form-floating">
                                <select name="posyandu_id" id="Addposyandu" class="form-select select2">
                                    @forelse ($posyandu as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @empty
                                        <option value="null">Data Posyandu Belum Di Import</option>
                                    @endforelse
                                </select>
                                <label for="name">Posyandu</label>
                            </div> --}}
                            <div class="mb-3 form-floating">
                                <input type="email" class="form-control" id="Addemail" placeholder="Email"
                                    name="email">
                                <label for="email">Email address</label>
                            </div>
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" id="Addpassword" placeholder="Password"
                                    name="password">
                                <label for="password">Password</label>
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
                        <h4 class="header-title">Daftar admin</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="fixed-header-preview">
                                <table id="fixed-header-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr class="text-capitalize">
                                            <th>nama</th>
                                            <th>email</th>
                                            {{-- <th>posyandu</th> --}}
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($admin as $item)
                                            {{-- @dd($item->email) --}}
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                {{-- <td>{{ $item->posyandu_id == null ? 'Posyandu belum di pilih' : $item->posyandu->nama }} --}}
                                                </td>
                                                <td>
                                                    <form action="{{ route('Administrator.destroy', $item->uuid) }}"
                                                        method="post">

                                                        @csrf
                                                        @method('DELETE')

                                                        <a data-bs-toggle="modal" href="#userView-{{ $item->uuid }}">
                                                            <span class="badge badge-lg rounded-pill text-bg-primary">
                                                                <i class="mdi mdi-account"></i>
                                                            </span>
                                                        </a>
                                                        <a data-bs-toggle="modal" href="#userEdit-{{ $item->uuid }}">

                                                            <span class="badge badge-lg rounded-pill text-bg-warning">
                                                                <i class="mdi mdi-account-edit"></i>
                                                            </span>
                                                        </a>
                                                        <button class=" btn badge badge-lg rounded-pill text-bg-danger">
                                                            <i class="mdi mdi-account-remove"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            {{-- detail User --}}
                                            <div class="modal fade" id="userView-{{ $item->uuid }}" tabindex="-1"
                                                aria-labelledby="userView-{{ $item->uuid }}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="userView-{{ $item->uuid }}Label">
                                                                {{ $item->name }}
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3 form-floating">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $item->name }}" readonly>
                                                                <label for="name">Nama Lengkap</label>
                                                            </div>
                                                            {{-- <div class="mb-3 form-floating">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $item->posyandu_id == null ? 'Posyandu belum di pilih' : $item->posyandu->nama }}"
                                                                    readonly>
                                                                <label for="name">Posyandu</label>
                                                            </div> --}}
                                                            <div class="mb-3 form-floating">
                                                                <input type="text" class="form-control"
                                                                    value="{{ $item->email }}" readonly>
                                                                <label for="email">Email address</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- edit User --}}
                                            <div class="modal fade" id="userEdit-{{ $item->uuid }}" tabindex="-1"
                                                aria-labelledby="userEdit-{{ $item->uuid }}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="userEdit-{{ $item->uuid }}Label">Edit Akun
                                                                {{ $item->name }}</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('Administrator.update', $item->uuid) }}"
                                                                method="post">

                                                                @csrf
                                                                @method('PUT')

                                                                <div class="mb-3 form-floating">
                                                                    <input type="text" class="form-control"
                                                                        id="name" placeholder="Nama Lengkap"
                                                                        name="name" value="{{ $item->name }}">
                                                                    <label for="name">Nama Lengkap</label>
                                                                </div>
                                                                {{-- <div class="mb-3 form-floating">
                                                                    <select name="posyandu_id" id="posyandu"
                                                                        class="form-select">
                                                                        <option value="0"
                                                                            {{ $item->posyandu_id == null ? 'selected' : '' }}>
                                                                            Posyandu Belum Di Pilih</option>
                                                                        @forelse ($posyandu as $posyanduList)
                                                                            <option value="{{ $posyanduList->id }}"
                                                                                {{ $posyanduList->id == $item->posyandu_id ? 'selected' : '' }}>
                                                                                {{ $posyanduList->nama }}</option>
                                                                        @empty
                                                                            <option>Data Posyandu Belum Di Import</option>
                                                                        @endforelse
                                                                    </select>
                                                                    <label for="name">Posyandu</label>
                                                                </div> --}}
                                                                <div class="mb-3 form-floating">
                                                                    <input type="email" class="form-control"
                                                                        id="email" placeholder="Email" name="email"
                                                                        value="{{ $item->email }}">
                                                                    <label for="email">Email address</label>
                                                                </div>
                                                                <div class="mb-3 form-floating">
                                                                    <input type="password" class="form-control"
                                                                        id="password" placeholder="Password"
                                                                        name="password" value="{{ $item->password }}">
                                                                    <label for="password">Password</label>
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
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center fw-bold">Null</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-capitalize">
                                            <th>nama</th>
                                            <th>email</th>
                                            {{-- <th>posyandu</th> --}}
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
