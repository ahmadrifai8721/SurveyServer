<?php

namespace App\Exports;

use App\Models\foodRecall;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class foodrecallExport implements FromQuery
{
    use Exportable;

    private $tanggal;

    public function tanggal(string $tanggal)
    {
        $this->tanggal = $tanggal;

        return $this;
    }
    public function query()
    {
        //
        return foodRecall::query()->where('tanggal', $this->tanggal);
    }
}
