<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class EductionalQuestionSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('eductional_questions')->insert([
            'question' => "هل يضبط عملية الاخراج",
            'titel_id'=>"6",
            'type'=>"1",
            'id'=>"1",
        ]);
        DB::table('eductional_questions')->insert([
            'question' => 'هل هناك مشاكل في النوم',
            'titel_id'=>"6",
            'type'=>"1",
            'id'=>"2",
        ]);
        DB::table('eductional_questions')->insert([
            'question' => 'هل لدى الطفل نشاط زائد',
            'titel_id'=>"6",
            'type'=>"1",
            'id'=>"3",
        ]);
        DB::table('eductional_questions')->insert([
            'question' => "هل هناك مشاكل سلوكية",
            'titel_id'=>"6",
            'type'=>"1",
            'id'=>"4",
        ]);
        DB::table('eductional_questions')->insert([
            'question' => 'هل يعاني من نوبات اختلاجية',
            'titel_id'=>"6",
            'type'=>"1",
            'id'=>"5",
        ]);
        DB::table('eductional_questions')->insert([
            'question' => "هل هناك مشاكل لغوية أو نطقية",
            'titel_id'=>"6",
            'type'=>"1",
            'id'=>"6",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "هل هناك مشاكل أخرى يعاني منها",
            'titel_id'=>"6",
            'type'=>"0",
            'id'=>"7",

        ]);


        DB::table('eductional_questions')->insert([
            'question' => "التواصل البصري",
            'titel_id'=>"7",
            'type'=>"0",
            'id'=>"8",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "التواصل القصدي",
            'titel_id'=>"7",
            'type'=>"0",
            'id'=>"9",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "التعابير الوجهية",
            'titel_id'=>"7",
            'type'=>"0",
            'id'=>"10",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "اللعب",
            'titel_id'=>"7",
            'type'=>"0",
            'id'=>"11",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "تفاعله مع الأخرين",
            'titel_id'=>"7",
            'type'=>"0",
            'id'=>"12",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => 'علاقة الطفل مع أطفال آخرين في مثل مستواه العمري',
            'titel_id'=>"7",
            'type'=>"0",
            'id'=>"13",

        ]);


        DB::table('eductional_questions')->insert([
            'question' => "تناوله الطعام",
            'titel_id'=>"8",
            'type'=>"0",
            'id'=>"14",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "الشراب",
            'titel_id'=>"8",
            'type'=>"0",
            'id'=>"15",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "الاعتناء بالنظافة",
            'titel_id'=>"8",
            'type'=>"0",
            'id'=>"16",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "ارتداء الملابس",
            'titel_id'=>"8",
            'type'=>"0",
            'id'=>"17",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "علاقته مع والديه",
            'titel_id'=>"12",
            'type'=>"0",
            'id'=>"18",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "علاقة الطفل مع إخوته",
            'titel_id'=>"12",
            'type'=>"0",
            'id'=>"19",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "زيارات مع العائلة",
            'titel_id'=>"12",
            'type'=>"0",
            'id'=>"20",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "مشاهدة التلفاز",
            'titel_id'=>"12",
            'type'=>"0",
            'id'=>"21",

        ]);

        DB::table('eductional_questions')->insert([
            'question' => "تفاعله مع الموسيقى والاحتفالات",
            'titel_id'=>"12",
            'type'=>"0",
            'id'=>"22",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "التعامل مع النقود",
            'titel_id'=>"12",
            'type'=>"0",
            'id'=>"23",

        ]);


        DB::table('eductional_questions')->insert([
            'question' => "غذائية",
            'titel_id'=>"13",
            'type'=>"0",
            'id'=>"24",

        ]);

        DB::table('eductional_questions')->insert([
            'question' => "مادية",
            'titel_id'=>"13",
            'type'=>"0",
            'id'=>"25",

        ]);

        DB::table('eductional_questions')->insert([
            'question' => "اجتماعية",
            'titel_id'=>"13",
            'type'=>"0",
            'id'=>"26",

        ]);

        DB::table('eductional_questions')->insert([
            'question' => "نشاطية",
            'titel_id'=>"13",
            'type'=>"0",
            'id'=>"27",

        ]);

        DB::table('eductional_questions')->insert([
            'question' => "رمزية",
            'titel_id'=>"13",
            'type'=>"0",
            'id'=>"28",

        ]);


        DB::table('eductional_questions')->insert([
            'question' => "متى اكتشف الوالدان لأول مرة أن حالة ابنهم غير طبيعية وكيف تم ذلك",
            'titel_id'=>"15",
            'type'=>"0",
            'id'=>"29",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "ملاحظات الفاحص",
            'titel_id'=>"15",
            'type'=>"0",
            'id'=>"30",

        ]);
        DB::table('eductional_questions')->insert([
            'question' => "وصف المشكلة كما يراها ولي الأمر",
            'titel_id'=>"15",
            'type'=>"0",
            'id'=>"31",

        ]);
    }
}
