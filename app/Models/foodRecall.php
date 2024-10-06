<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class foodRecall extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    protected $hidden = [
        "id",
        "users_id",
        "daftar_balita_id",
        "created_at"
    ];


    public function daftarBalita(): HasOne
    {
        return $this->hasOne(daftarBalita::class, "id", "daftar_balita_id");
    }
    public function penyuluh(): HasOne
    {
        return $this->hasOne(User::class, "uuid", "users_id");
    }
}
