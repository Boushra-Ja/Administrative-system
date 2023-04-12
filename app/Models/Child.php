<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'infection',
        'section'
    ];

    public function members()
    {
        return $this->hasMany(FamilyMember::class , 'child_id');
    }
}
