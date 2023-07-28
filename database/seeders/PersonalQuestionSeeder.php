<?php

namespace Database\Seeders;

use App\Models\PersonalQuestion;
use Illuminate\Database\Seeder;

class PersonalQuestionSeeder extends Seeder
{

    public function run(): void
    {
        PersonalQuestion::create([
            'question' => ' اسم الطالب',
            'title_id' => 11,
            'type' => 0 ,
            'id' => 1
        ]);
        PersonalQuestion::create([
            'question' => 'رقم دراسة الحالة',
            'title_id' => 11,
            'type' => 0,
            'id' => 2


        ]);
        PersonalQuestion::create([
            'question' => ' تاريخ دراسة الحالة',
            'title_id' => 11,
            'type' => 0,
            'id' => 3

        ]);
        PersonalQuestion::create([
            'question' => ' تاريخ الميلاد',
            'title_id' => 11,
            'type' => 0 ,
            'id' => 4
        ]);
        PersonalQuestion::create([
            'question' => '  مكان الميلاد',
            'title_id' => 11,
            'type' => 0 ,
            'id' => 5
        ]);
        PersonalQuestion::create([
            'question' => ' الجنس',
            'title_id' => 11,
            'type' => 0,
            'id' => 6

        ]);
        PersonalQuestion::create([
            'question' => ' الجنسية',
            'title_id' => 11,
            'type' => 0,
            'id' => 7

        ]);
        PersonalQuestion::create([
            'question' => ' رقم الهاتف',
            'title_id' => 11,
            'type' => 0,
            'id' => 8

        ]);
        PersonalQuestion::create([
            'question' => ' العنوان',
            'title_id' => 11,
            'type' => 0,
            'id' => 9

        ]);
        PersonalQuestion::create([
            'question' => ' الجهة المحولة',
            'title_id' => 11,
            'type' => 0,
            'id' => 10


        ]);
        PersonalQuestion::create([
            'question' => ' تاريخ التحويل',
            'title_id' => 11,
            'type' => 0,
            'id' => 11

        ]);
        PersonalQuestion::create([
            'question' => ' تشخيص المحوّل',
            'title_id' => 11,
            'type' => 0,
            'id' => 12
        ]);

        PersonalQuestion::create([
            'question' => ' هاتف الجهة المحولة',
            'title_id' => 11,
            'type' => 0,
            'id' => 13

        ]);
        PersonalQuestion::create([
            'question' => ' ملخص المشكلة الحالية(نوعها وأعراضها)كما يرويها ولي الأمر',
            'title_id' => 11,
            'type' => 0,
            'id' => 14


        ]);

        PersonalQuestion::create([
            'question' => ' اسم الأم',
            'title_id' => 10,
            'type' => 0,
            'id' => 15


        ]);
        PersonalQuestion::create([
            'question' => ' عمر الأم',
            'title_id' => 10,
            'type' => 0,
            'id' => 16


        ]);
        PersonalQuestion::create([
            'question' => ' المستوى التعليمي للأم',
            'title_id' => 10,
            'type' => 0,
            'id' => 17


        ]);
        PersonalQuestion::create([
            'question' => ' عمل الأم ومكانها',
            'title_id' => 10,
            'type' => 0,
            'id' => 18


        ]);
        PersonalQuestion::create([
            'question' => ' اسم الأب',
            'title_id' => 10,
            'type' => 0,
            'id' => 19


        ]);
        PersonalQuestion::create([
            'question' => ' عمر الأب',
            'title_id' => 10,
            'type' => 0,
            'id' => 20


        ]);
        PersonalQuestion::create([
            'question' => ' المستوى التعليمي للأب',
            'title_id' => 10,
            'type' => 0,
            'id' => 21


        ]);
        PersonalQuestion::create([
            'question' => ' عمل الأب ومكانه',
            'title_id' => 10,
            'type' => 0,
            'id' => 22


        ]);
        PersonalQuestion::create([
            'question' => ' هل هناك صلة قرابة؟' ,
            'title_id' => 10,
            'type' => 1,
            'id' => 23


        ]);
        PersonalQuestion::create([
            'question' => ' ماهي صلة القرابة في حال وجودها؟',
            'title_id' => 10,
            'type' => 0,
            'id' => 24


        ]);
        PersonalQuestion::create([
            'question' => ' عمر الأم عند إنجاب الطفل',
            'title_id' => 10,
            'type' => 0,
            'id' => 25


        ]);

        PersonalQuestion::create([
            'question' => ' هل يعاني أحد الوالدين من الأمراض؟؟',
            'title_id' => 10,
            'type' => 1,
            'id' => 26


        ]);
      ;


        PersonalQuestion::create([
            'question' => ' إن كان الجواب نعم اذكر الأمراض',
            'title_id' => 10,
            'type' => 0,
            'id' => 27


        ]);
        PersonalQuestion::create([
            'question' => 'هل يوجد بين أقرباء والدي فرد/أفراد معاقين؟',
            'title_id' => 10,
            'type' => 1,
            'id' => 28


        ]);

        PersonalQuestion::create([
            'question' => 'ماهي الإعاقة؟',
            'title_id' => 10,
            'type' => 0,
            'id' => 29


        ]);


        PersonalQuestion::create([
            'question' => ' ما هو عدد إخوة الطفل',
            'title_id' => 10,
            'type' => 0,
            'id' => 30


        ]);
        PersonalQuestion::create([
            'question' => ' ترتيب الطفل في الأسرة',
            'title_id' => 10,
            'type' => 0,
            'id' => 31


        ]);

        PersonalQuestion::create([
            'question' => 'اكتب أسماء الأخوة وأعمارهم ومستوى تعليمهم الغير متزوجين',
            'title_id' => 10,
            'type' => 0,
            'id' => 32


        ]);

        PersonalQuestion::create([
            'question' => 'ملاحظات' ,
            'title_id' => 10,
            'type' => 0,
            'id' => 33


        ]);
        PersonalQuestion::create([
            'question' => 'هل يعيش الطفل مع والديه' ,
            'title_id' => 10,
            'type' => 1,
            'id' => 34


        ]);

    }
}
