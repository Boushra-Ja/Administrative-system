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
            'type'=>'m'
        ]);

        DB::table('titels')->insert([
            'id'=>"2",
            'name' => "التاريخ الطبي للطفل",
            'type'=>'m'

        ]);

        DB::table('titels')->insert([
            'id'=>"3",
            'name' => "الفحوصات الطبية التي أجريت للطفل",
            'type'=>'m'

        ]);

        DB::table('titels')->insert([
            'id'=>"4",
            'name' => "تطور نمو الطفل",
            'type'=>'m'

        ]);

        DB::table('titels')->insert([
            'id'=>"5",
            'name' => "ملاحظات اضافية",
            'type'=>'m'

        ]);



        ////المجال التربوي

        DB::table('titels')->insert([
            'id'=>"6",
            'name' => "النمو السيكولوجي للطالب",
            'type'=>'e'

        ]);

        DB::table('titels')->insert([
            'id'=>"7",
            'name' => "النمو الاجتماعي و الانفعالي",
            'type'=>'e'

        ]);

        DB::table('titels')->insert([
            'id'=>"8",
            'name' => "الاستقلالية الذاتية للطفل",
            'type'=>'e'

        ]);

        DB::table('titels')->insert([
            'id'=>"9",
            'name' => "ملاحظات اضافية",
            'type'=>'e'

        ]);

        ////المعلومات الشخصية
        DB::table('titels')->insert([
            'id'=>"10",
            'name' => "معلومات عامة عن العائلة",
            'type'=>'p'

        ]);
        DB::table('titels')->insert([
            'id'=>"11",
            'name' => "معلومات عامة عن الطفل",
            'type'=>'p'

        ]);

        DB::table('titels')->insert([
            'id'=>"12",
            'name' => "في مشاركته في نشاطات العائلة",
            'type'=>'e'

        ]);
        DB::table('titels')->insert([
            'id'=>"13",
            'name' => 'المعززات المحتملة',
            'type'=>'e'

        ]);
        DB::table('titels')->insert([
            'id'=>"14",
            'name' => "التأهيل التربوي للطفل",
            'type'=>'e'

        ]);

        DB::table('titels')->insert([
            'id'=>"15",
            'name' =>"no title",
            'type'=>'e'

        ]);

    }
}
