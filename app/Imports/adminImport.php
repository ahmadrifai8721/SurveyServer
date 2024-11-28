<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class adminImport implements ToModel, WithStartRow
{

    // public $uuid = Str::uuid();

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new User([
            'name' => $row[1],
            'email' => $row[2],
            'password' => $row[3],
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
