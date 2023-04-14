<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TitelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('titels')->insert([
            'id'=>"1",
            'name' => "التاريخ الطبي و النفسي للأم",
        ]);

        DB::table('titels')->insert([
            'id'=>"2",
            'name' => "التاريخ الطبي للطفل",
        ]);

        DB::table('titels')->insert([
            'id'=>"3",
            'name' => "الفحوصات الطبية التي أجريت للطفل",
        ]);

        DB::table('titels')->insert([
            'id'=>"4",
            'name' => "تطور نمو الطفل",
        ]);

        DB::table('titels')->insert([
            'id'=>"5",
            'name' => "ملاحظات اضافية",
        ]);



        ////المجال التربوي

        DB::table('titels')->insert([
            'id'=>"6",
            'name' => "النمو السيكولوجي للطالب",
        ]);

        DB::table('titels')->insert([
            'id'=>"7",
            'name' => "النمو الاجتماعي و الانفعالي",
        ]);

        DB::table('titels')->insert([
            'id'=>"8",
            'name' => "الاستقلالية الذاتية للطفل",
        ]);

        DB::table('titels')->insert([
            'id'=>"9",
            'name' => "ملاحظات اضافية",
        ]);


    }
}
