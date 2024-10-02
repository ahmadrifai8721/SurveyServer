<?php

namespace App\Imports;

use App\Models\daftarBalita;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class balitaImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new daftarBalita([
            //
            'namaBalita' => $row[1],
            'namaIbu' => $row[2],
            'alamat' => $row[3],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
