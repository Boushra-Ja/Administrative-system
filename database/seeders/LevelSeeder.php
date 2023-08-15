<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('levels')->insert([
            'id'=>"1",
            'name' => "معهدي",
        ]);
        DB::table('levels')->insert([
            'id'=>"2",
            'name' => "جامعي",
        ]); DB::table('levels')->insert([
        'id'=>"3",
        'name' => "ثانوي",
    ]); DB::table('levels')->insert([
        'id'=>"4",
        'name' => "اعدادي",
    ]);

    }
}
