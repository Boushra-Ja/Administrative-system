<?php

namespace App\Http\Resources\Boshra;

use App\Http\Controllers\TestResaultController;
use App\Models\Child;
use App\Models\EductionalCondition;
use App\Models\EductionalQuestion;
use App\Models\MedicalCondition;
use App\Models\MedicalQuestion;
use App\Models\MemberFamily;
use App\Models\PersonalInformation;
use App\Models\PortageDimenssion;
use App\Models\TestResault;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{

    //  public  $child_id , $Recommendation  , $summary ;
    public $additional;

    public  function  compare($Age){

        $pp="";

        if($Age<=25)
            $pp=" شديد جدا ";

        if(25<$Age && $Age<=40)
            $pp="شديد ";

        if(40<$Age && $Age<=55)
            $pp=" متوسط ";

        if(55<$Age && $Age<=70)
            $pp=" بسيط ";

        if(70<$Age && $Age<=85)
            $pp="بسيط جدا ";

        if(85<$Age && $Age<=100)
            $pp=" طبيعي ";
        return $pp;
    }

     public  function  calculate_age($Age1,$ss){

         $quotient = floor($Age1/12); // حساب القسم الصحيح
         $remainder = $Age1 % 12; // حساب القسم العشري وتقريبه
         if($remainder==0)
             $age_= "العمر".$ss." للطفل ".$quotient." سنوات  ";
         else
             $age_= "العمر".$ss." للطفل ".$quotient." سنه  "."و".$remainder." شهور ";
        return $age_;

     }
    public function toArray(Request $request): array
    {
        $mother_name = '';
        $father_name = '';
        $birth_date = '';
        $father_age = 0;
        $father_cearer = '';
        $father_edu = '';
        $mother_age = 0;
        $mother_cearer = '';
        $mother_edu = '';
        $mother_birth  = 0;
        $relative_relation = '';
        $check_disease = '';
        $check_disability = '';
        $child_rank = 1;
        $sister = 0;
        $brother = 0;
        $disease = ' ';
        $family = '';
        $transf_party = '';

        $transf_party = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 10)->value('answer');

        $birth_date = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 4)->value('answer');

        $mother_name = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 15)->value('answer');

        $mother_age = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 16)->value('answer');


        $mother_edu = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 17)->value('answer');

        $mother_cearer = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 18)->value('answer');

        $father_name = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 19)->value('answer');

        $father_age = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 20)->value('answer');

        $father_edu = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 21)->value('answer');

        $father_cearer = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 22)->value('answer');

        $mother_birth = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 25)->value('answer');

        $relative_check = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 23)->value('answer');

        if ($relative_check == "نعم") {
            $relative_relation = 'وتوجد صلة قرابة بين الوالدين ';
        } else {
            $relative_relation = "ولا توجد صلة قرابة";
        }



        $check_disease = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 26)->value('answer');

        if ($check_disease == 'لا') {
            $check_disease = 'ولا يعاني الوالدين من أي مرض';
        } else {
            $check_disease = ' يعاني الوالدين من المرض';
        }

        $disease = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 27)->value('answer');

        $check_disability = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 28)->value('answer');

        if ($check_disability == 'لا') {
            $check_disability = 'ولا توجد حالة إعاقة في العائلة';
        } else {
            $check_disability = "حالة الإعاقة الموجودة هي " . PersonalInformation::where('child_id', $this->id)
                ->where('ques_id', 29)->value('answer');
        }

        $child_rank = PersonalInformation::where('child_id', $this->id)
            ->where('ques_id', 31)->value('answer');


        $brother = MemberFamily::where('child_id', $this->child_id)
            ->where('gender', 'ذكر')->count();

        $sister = MemberFamily::where('child_id', $this->child_id)
            ->where('gender', '!=', 'ذكر')->count();

        if ($sister == 0 && $brother == 0) {
            $family = ' ' . 'وليس له إخوة';
        } else {
            $family = 'وله من الإخوة ' . $brother . 'ذكر و ' . $sister . 'أنثى';
        }

        $referral_reason = ' تمت إحالة الطفل من قبل' . ' ' . $transf_party . ' ' . ' لإجراء القحص الطبي والتربوي وبيان الرأي في إمكانية دخوله للمدارس الدامجة';

        $family_info = ' يعيش الطفل مع والديه ، حيث يبلغ عمر الأب ' . $father_age . ' سنة وهو ' . $father_cearer . ' ، ومستواه التعليمي ' . $father_edu . ' ، '
            . ' والأم ' . $mother_cearer . ' تبلغ من العمر ' . $mother_age . '  سنة ومستواها التعليمي ' . $mother_edu . ' ، ' .
            ' وكان عمر الأم عند إنجاب الطفل' . ' ' . $mother_birth . ' سنة ، ' . $relative_relation . ' '
            . $check_disease . $disease . ' ، ' . $check_disability . ' ، ' . ' والطفل ترتيبه في الأسرة ' . $child_rank
            . $family . '.';


        $pregnancy = array(10);
        /////////الحالة السريرية للحمل
        $pregnancy[0] = 'استمر الحمل ' . ' ' .  MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 5)->value('answer') . ' أشهر';

        $pregnancy[1] = ' عانت الأم من ' . MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 1)->value('answer') . ' أثناء الحمل ';

        $c = MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 2)->value('answer');
        if ($c == "نعم") {
            $pregnancy[2] = ' تعرضت الأم للأشعة وكان ذلك في الشهر ' . MedicalCondition::where('child_id', $this->id)
                ->where('ques_id', 3)->value('answer');
        } else {
            $pregnancy[2] = ' لم تتعرض للأشعة ';
        }

        $c = MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 4)->value('answer');
        if ($c == "نعم") {
            $pregnancy[3] = ' لم تتناول الأدوية إلا بإشراف طبيب الحمل';
        } else {
            $pregnancy[3] = ' لم تتناول الأدوية';
        }

        $pregnancy[4] = ' وكانت الولادة ' . MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 6)->value('answer');

        $pregnancy[5] = ' وكان الطفل ' . MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 13)->value('answer') . ' النمو عند الولادة';


        $c = MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 9)->value('answer');
        if ($c == "نعم") {
            $pregnancy[6] = ' وازرق لونه';
        } else {
            $pregnancy[6] = ' ولم يزرق لونه';
        }

        $c = MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 10)->value('answer');
        if ($c == "نعم") {
            $pregnancy[7] = ' واحتاج الطفل إلى حاضنة لمدة ' . MedicalCondition::where('child_id', $this->id)
                ->where('ques_id', 11)->value('answer') . ' أشهر';
        } else {
            $pregnancy[7] = ' ولم يحتج الطفل إلى حاضنة';
        }

        $pregnancy[8] = ' وكان وزنه ضمن الحدود الطبيعية';
        $pregnancy_mother = $pregnancy[0] . '، ' . $pregnancy[1] .
            $pregnancy[2] . '، ' . $pregnancy[3]  . $pregnancy[4] . '، ' . $pregnancy[5]
            . $pregnancy[6] . '، ' . $pregnancy[7] . '.';

        /////تطور الطفل
        $child_dev = array(10);
        $child_dev[0] = 'بعد اكتمال الحمل والولادة' . $pregnancy[4] . ' وخلال الأشهر الأولى من عمر الطفل ';
        $c = MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 17)->value('answer');
        if ($c == "نعم") {
            $child_dev[1] = ' تعرض الطفل إلى إصابة في الرأس ';
        } else {
            $child_dev[1] = ' لم يتعرض الطفل لأي إصابة في الرأس ';
        }

        $c = MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 20)->value('answer');
        if ($c == "نعم") {
            $child_dev[2] = 'وقام بإجراء فحوصات طبية ';
        } else {
            $child_dev[2] = ' ولم يجري أي فحوصات طبية';
        }

        $child_dev[3] = 'استمرت الرضاعة ' . MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 33)->value('answer');

        $child_dev[4] = ' وظهرت الأسنان بعمر ' . MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 34)->value('answer');

        $child_dev[5] = ' ومشى بعمر ' . MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 36)->value('answer');

        $child_dev[6] = ' وبدأ الكلام بعمر ' . ' ' . MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 39)->value('answer') . '  ';
        $child_dev[7] = "وكان نموه السيكولوجي مقبولا";

        $child_info =  $child_dev[0] . $child_dev[1] . '،' . $child_dev[2] .
            $child_dev[3] . '،' . $child_dev[4] . $child_dev[5] . '،' . $child_dev[6] . $child_dev[7] . '.';


        ////////////////شكوى الأهل

        $problems = array(7);
        $c = EductionalCondition::where('child_id', $this->id)
            ->where('ques_id', '1')->value('answer');

        if ($c == 'نعم') {
            $problems[0] = 'مشاكل في عملية الإخراج';
        }
        $c = EductionalCondition::where('child_id', $this->id)
            ->where('ques_id', '2')->value('answer');

        if ($c == 'نعم') {
            $problems[1] = 'مشاكل في النوم';
        }
        $c = EductionalCondition::where('child_id', $this->id)
            ->where('ques_id', '3')->value('answer');

        if ($c == 'نعم') {
            $problems[2] = 'مشاكل نشاط زائد';
        }
        $c = EductionalCondition::where('child_id', $this->id)
            ->where('ques_id', '4')->value('answer');

        if ($c == 'نعم') {
            $problems[3] = 'مشاكل سلوكية';
        }

        $c = EductionalCondition::where('child_id', $this->id)
            ->where('ques_id', '5')->value('answer');

        if ($c == 'نعم') {
            $problems[4] = 'يعاني من نوبات اختلاجية';
        }
        $c = EductionalCondition::where('child_id', $this->id)
            ->where('ques_id', '6')->value('answer');

        if ($c == 'نعم') {
            $problems[5] = 'مشكلة في اللغة والنطق';
        }
        $problems[6] = EductionalCondition::where('child_id', $this->id)
            ->where('ques_id', '7')->value('answer');

        $prob = '';
        if (isset($problems[0])) {
            $prob .= ' - ' . $problems[0] . "\n";
        }
        if (isset($problems[1])) {
            $prob .= ' - ' . $problems[1] . "\n";
        }
        if (isset($problems[2])) {
            $prob .= ' - ' . $problems[2] . "\n";
        }
        if (isset($problems[3])) {
            $prob .= ' - ' . $problems[3] . "\n";
        }
        if (isset($problems[4])) {
            $prob .= ' - ' . $problems[4] . "\n";
        }
        if (isset($problems[5])) {
            $prob .= ' - ' . $problems[5] . "\n";
        }
        if (isset($problems[6])) {
            $prob .= ' - ' . $problems[6] ;
        }


        //////////////////
        $notes = 'لوحظ على الطفل أنه بحاجة للتقييم في شعبة ' . ' ' . EductionalCondition::where('child_id', $this->id)
            ->where('ques_id', 26)->value('answer');

        //////نتائج التقييم
        $doctor = MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 31)->value('answer');
        $res = MedicalCondition::where('child_id', $this->id)
            ->where('ques_id', 32)->value('answer');
        $m_res = 'بناءاً على فحص الدكتور/ة  ' . ' ' . $doctor . ' ' . ' اختصاصية نفسية تبين بأن لدى الطفل ' . $res;

        ///////
        $educ_res = 'تم إحالة الطفل لإجراء اختبار البورتج والتقييم غلى المجالات الخمسة(اجتماعي - معرفي - اتصالي - عناية - حركي) وكانت النتائج كما هو موضح في المخطط البياني والجدول التالي';

        ///////////////////////////////////////////////

        $age = Child::where('id', $this->id)->value('age');
        $ratio = TestResaultController::graph_test($this->id) ;
        /////////////////////

        $string = "";
        $ratio4 = array(0, 0, 0, 0);
        $ratio0="أي الطفل ";
        $know_ratio_1=" يحدد مستوى أداء الطفل على المهارات المعرفيه الحاصه بمرحله ماقبل المدرسه وفي المرحله الاساسيه الأولى مثل الاشاره الى الألوان وتسميه الصور ومطابقه الأشكال الهندسيه. ";
        $know_ratio_2=" في البعد المعرفي مقارنه بأداء الأطفال الذين هم في نفس العمر الزمني ";

        $social_ratio_1=" يحدد مستوى أداء الطفل على المهارات الاجتماعيه كالتفاعل مع الاخرين من أقارب وأصدقاء وكذلك حسن التصرف في المواقف الاجتماعيه التي يواجهها الطفل. ";
        $social_ratio_2=" في البعد الاجتماعي مقارنه بأداء الأطفال الذين هم في نفس العمر الزمني ";


        $montor_ratio_1=" يحدد مستوى أداء الطفل على المهارات الحركيه الكبيره مثل المشي والقفز والمهارات الحركيه الدقيقه كاستعمال المقص أو الهمل بالمعجون .";
        $montor_ratio_2=" في البعد الحركي مقارنه بأداء الأطفال الذين هم في نفس العمر الزمني ";


        $comm_ratio_1=" يحدد مستوى أداء الطفل في المهارات التواصليه من لغه استقباليه وتعبيريه .";
        $comm_ratio_2=" في البعد الاتصالي مقارنه بأداء الأطفال الذين هم في نفس العمر الزمني ";

        $care_ratio_1=" يحدد مستوى أداء الطفل على مهارات العنايه الذاتيه مثل تحمل الطفل للمسوؤليه واعتمادهعلى نفسه فس المأكل والملبس وقضاء حاجته الخاصه. ";
        $care_ratio_2=" في بعد العنايه الذاتيه مقارنه بأداء الأطفال الذين هم في نفس العمر الزمني ";

      ////الاجتماعي //
        $social_basal_age = TestResault::where('child_id', $this->child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الاجتماعي')->value('id'))->value('basal');

        $social_additional_age = TestResault::where('child_id', $this->child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الاجتماعي')->value('id'))->value('additional');

        /////الحركي///
        $montor_basal_age = TestResault::where('child_id', $this->child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الحركي')->value('id'))->value('basal');

        $montor_additional_age = TestResault::where('child_id', $this->child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الحركي')->value('id'))->value('additional');

/////الاتصالي///////
        $comm_basal_age = TestResault::where('child_id', $this->child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الاتصالي')->value('id'))->value('basal');

        $comm_additional_age = TestResault::where('child_id', $this->child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الاتصالي')->value('id'))->value('additional');

        ///////////////العنايه الذاتيه////
        $care_basal_age = TestResault::where('child_id', $this->child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'بعد العناية الذاتية')->value('id'))->value('basal');

        $care_additional_age = TestResault::where('child_id', $this->child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'بعد العناية الذاتية')->value('id'))->value('additional');

/////المعرفي////
        $know_basal_age = TestResault::where('child_id', $this->child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد المعرفي')->value('id'))->value('basal');

        $know_additional_age = TestResault::where('child_id', $this->child_id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد المعرفي')->value('id'))->value('additional');

        $social_ratio =intval(($social_basal_age + $social_additional_age) / $age) * 100;
        $care_ratio =intval(($care_basal_age + $care_additional_age) / $age) * 100;
        $comm_ratio =intval(($comm_basal_age + $comm_additional_age) / $age) * 100;
        $know_ratio =intval(($know_basal_age + $know_additional_age) / $age) * 100;
        $montor_ratio =intval(($montor_basal_age + $montor_additional_age) / $age) * 100;


        $social_str= $this->compare($social_basal_age);
        $care_str= $this->compare($care_basal_age);
        $comm_str= $this->compare($comm_basal_age);
        $know_str= $this->compare($know_basal_age);
        $montor_str= $this->compare($montor_basal_age);


        $social_a= $this->  calculate_age($social_basal_age,"الاجتماعي");

        $care_a= $this->  calculate_age($care_basal_age,"في العنايه الذاتيه");

        $comm_a= $this->  calculate_age($comm_basal_age,"الاتصالي");

        $know_a= $this->  calculate_age($know_basal_age,"المعرفي");

        $montor_a= $this->  calculate_age($montor_basal_age,"الحركي");


        $ratio4[0]= $social_ratio_1." "."".$social_a."نسبه الأداء"."(".$social_ratio."%)"."مستوى الأداء: ".$social_str.$ratio0.$social_str.$social_ratio_2;
        $ratio4[1]=$know_ratio_1." ".$know_a."نسبه الأداء"."(".$know_ratio."%)"."مستوى الأداء: ".$know_str.$ratio0.$know_str.$know_ratio_2;
        $ratio4[2]=$comm_ratio_1." ".$comm_a."نسبه الأداء"."(".$comm_ratio."%)"."مستوى الأداء: ".$comm_str.$ratio0.$comm_str.$comm_ratio_2;
        $ratio4[3]=$care_ratio_1." ".$care_a."نسبه الأداء"."(".$care_ratio."%)"."مستوى الأداء: ".$care_str.$ratio0.$care_str.$care_ratio_2;
        $ratio4[4]=$montor_ratio_1." ".$montor_a."نسبه الأداء"."(".$montor_ratio."%)"."مستوى الأداء: ".$montor_str.$ratio0.$montor_str.$montor_ratio_2;




        return [

            'name' => 'الاسم : ' . $this->name,
            'father' => 'اسم الأب : ' . $father_name,
            'mother' => 'اسم الأم : ' . $mother_name,
            'phone' => 'هاتف : ' . $this->phone_num,
            'test_date' =>  '',
            'birth_date' => 'تاريخ الولادة : ' . ' ' . $birth_date,
            't_age' => 'العمر الزمني للطفل : ' . $this->age,
            'type_disorder' => '',
            'referral_reason' => $referral_reason,
            'family_info' => $family_info,
            'pregnancy_mother' => $pregnancy_mother,
            'child_dev' => $child_info,
            'problems' => $prob,
            'positions'=>'' ,
            'notes' => $notes,
            'medical_resault' => $m_res,
            'educ_resault' => $educ_res,
            'new_social_ratio' => $ratio[0],
            'old_social_ratio' => $ratio[1],
            'new_montor_ratio' => $ratio[2],
            'old_montor_ratio' => $ratio[3],
            'new_care_ratio' => $ratio[4],
            'old_care_ratio' => $ratio[5],
            'new_comm_ratio' => $ratio[6],
            'old_comm_ratio' => $ratio[7],
            'new_know_ratio' => $ratio[8],
            'old_know_ratio' => $ratio[9],
            'social' => TestResaultController ::table($this->id , 2) ,
            'monotor' => TestResaultController ::table($this->id , 1) ,
            'care' => TestResaultController ::table($this->id , 3) ,
            'comm' => TestResaultController ::table($this->id , 4) ,
            'know' => TestResaultController ::table($this->id , 5) ,
            "العمر الاجتماعي"=>$ratio4[0],
            "العمر المعرفي"=>$ratio4[1],
            "العمر الاتصالي"=>$ratio4[2],
            "العمر في العنايه الذاتيه"=>$ratio4[3],
            "العمر الحركي"=>$ratio4[4],
            'الأخصائية الفسية' => 'آ.أميرة علي',
            ' المدير' => 'أكرم عادل شقالو'

        ];
    }

    function additional(array $data)
    {
        return parent::additional($data); // TODO: Change the autogenerated stub
    }

    public function getAdditional(): array
    {
        return $this->additional;
    }


    public function setAdditional($additional)
    {
        $this->additional = $additional;
    }
}
