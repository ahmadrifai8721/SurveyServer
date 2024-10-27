@extends('layout/mainAndro')
@section('content')
    <table id="fixed-header-datatable" class="table table-bordered dt-responsive nowrap w-100 text-capitalize">
        <h4 class="m-2">Nama Balita : {{ $daftarBalita->namaBalita }}</h4>
        <h4 class="m-2">Petugas : {{ $daftarBalita->foodRecall->where('users_id', $uuid)->first()->penyuluh->name }}</h4>
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
                <th>gram</th>
                <th>Kalori</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($daftarBalita->foodRecall->where('users_id', $uuid)->groupBy('waktu') as $key => $data)
                <tr>
                    {{-- {{ $data->count() + 1 }} --}}
                    <td rowspan="{{ $data->count() + 1 }}">{{ $key }}</td>

                    @foreach ($data as $item)
                <tr>
                    <td>{{ $item->namaMasakan }}</td>
                    <td>{{ $item->jenis }}</td>
                    <td>{{ $item->urt }}</td>
                    @php
                        $jenis = explode('(', $item->jenis);
                        $jenis = $jenis[0];
                        if (App\Models\tableKomposisiPangan::where('kode', $jenis)->first() == null) {
                            $energi = 0;
                        } else {
                            $energi =
                                trim(
                                    explode(
                                        'kkal',
                                        App\Models\tableKomposisiPangan::where('kode', $jenis)->first()->energi,
                                    )[0],
                                ) / 100;
                        }

                    @endphp
                    <td>{{ $item->urt * $energi }}</td>
                </tr>
            @endforeach
            </td>
            @endforeach
        </tbody>
    </table>
    <small class="d-none d-print-block">
        # Konversi dari URT menjadi gram dilakukan oleh pewawancara
        <br>
        * Jika responden mengonsumsi makanan/minuman industri, sebutkan merknya
    </small>
@endsection
