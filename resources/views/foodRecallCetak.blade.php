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
                        <div class="p-2 tab-pane show active" id="fixed-header-preview">
                            <table id="fixed-header-datatable"
                                class="table m-2 table-bordered dt-responsive nowrap w-100 text-capitalize">
                                <h4 class="m-2">Nama Balita : {{ $daftarBalita->namaBalita }}</h4>
                                <h4 class="m-2">Petugas : {{ auth()->User()->name }}</h4>
                                <thead>
                                    <tr>
                                        <th rowspan="3" class="text-center align-middle fw-bold">Waktu Makan</th>
                                        <th rowspan="3" class="text-center align-middle fw-bold">Nama Makanan</th>
                                        <th colspan="4" class="text-center align-middle fw-bold">Bahan Makanan</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2" class="text-center align-middle fw-bold">Jenis</th>
                                        <th colspan="2" class="text-center align-middle fw-bold">Banyak</th>
                                    </tr>
                                    <tr>
                                        <th>gram</th>
                                        <th>Kalori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalEnergi = 0;
                                    @endphp
                                    @foreach ($daftarBalita->foodRecall->groupBy('waktu') as $key => $data)
                                        <tr style="page-break-before: always;">
                                            {{-- {{ $data->count() + 1 }} --}}
                                            <td rowspan="{{ $data->count() + 1 }}">{{ $key }}</td>
                                            @php
                                                $subtotalEnergi = 0;
                                                $keyLast = '';
                                                $keyLast = $key;
                                            @endphp

                                            @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->namaMasakan }}</td>
                                            <td>{{ $item->jenis }}</td>
                                            <td>{{ $item->urt }}</td>
                                            @php
                                                $jenis = explode('(', $item->jenis);
                                                $jenis = $jenis[0];
                                                if (
                                                    App\Models\tableKomposisiPangan::where('kode', $jenis)->first() ==
                                                    null
                                                ) {
                                                    $energi = 0;
                                                } else {
                                                    $energi =
                                                        trim(
                                                            explode(
                                                                'kkal',
                                                                App\Models\tableKomposisiPangan::where(
                                                                    'kode',
                                                                    $jenis,
                                                                )->first()->energi,
                                                            )[0],
                                                        ) / 100;
                                                }

                                                if ($key == $keyLast) {
                                                    $subtotalEnergi = $subtotalEnergi + $item->urt * $energi;
                                                } else {
                                                    $subtotalEnergi = 0;
                                                    $subtotalEnergi = $subtotalEnergi + $item->urt * $energi;
                                                }
                                            @endphp
                                            <td>{{ $item->urt * $energi }}</td>
                                        </tr>
                                    @endforeach
                                    <td class="text-end" colspan="4"><strong> Subtotal</strong></td>
                                    <td class="h5">{{ $subtotalEnergi }}</td>

                                    @php
                                        $totalEnergi = $subtotalEnergi + $totalEnergi;
                                    @endphp
                                    @endforeach
                                    <tr>
                                        <td class="text-end" colspan="4"><strong> Total</strong></td>
                                        @if ($totalEnergi >= 550)
                                            <td class="h5 text-success">{{ $totalEnergi }}
                                                <p class="h5 text-succes">( Kalori Cukup )</p>
                                            </td>
                                        @else
                                            <td class="h5 text-danger">{{ $totalEnergi }}
                                                <p class="h5 text-succes">( Kalori Kurang )</p>
                                            </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                            {{-- <small class="d-none d-print-block">
                                # Konversi dari URT menjadi gram dilakukan oleh pewawancara
                                <br>
                                * Jika responden mengonsumsi makanan/minuman industri, sebutkan merknya
                            </small> --}}
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
