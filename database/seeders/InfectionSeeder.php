<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('infections')->insert([
             'name'=>"شديد جداً",
             'number' => 0 ,
             'year'=>date('Y'),
        ]);

        DB::table('infections')->insert([
            'name'=>"شديدً",
            'number' => 0 ,
            'year'=>date('Y'),
        ]);
        DB::table('infections')->insert([
            'name'=>"متوسط",
            'number' => 0 ,
            'year'=>date('Y'),
        ]);
        DB::table('infections')->insert([
            'name'=>"بسيط",
            'number' => 0 ,
            'year'=>date('Y'),
        ]);
        DB::table('infections')->insert([
            'name'=>"بسيط جداً",
            'number' => 0 ,
            'year'=>date('Y'),
        ]);
        DB::table('infections')->insert([
            'name'=>"طبيعي",
            'number' => 0 ,
            'year'=>date('Y'),
        ]);
    }

}
