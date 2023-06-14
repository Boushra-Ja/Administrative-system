<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EductionalChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('eductional_choices')->insert([
            'choice' => "يقضم أظافره",
            'edu_id'=>"4",
        ]);
        DB::table('eductional_choices')->insert([
            'choice' => "يمص أصابعه",
            'edu_id'=>"4",
        ]);
        DB::table('eductional_choices')->insert([
            'choice' => "عدوانية",
            'edu_id'=>"4",
        ]);
        DB::table('eductional_choices')->insert([
            'choice' => "بكاء و صراخ زائد",
            'edu_id'=>"4",
        ]);

        DB::table('eductional_choices')->insert([
            'choice' => "نعم",
            'edu_id'=>"1",
        ]);
        DB::table('eductional_choices')->insert([
            'choice' => "لا",
            'edu_id'=>"1",
        ]);
        //
        DB::table('eductional_choices')->insert([
            'choice' => "نعم",
            'edu_id'=>"2",
        ]);
        DB::table('eductional_choices')->insert([
            'choice' => "لا",
            'edu_id'=>"2",
        ]);
        ///
        DB::table('eductional_choices')->insert([
            'choice' => "نعم",
            'edu_id'=>"3",
        ]);
        DB::table('eductional_choices')->insert([
            'choice' => "لا",
            'edu_id'=>"3",
        ]);
        ///
        DB::table('eductional_choices')->insert([
            'choice' => "نعم",
            'edu_id'=>"5",
        ]);
        DB::table('eductional_choices')->insert([
            'choice' => "لا",
            'edu_id'=>"5",
        ]);
        ///
        DB::table('eductional_choices')->insert([
            'choice' => "نعم",
            'edu_id'=>"6",
        ]);
        DB::table('eductional_choices')->insert([
            'choice' => "لا",
            'edu_id'=>"6",
        ]);
    }
}
