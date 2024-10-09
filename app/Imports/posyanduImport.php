<?php

namespace App\Imports;

use App\Models\posyandu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class posyanduImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new posyandu([
            //
            'nama' => $row[1],
            'alamat' => $row[2],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
