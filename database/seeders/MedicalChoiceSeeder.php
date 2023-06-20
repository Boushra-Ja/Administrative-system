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

        DB::table('medical_choices')->insert([
            'choice' => "نعم",
            'med_id'=>"4",
        ]);
        DB::table('medical_choices')->insert([
            'choice' => "لا",
            'med_id'=>"4",
        ]);

        DB::table('medical_choices')->insert([
            'choice' => "نعم",
            'med_id'=>"9",
        ]);
        DB::table('medical_choices')->insert([
            'choice' => "لا",
            'med_id'=>"9",
        ]);


        DB::table('medical_choices')->insert([
            'choice' => "نعم",
            'med_id'=>"10",
        ]);
        DB::table('medical_choices')->insert([
            'choice' => "لا",
            'med_id'=>"10",
        ]);

        DB::table('medical_choices')->insert([
            'choice' => "نعم",
            'med_id'=>"17",
        ]);
        DB::table('medical_choices')->insert([
            'choice' => "لا",
            'med_id'=>"17",
        ]);

        DB::table('medical_choices')->insert([
            'choice' => "نعم",
            'med_id'=>"20",
        ]);
        DB::table('medical_choices')->insert([
            'choice' => "لا",
            'med_id'=>"20",
        ]);
    }
}
