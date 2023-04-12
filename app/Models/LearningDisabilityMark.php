<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningDisabilityMark extends Model
{
    use HasFactory;
    protected $fillable = [
        'arabic',
        'math',
        'math_level',
        'arabic_level',
        'infection',
        'task_id'
    ];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
