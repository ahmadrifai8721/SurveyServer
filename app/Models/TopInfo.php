<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopInfo extends Model
{
    use HasFactory;

    protected    $fillable = [
        'Images',
        'Keterangan',
    ];
}
