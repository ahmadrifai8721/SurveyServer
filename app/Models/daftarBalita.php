<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class daftarBalita extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    protected $hidden = [
        "alamat"
    ];

    public function foodRecall(): HasMany
    {
        return $this->hasMany(foodRecall::class, "daftar_balita_id", "id");
    }
}
