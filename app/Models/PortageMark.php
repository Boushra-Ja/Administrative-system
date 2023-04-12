<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortageMark extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'Social_age',
        'Knowladge_age',
        'Connection_age',
        'Care_age',
        'Movement_age',
        'infection',
        'task_id'
    ];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

}
