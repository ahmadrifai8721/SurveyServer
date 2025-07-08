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
                            <li class="breadcrumb-item active">Top Info</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Daftar Top Info</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- Button trigger modal -->
        <button type="button" class="mb-2 btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahTopInfo">
            <i class="mdi mdi-account-plus-outline"></i> Buat Top Info Baru
        </button>


        {{-- model Tambah Top Info --}}
        <div class="modal fade" id="tambahTopInfo" tabindex="-1" aria-labelledby="tambahTopInfoLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahTopInfoLabel">Buat Top Info Baru</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('TopInfo.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Gambar</label>
                                <input class="form-control" type="file" id="image" name="Image" accept="image/*"
                                    onchange="previewImage(event)">
                                <div class="mt-2">
                                    <img id="imagePreview" src="#" alt="Preview Gambar"
                                        class="rounded shadow-sm img-fluid"
                                        style="display:none; max-width: 300px; height: auto;" />
                                </div>
                            </div>
                            <script>
                                function previewImage(event) {
                                    const input = event.target;
                                    const preview = document.getElementById('imagePreview');
                                    if (input.files && input.files[0]) {
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            preview.src = e.target.result;
                                            preview.style.display = 'block';
                                        }
                                        reader.readAsDataURL(input.files[0]);
                                    } else {
                                        preview.src = '#';
                                        preview.style.display = 'none';
                                    }
                                }
                            </script>
                            <div class="mb-3 form-floating">
                                <input type="text" class="form-control" name="Keterangan" id="Keterangan"
                                    placeholder="Keterangan" />
                                <label for="Keterangan">Keterangan</label>
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
                        <h4 class="header-title">Daftar Top Info</h4>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="fixed-header-preview">
                                <table id="fixed-header-datatable" class="table table-striped dt-responsive nowrap w-100">
                                    <thead>
                                        <tr class="text-capitalize">
                                            <th>Images</th>
                                            <th>Keterangan</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($TopInfo as $id => $item)
                                            <tr>
                                                <td><img src="{{ asset('storage/' . $item->Images) }}"
                                                        class="img-thumbnail ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                                        alt="Image" width="100"></td>

                                                <td>{{ $item->Keterangan }}</td>
                                                <td>
                                                    <a class="btn btn-primary btn-sm"
                                                        href="#editTopInfo-{{ $item->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#editTopInfo-{{ $item->id }}">Edit</a>
                                                    <form action="{{ route('TopInfo.destroy', $item->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            {{-- model Edit Top Info --}}
                                            <div class="modal fade" id="editTopInfo-{{ $item->id }}" tabindex="-1"
                                                aria-labelledby="editTopInfo-{{ $item->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="editTopInfo-{{ $item->id }}Label">Edit
                                                                Top Info</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('TopInfo.update', $item->id) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @method('PUT')
                                                                @csrf

                                                                <div class="mb-3">
                                                                    <label for="image" class="form-label">Upload
                                                                        Gambar</label>
                                                                    <input class="form-control" type="file"
                                                                        id="image" name="Image" accept="image/*"
                                                                        onchange="previewImage(event)">
                                                                    <div class="mt-2">
                                                                        <img id="imagePreview-{{ $item->id }}"
                                                                            src="{{ asset('storage/' . $item->Images) }}"
                                                                            alt="Preview Gambar"
                                                                            class="rounded shadow-sm img-fluid"
                                                                            style=" max-width: 300px; height: auto;" />
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                    function previewImage(event) {
                                                                        const input = event.target;
                                                                        const preview = document.getElementById('imagePreview-{{ $item->id }}');
                                                                        if (input.files && input.files[0]) {
                                                                            const reader = new FileReader();
                                                                            reader.onload = function(e) {
                                                                                preview.src = e.target.result;
                                                                                preview.style.display = 'block';
                                                                            }
                                                                            reader.readAsDataURL(input.files[0]);
                                                                        } else {
                                                                            preview.src = '#';
                                                                            preview.style.display = 'none';
                                                                        }
                                                                    }
                                                                </script>
                                                                <div class="mb-3 form-floating">
                                                                    <input type="text" class="form-control"
                                                                        name="Keterangan" id="Keterangan"
                                                                        placeholder="Keterangan"
                                                                        value="{{ $item->Keterangan }}" />
                                                                    <label for="Keterangan">Keterangan</label>
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
                                            <th>Images</th>
                                            <th>Keterangan</th>
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
