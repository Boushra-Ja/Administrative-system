<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'hours',
        'description',
        'title',
        'check',
        'user_id',
        'app_id',
         'notes',
         'start'
    ];

    public function bouns()
    {
        return $this->hasOne(Bouns::class);
    }

    public function portage_marks()
    {
        return $this->hasOne(PortageMark::class);
    }
    public function diff_marks()
    {
        return $this->hasOne(LearningDisabilityMark::class);
    }
    public function Intelligent_marks()
    {
        return $this->hasOne(IntelligentMark::class);
    }
}
