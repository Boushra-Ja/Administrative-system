<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;
    protected $fillable = [
        'child_id',
        'center_name',
        'diagnosis',
        'specialist',
        'qualification',
        'qualification_axes',
        'time'
    ];
}
