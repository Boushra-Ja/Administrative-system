<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infection extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'number',
        'year',
    ];
}
