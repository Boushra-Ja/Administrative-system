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
            'titel_id' => "1",
            'type' => "0",
            'id' => 1
        ]);
        DB::table('medical_questions')->insert([
            'question' => "هل تعرضت الأم للأشعة",
            'titel_id' => "1",
            'type' => "1",
            'id' => 2
        ]);
        DB::table('medical_questions')->insert([
            'question' => "في حال كان الجواب نعم في أي شهر من الحمل؟",
            'titel_id' => "1",
            'type' => "0",
            'id' => 3
        ]);
        DB::table('medical_questions')->insert([
            'question' => "هل تناولت عقاقير طبية أثناء الحمل",
            'titel_id' => "1",
            'type' => "1",
            'id' => 4

        ]);
        DB::table('medical_questions')->insert([
            'question' => "مدة الحمل",
            'titel_id' => "1",
            'type' => "0",
            'id' => 5

        ]);
        DB::table('medical_questions')->insert([
            'question' => "نوع الولادة",
            'titel_id' => "1",
            'type' => "0",
            'id' => 6

        ]);
        DB::table('medical_questions')->insert([
            'question' => "مكان الولادة",
            'titel_id' => "1",
            'type' => "0",
            'id' => 7

        ]);
        DB::table('medical_questions')->insert([
            'question' => "المشرف على الولادة",
            'titel_id' => "1",
            'type' => "0",
            'id' => 8

        ]);
        DB::table('medical_questions')->insert([
            'question' => "هل ازرق لونه؟",
            'titel_id' => "1",
            'type' => "1",
            'id' => 9

        ]);
        DB::table('medical_questions')->insert([
            'question' => "هل احتاج الطفل إلى حاضنة",
            'titel_id' => "1",
            'type' => "1",
            'id' => 10

        ]);
        DB::table('medical_questions')->insert([
            'question' => "إن كان الجواب نعم اذكر المدة التي قضاها",
            'titel_id' => "1",
            'type' => "0",
            'id' => 11

        ]);

        DB::table('medical_questions')->insert([
            'question' => "السبب",
            'titel_id' => "1",
            'type' => "0",
            'id' => 12

        ]);
        DB::table('medical_questions')->insert([
            'question' => "التمو مكتمل أو غير مكتمل",
            'titel_id' => "1",
            'type' => "0",
            'id' => 13

        ]);
        DB::table('medical_questions')->insert([
            'question' => "هل أصيب باليرقان",
            'titel_id' => "1",
            'type' => "0",
            'id' => 14

        ]);
        DB::table('medical_questions')->insert([
            'question' => "العامل الريزوسي",
            'titel_id' => "1",
            'type' => "0",
            'id' => 15

        ]);
        DB::table('medical_questions')->insert([
            'question' => "أي مشاكل أخرى",
            'titel_id' => "1",
            'type' => "0",
            'id' => 16

        ]);

        DB::table('medical_questions')->insert([
            'question' => " هل تعرض الطفل الى اصابات في الرأس" ,
            'titel_id' => "2",
            'type' => "1",
            'id' => 17

        ]);
        DB::table('medical_questions')->insert([
            'question' => "تعرض الطفل لالتهابات شديدة",
            'titel_id' => "2",
            'type' => "0",
            'id' => 18

        ]);
        DB::table('medical_questions')->insert([
            'question' => "يعاني من مشاكل مرتبطة باللقاح",
            'titel_id' => "2",
            'type' => "0",
            'id' => 19

        ]);
        DB::table('medical_questions')->insert([
            'question' => 'هل قام بإجراء فحوصات طبية ',
            'titel_id' => "2",
            'type' => "1",
            'id' => 20

        ]);
        DB::table('medical_questions')->insert([
            'question' => "هل يعاني من نوبات اختلاجية",
            'titel_id' => "2",
            'type' => "0",
            'id' => 21

        ]);


        DB::table('medical_questions')->insert([
            'question' => "تخطيط سمع و نوعه",
            'titel_id' => "3",
            'type' => "0",
            'id' => 22

        ]);
        DB::table('medical_questions')->insert([
            'question' => "النتيجة",
            'titel_id' => "3",
            'type' => "0",
            'id' => 23

        ]);
        DB::table('medical_questions')->insert([
            'question' => "فحص بصر و نوعه",
            'titel_id' => "3",
            'type' => "0",
            'id' => 24

        ]);
        DB::table('medical_questions')->insert([
            'question' => "النتيجة",
            'titel_id' => "3",
            'type' => "0",
            'id' => 25

        ]);

        DB::table('medical_questions')->insert([
            'question' => "فحوصات الدماغ و نوعها",
            'titel_id' => "3",
            'type' => "0",
            'id' => 26

        ]);
        DB::table('medical_questions')->insert([
            'question' => "النتيجة",
            'titel_id' => "3",
            'type' => "0",
            'id' => 27

        ]);

        DB::table('medical_questions')->insert([
            'question' => "التحاليل المخبرية",
            'titel_id' => "3",
            'type' => "0",
            'id' => 28

        ]);
        DB::table('medical_questions')->insert([
            'question' => "الأدوية السابقة",
            'titel_id' => "3",
            'type' => "0",
            'id' => 29

        ]);
        DB::table('medical_questions')->insert([
            'question' => "الأدوية الحالية",
            'titel_id' => "3",
            'type' => "0",
            'id' => 30

        ]);
        DB::table('medical_questions')->insert([
            'question' => "اسم الطبيب الذي قام بإجراء الفحص الطبي للطفل",
            'titel_id' => "3",
            'type' => "0",
            'id' => 31

        ]);
        DB::table('medical_questions')->insert([
            'question' => "نتيجة الفحص كما يرويها الطبيب",
            'titel_id' => "3",
            'type' => "0",
            'id' => 32

        ]);
        ///////////

        DB::table('medical_questions')->insert([
            'question' => "الرضاعة",
            'titel_id' => "4",
            'type' => "0",
            'id' => 33

        ]);
        DB::table('medical_questions')->insert([
            'question' => "التسنين",
            'titel_id' => "4",
            'type' => "0",
            'id' => 34

        ]);
        DB::table('medical_questions')->insert([
            'question' => "مضغ الطعام",
            'titel_id' => "4",
            'type' => "0",
            'id' => 35

        ]);
        DB::table('medical_questions')->insert([
            'question' => "المشي",
            'titel_id' => "4",
            'type' => "0",
            'id' => 36

        ]);
        DB::table('medical_questions')->insert([
            'question' => "الإشارة",
            'titel_id' => "4",
            'type' => "0",
            'id' => 37
        ]);
        DB::table('medical_questions')->insert([
            'question' => "المناعة",
            'titel_id' => "4",
            'type' => "0",
            'id' => 38
        ]);
        DB::table('medical_questions')->insert([
            'question' => "الكلمات الأولى",
            'titel_id' => "4",
            'type' => "0",
            'id' => 39
        ]);

        DB::table('medical_questions')->insert([
            'question' => "متى اكتشف الولدان المشكلة",
            'titel_id' => "4",
            'type' => "0",
            'id' => 40

        ]);

        DB::table('medical_questions')->insert([
            'question' => "ملاحظات",
            'titel_id' => "5",
            'type' => "0",
            'id' => 41
        ]);

    }
}
