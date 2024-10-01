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
                            <li class="breadcrumb-item active">Food Recal Report | {{ $daftarBalita->namaBalita }} (
                                {{ $daftarBalita->namaIbu }} )</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Food Recal Report | {{ $daftarBalita->namaBalita }} (
                        {{ $daftarBalita->namaIbu }} )</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="header-title d-print-none">Food Recal Report | {{ $daftarBalita->namaBalita }} (
                                {{ $daftarBalita->namaIbu }} )</h4>
                            <div class="d-print-none ">
                                <a onclick="print()">
                                    <span class="btn btn-info">Cetak</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="fixed-header-preview">
                            <table id="fixed-header-datatable"
                                class="table table-bordered dt-responsive nowrap w-100 text-capitalize">
                                <h4 class="m-2">Nama Balita : {{ $daftarBalita->namaBalita }}</h4>
                                <thead>
                                    <tr>
                                        <th rowspan="3" class="text-center align-middle fw-bold">Waktu Makan</th>
                                        <th rowspan="3" class="text-center align-middle fw-bold">Nama Makanan</th>
                                        <th colspan="3" class="text-center align-middle fw-bold">Bahan Makanan</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2" class="text-center align-middle fw-bold">Jenis</th>
                                        <th colspan="2" class="text-center align-middle fw-bold">Banyak</th>
                                    </tr>
                                    <tr>
                                        <th>URT</th>
                                        <th>gram</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daftarBalita->foodRecall as $data)
                                        <tr>
                                            <td>{{ $data->waktu }}</td>
                                            <td>{{ $data->namaMasakan }}</td>
                                            <td>{{ $data->jenis }}</td>
                                            <td>{{ $data->urt }}</td>
                                            <td>{{ $data->gram }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <small class="d-none d-print-block">
                                # Konversi dari URT menjadi gram dilakukan oleh pewawancara
                                <br>
                                * Jika responden mengonsumsi makanan/minuman industri, sebutkan merknya
                            </small>
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
