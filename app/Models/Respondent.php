<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Respondent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function Survey(): BelongsTo
    {
        return $this->belongsTo(Survey::class);
    }
}
