<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EductionalQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('eductional_questions')->insert([
            'question' => "هل يضبط عملية الاخراج",
            'titel_id'=>"6",
            'type'=>"0",
            'id'=>"1",
        ]);
        DB::table('eductional_questions')->insert([
            'question' => "هل هناك مشاكل سلوكية",
            'titel_id'=>"6",
            'type'=>"1",
            'id'=>"2",
        ]);
        DB::table('eductional_questions')->insert([
            'question' => "هل هناك مشاكل لغوية أو نطقية",
            'titel_id'=>"6",
            'type'=>"0",
            'id'=>"3",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "هل ناك مشاكل أخرى يعاني منها",
            'titel_id'=>"6",
            'type'=>"0",
            'id'=>"4",

        ]);


        DB::table('eductional_questions')->insert([
            'question' => "التواصل البصري",
            'titel_id'=>"7",
            'type'=>"0",
            'id'=>"5",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "التواصل القصدي",
            'titel_id'=>"7",
            'type'=>"0",
            'id'=>"6",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "التعابير الوجهية",
            'titel_id'=>"7",
            'type'=>"0",
            'id'=>"7",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "اللعب",
            'titel_id'=>"7",
            'type'=>"0",
            'id'=>"8",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "تفاعله مع الأخرين",
            'titel_id'=>"7",
            'type'=>"0",
            'id'=>"9",

        ]);


        DB::table('eductional_questions')->insert([
            'question' => "تناوله الطعام",
            'titel_id'=>"8",
            'type'=>"0",
            'id'=>"10",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "الشراب",
            'titel_id'=>"8",
            'type'=>"0",
            'id'=>"11",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "الاعتناء بالنظافة",
            'titel_id'=>"8",
            'type'=>"0",
            'id'=>"12",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "ارتداء الملابس",
            'titel_id'=>"8",
            'type'=>"0",
            'id'=>"13",

        ]);


        DB::table('eductional_questions')->insert([
            'question' => "ملاحظات",
            'titel_id'=>"9",
            'type'=>"0",
            'id'=>"14",

        ]);
    }
}
