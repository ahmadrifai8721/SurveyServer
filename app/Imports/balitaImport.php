<?php

namespace App\Imports;

use App\Models\daftarBalita;
use Maatwebsite\Excel\Concerns\ToModel;

class balitaImport implements ToModel
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
}
