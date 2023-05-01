<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EductionalQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'type',
        'titel_id'

    ];
}
