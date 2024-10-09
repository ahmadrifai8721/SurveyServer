<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class posyandu extends Model
{
    protected $guarded = ["id"];

    public function foodRecall(): HasOne
    {
        return $this->hasOne(User::class, "posyandu_id", "id");
    }
}
