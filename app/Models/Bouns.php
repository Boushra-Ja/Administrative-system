<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bouns extends Model
{
    use HasFactory;
    protected $fillable = [
        'points',
        'task_id',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
