<div>

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="m-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Kiss Bunda</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">User</a></li>
                        <li class="breadcrumb-item active">Food Recal Report</li>
                    </ol>
                </div>
                <h4 class="page-title">Food Recal Report</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <form action="{{ route('foodRecallGenerate') }}" method="post">
        @csrf
        <div class="my-2 row">
            <h5>Pilih tanggal</h5>
            <div class="col-3">
                <input type="date" name="Tanggal" id="Tanggal" class="form-control" wire:model='date'
                    wire:change='filterData()'>
            </div>
            <div class="col-3">
                <button class="btn btn-primary" type="submit"><i class=" ri-printer-fill"></i>
                    Cetak</button>
                <a class="btn btn-secondary" href="{{ route('foodRecallExport', $date) }}" wire:model='date'><i
                        class=" ri-download-cloud-2-fill"></i>
                    Export To Excel</a>
            </div>
        </div>
    </form>


    <div class="row">
        <div class="col-12 justify-normal align-content-center" wire:loading.delay.shortest wire:target="filterData">
            <style>
                .lds-ellipsis,
                .lds-ellipsis div {
                    box-sizing: border-box;
                }

                .lds-ellipsis {
                    display: inline-block;
                    position: relative;
                    width: 80px;
                    height: 80px;
                }

                .lds-ellipsis div {
                    position: absolute;
                    top: 33.33333px;
                    width: 13.33333px;
                    height: 13.33333px;
                    border-radius: 50%;
                    background: currentColor;
                    animation-timing-function: cubic-bezier(0, 1, 1, 0);
                }

                .lds-ellipsis div:nth-child(1) {
                    left: 8px;
                    animation: lds-ellipsis1 0.6s infinite;
                }

                .lds-ellipsis div:nth-child(2) {
                    left: 8px;
                    animation: lds-ellipsis2 0.6s infinite;
                }

                .lds-ellipsis div:nth-child(3) {
                    left: 32px;
                    animation: lds-ellipsis2 0.6s infinite;
                }

                .lds-ellipsis div:nth-child(4) {
                    left: 56px;
                    animation: lds-ellipsis3 0.6s infinite;
                }

                @keyframes lds-ellipsis1 {
                    0% {
                        transform: scale(0);
                    }

                    100% {
                        transform: scale(1);
                    }
                }

                @keyframes lds-ellipsis3 {
                    0% {
                        transform: scale(1);
                    }

                    100% {
                        transform: scale(0);
                    }
                }

                @keyframes lds-ellipsis2 {
                    0% {
                        transform: translate(0, 0);
                    }

                    100% {
                        transform: translate(24px, 0);
                    }
                }
            </style>
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Food Recal Report Date {{ $date }}</h4>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="fixed-header-preview">
                            <table id="fixed-header-datatable"
                                class="table table-striped dt-responsive nowrap w-100 text-capitalize">
                                <thead>
                                    <tr>
                                        <th>Nama Balita</th>
                                        <th>Petugas</th>
                                        <th>Tanggal Pelaksanaan</th>
                                        <th>Tanggal Input</th>
                                    </tr>
                                </thead>
                                <tbody wire:poll>
                                    @forelse ($foodRecall as $result)
                                        <tr>
                                            <td>{{ $result->daftarBalita->namaBalita }}</td>
                                            <td>{{ $result->penyuluh->name }}</td>
                                            <td>
                                                {!! '<strong>' . $result->waktu . '</strong> ' . '( ' . $result->created_at->diffForHumans() . ' )' !!}
                                            </td>
                                            <td>{{ $result->created_at }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">Data Masih Kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama Balita</th>
                                        <th>Petugas</th>
                                        <th>Tanggal Pelaksanan</th>
                                        <th>Tanggal Input</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div> <!-- end preview-->

                    </div> <!-- end tab-content-->
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- end row-->
</div>
