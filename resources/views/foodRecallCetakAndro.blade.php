@extends('layout/mainAndro')
@section('content')
    <table id="fixed-header-datatable" class="table table-bordered dt-responsive nowrap w-100 text-capitalize">
        <h4 class="m-2">Nama Balita : {{ $daftarBalita->namaBalita }}</h4>
        <h4 class="m-2">Petugas : {{ $daftarBalita->foodRecall->where('users_id', $uuid)->first()->penyuluh->name }}</h4>
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
            @foreach ($daftarBalita->foodRecall->groupBy('waktu') as $key => $data)
                <tr>
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
            @if ($subtotalEnergi >= 550)
                <td class="h5 text-success">{{ $subtotalEnergi }}</td>
                <td>
                    <h5>
                        <strong>
                            Kalori Cukup
                        </strong>
                    </h5>
                </td>
            @else
                <td class="h5 text-danger">{{ $subtotalEnergi }}</td>
                <td>
                    <h5>
                        <strong>
                            Kalori Kurang
                        </strong>
                    </h5>
                </td>
            @endif
            @php
                $totalEnergi = $subtotalEnergi + $totalEnergi;
            @endphp
            @endforeach
            <tr>
                <td class="text-end" colspan="4"><strong> Total</strong></td>
                <td>
                    <h5><strong>{{ $totalEnergi }}</strong></h5>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
