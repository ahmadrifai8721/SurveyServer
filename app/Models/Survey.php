<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Survey extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function Respondents(): HasOne
    {
        return $this->hasOne(Respondent::class, "id", "respondent_id");
    }
}
