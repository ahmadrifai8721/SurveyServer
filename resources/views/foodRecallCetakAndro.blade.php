@extends('layout/mainAndro')
@section('content')
    <table id="fixed-header-datatable" class="table table-bordered dt-responsive nowrap w-100 text-capitalize">
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
            @foreach ($daftarBalita as $data)
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
@endsection
