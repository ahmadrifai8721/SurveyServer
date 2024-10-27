@extends('layout/mainAndro')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <table id="fixed-header-datatable" class="table table-striped dt-responsive nowrap w-100 text-capitalize">
            <thead>
                <tr>
                    <th>Nama Balita</th>
                    <th>Petugas</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($foodRecall as $result)
                    <tr>
                        <td>{{ $result->daftarBalita->namaBalita }}</td>
                        <td>{{ $result->penyuluh->name }}</td>
                        <td>
                            {!! '<strong>' .
                                $result->waktu .
                                '</strong> ' .
                                $result->created_at .
                                '( ' .
                                $result->created_at->diffForHumans() .
                                ' )' !!}
                        </td>
                        <td>
                            <a
                                href="{{ route('foodRecallCetakAndro', $result->daftarBalita->id) . '/?uuid=' . $result->penyuluh->uuid }}">
                                <span class="badge badge-info bg-info">Cetak</span>
                            </a>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Data Masih Kosong</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>
@endsection


</body>

</html>
