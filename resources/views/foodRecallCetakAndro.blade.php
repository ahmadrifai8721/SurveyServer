@extends('layout/mainAndro')
@section('content')
    <div class="container-fluid">
        <h4 class="m-2">Nama Balita : {{ $daftarBalita->namaBalita }}</h4>
        <h4 class="m-2">Petugas : {{ $daftarBalita->foodRecall->where('users_id', $uuid)->first()->penyuluh->name }}</h4>
        {{-- <h4 class="m-2">Tanggal : {{ $tanggal }}</h4> --}}
        <form action="{{ url()->current() }}" method="get" class="row">
            <input type="hidden" name="uuid" value="{{ $uuid }}">
            <div class="mb-3 form-floating col-md-3">
                <input type="date" class="form-control" id="floatingInput" placeholder="Masukan Tanggal" name="tanggal"
                    value="{{ $tanggal1 }}">
                <label for="floatingInput">Tanggal</label>
            </div>
            <div class=" col-md-3">
                <button type="submit" class="btn btn-lg btn-primary">Filter</button>
                <a href="{{ route('foodRecallCetakAndro', $daftarBalita->id) }}?uuid={{ $uuid }}"
                    class="btn btn-danger btn-lg">
                    Reset
                    Filter</a>
        </form>
    </div>
    <table id="fixed-header-datatable" class="table table-bordered dt-responsive nowrap w-100 text-capitalize">
        <thead>
            <tr>
                <th rowspan="3" class="text-center align-middle fw-bold">Waktu Makan</th>
                <th rowspan="3" class="text-center align-middle fw-bold">Nama Makanan</th>
                <th colspan="4" class="text-center align-middle fw-bold">Bahan Makanan</th>
            </tr>
            <tr>
                <th rowspan="2" class="text-center align-middle fw-bold">Jenis</th>
                <th colspan="2" class="text-center align-middle fw-bold">Banyak</th>
                <th rowspan="2" class="text-center align-middle fw-bold">Keterangan</th>
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
            @dump($daftarBalita->foodRecall->groupBy('tanggal'))
            @foreach ($tanggal ? $daftarBalita->foodRecall->where('tanggal', $tanggal)->groupBy('waktu') : $daftarBalita->foodRecall->groupBy('waktu') as $key => $data)
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
@endsection
