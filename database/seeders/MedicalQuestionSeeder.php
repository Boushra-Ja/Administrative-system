<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicalQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('medical_questions')->insert([
                    'question' => "اختلاطات أثناء الحمل",
                    'titel_id'=>"1",
                    'type'=>"0",
                ]);
         DB::table('medical_questions')->insert([
                             'question' => "هل تناولت عقاقير طبية أثناء الحمل",
                             'titel_id'=>"1",
                             'type'=>"1",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "مدة الحمل",
                             'titel_id'=>"1",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "نوع الولادة",
                             'titel_id'=>"1",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "مكان الولادة",
                             'titel_id'=>"1",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "المشرف على الولادة",
                             'titel_id'=>"1",
                             'type'=>"0",
                         ]);


         DB::table('medical_questions')->insert([
                             'question' => "تعرض الطفل الى اصابات في الرأس",
                             'titel_id'=>"2",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "تعرض الطفل لالتهابات شديدة",
                             'titel_id'=>"2",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "يعاني من مشاكل مرتبطة باللقاح",
                             'titel_id'=>"2",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "الفحوصات التي أجريت للطفل",
                             'titel_id'=>"2",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "هل يعاني من نوبات اختلاجية",
                             'titel_id'=>"2",
                             'type'=>"0",
                         ]);


         DB::table('medical_questions')->insert([
                             'question' => "تخطيط سمع و نوعه",
                             'titel_id'=>"3",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "فحص بصر و نوعه",
                             'titel_id'=>"3",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "فحوصات الدماغ و نوعها",
                             'titel_id'=>"3",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "التحاليل المخبرية",
                             'titel_id'=>"3",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "الأدوية السابقة",
                             'titel_id'=>"3",
                             'type'=>"0",
                         ]);


         DB::table('medical_questions')->insert([
                             'question' => "الرضاعة",
                             'titel_id'=>"4",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "التسنين",
                             'titel_id'=>"4",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "مضغ الطعام",
                             'titel_id'=>"4",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "المشي",
                             'titel_id'=>"4",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "الإشارة",
                             'titel_id'=>"4",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "المناعة",
                             'titel_id'=>"4",
                             'type'=>"0",
                         ]);
         DB::table('medical_questions')->insert([
                             'question' => "الكلمات الأولى",
                             'titel_id'=>"4",
                             'type'=>"0",
                         ]);


         DB::table('medical_questions')->insert([
                             'question' => "ملاحظات",
                             'titel_id'=>"5",
                             'type'=>"0",
                         ]);
    }
}
