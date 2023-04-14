<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MedicalChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('medical_choices')->insert([
            'choice' => "نعم",
            'med_id'=>"2",
        ]);
        DB::table('medical_choices')->insert([
            'choice' => "لا",
            'med_id'=>"2",
        ]);
    }
}
