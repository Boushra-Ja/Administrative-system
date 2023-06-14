<?php

namespace App\Http\Resources\Boshra;

use App\Models\EductionalCondition;
use App\Models\MedicalCondition;
use App\Models\MedicalQuestion;
use App\Models\MemberFamily;
use App\Models\PersonalInformation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{

  //  public  $child_id , $Recommendation  , $summary ;
  public $additional;

    public function toArray(Request $request): array
    {
        $mother_name = '' ; $father_name = '' ; $birth_date = '' ; $father_age = 0 ;
        $father_cearer = '' ; $father_edu = '' ; $mother_age = 0  ; $mother_cearer = ''; $mother_edu = '' ;
        $mother_birth  = 0 ; $relative_relation ='' ; $check_disease = '' ; $check_disability = '';
        $child_rank = 1 ; $sister = 0 ; $brother = 0 ; $disease = ' ' ; $family = '' ;

        $birth_date = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 4)->value('answer') ;

        $mother_name = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 15)->value('answer') ;

        $mother_age = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 16)->value('answer') ;


        $mother_edu = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 17)->value('answer') ;

        $mother_cearer = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 18)->value('answer') ;

        $father_name = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 19)->value('answer') ;

        $father_age = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 20)->value('answer') ;

        $father_edu = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 21)->value('answer') ;

        $father_cearer = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 22)->value('answer') ;

        $mother_birth = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 25)->value('answer') ;

        $relative_check = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 23)->value('answer') ;

        if($relative_check == "نعم")
        {
            $relative_relation = PersonalInformation::where('child_id' , $this->id)
            ->where('ques_id' , 24)->value('answer') ;

        }
        else{
            $relative_relation = "لا توجد صلة قرابة" ;

        }



        $check_disease = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 26)->value('answer') ;

        if($check_disease == 'لا')
        {
            $check_disease = 'لا يعاني الوالدين من أي مرض';
        }
        else{
            $check_disease = ' يعاني الوالدين من المرض';
        }

        $disease = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 27)->value('answer') ;

        $check_disability = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 28)->value('answer') ;

        if($check_disability == 'لا')
        {
            $check_disability = 'لا توجد حالة إعاقة في العائلة';
        }
        else{
            $check_disability = "حالة الإعاقة الموجودة هي " . PersonalInformation::where('child_id' , $this->id)
            ->where('ques_id' , 29)->value('answer');
        }

        $child_rank = PersonalInformation::where('child_id' , $this->id)
        ->where('ques_id' , 31)->value('answer') ;


        $brother = MemberFamily::where('child_id' ,$this->child_id)
        ->where('gender' ,'ذكر')->count() ;

        $sister = MemberFamily::where('child_id' ,$this->child_id)
        ->where('gender' ,'!=' ,'ذكر')->count() ;

        if($sister == 0 && $brother == 0)
        {
            $family = 'ليس له إخوة' ;
        }
        else{
            $family = 'له من الإخوة '.$brother .'ذكر و ' .$sister.'أنثى' ;
        }

        $referral_reason = 'تمت إحالة الطفل من قبل الصحة المدرسية تربية دمشق لإجراء القحص الطبي والتربوي وبيان الرأي في إمكانية دخوله للمدارس الدامجة.';

        $family_info = 'يعيش الطفل مع والديه ، حيث يبلغ عمر الأب '.$father_age.'سنة وهو '.$father_cearer.'، ومستواه التعليمي '.$father_edu.'، '
        .'والأم '.$mother_cearer.'تبلغ من العمر '.$mother_age.' سنة ومستواها التعليمي '.$mother_edu.'، '.
        ' وكان عمر الأم عند إنجاب الطفل'.$mother_birth.'سنة ، وتوجد صلة قرابة بين الوالدين ('.$relative_relation.' )'
        .$check_disease.$disease.' ، '.$check_disability.' ، '.'والطفل ترتيبه في الأسرة '.$child_rank
        .$family .'.';


        $pregnancy= array(10) ;
        /////////الحالة السريرية للحمل
        $pregnancy[0] = 'استمر الحمل ' . MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 5)->value('answer') . ' أشهر';

        $pregnancy[1] =' عانت الأم من ' . MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 1)->value('answer') . ' أثناء الحمل ';

        $c = MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 2)->value('answer') ;
        if($c == "نعم")
        {
            $pregnancy[2] = ' تعرضت الأم للأشعة وكان ذلك في الشهر ' . MedicalCondition::where('child_id' , $this->id)
            ->where('ques_id' , 3)->value('answer') ;

        }
        else{
            $pregnancy[2] = ' لم تتعرض للأشعة ';
        }

        $c = MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 4)->value('answer') ;
        if($c == "نعم")
        {
            $pregnancy[3] = ' لم تتناول الأدوية إلا بإشراف طبيب الحمل' ;

        }
        else{
            $pregnancy[3] = ' لم تتناول الأدوية';
        }

        $pregnancy[4] = ' وكانت الولادة ' . MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 6)->value('answer') ;

        $pregnancy[5] = ' وكان الطفل ' . MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 13)->value('answer') . ' النمو عند الولادة' ;


        $c = MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 9)->value('answer') ;
        if($c == "نعم")
        {
            $pregnancy[6] = ' وازرق لونه' ;

        }
        else{
            $pregnancy[6] = ' ولم يزرق لونه';
        }

        $c = MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 10)->value('answer') ;
        if($c == "نعم")
        {
            $pregnancy[7] = ' واحتاج الطفل إلى حاضنة لمدة ' .MedicalCondition::where('child_id' , $this->id)
            ->where('ques_id' , 11)->value('answer') .' أشهر'  ;

        }
        else{
            $pregnancy[7] = ' ولم يحتج الطفل إلى حاضنة';
        }

        $pregnancy[8] = ' وكان وزنه ضمن الحدود الطبيعية' ;
        $pregnancy_mother = $pregnancy[0] . '، ' .$pregnancy[1] .
        $pregnancy[2] . '، ' .$pregnancy[3]  .$pregnancy[4] . '، ' .$pregnancy[5]
        .$pregnancy[6] . '، ' .$pregnancy[7] .'.' ;

        /////تطور الطفل
        $child_dev= array(10) ;
        $child_dev[0] = 'بعد اكتمال الحمل والولادة' . $pregnancy[4] . ' وخلال الأشهر الأولى من عمر الطفل ' ;
        $c = MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 17)->value('answer') ;
        if($c == "نعم")
        {
            $child_dev[1] = ' تعرض الطفل إلى إصابة في الرأس ';
        }
        else{
            $child_dev[1] = ' لم يتعرض الطفل لأي إصابة في الرأس ';
        }

        $c = MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 20)->value('answer') ;
        if($c == "نعم")
        {
            $child_dev[2] = 'وقام بإجراء فحوصات طبية ';
        }
        else{
            $child_dev[2] = ' ولم يجري أي فحوصات طبية';
        }

        $child_dev[3] = 'استمرت الرضاعة ' . MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 33)->value('answer') ;

        $child_dev[4] = ' وظهرت الأسنان بعمر ' . MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 34)->value('answer') ;

        $child_dev[5] = ' ومشى بعمر ' . MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 36)->value('answer') ;

        $child_dev[6] = ' وبدأ الكلام بعمر ' . MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 39)->value('answer') ;
        $child_dev[7] = "وكان نموه السيكولوجي مقبولا" ;

        $child_info =  $child_dev[0].$child_dev[1] . '،' .$child_dev[2].
        $child_dev[3] . '،' .$child_dev[4]. $child_dev[5] . '،' .$child_dev[6].$child_dev[7] . '.' ;

        //////////////////
        $notes = 'لوحظ على الطفل أنه بحاجة للتقييم في شعبة ' .EductionalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 26)->value('answer') ;

        //////نتائج التقييم
        $doctor = MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 31)->value('answer');
        $res = MedicalCondition::where('child_id' , $this->id)
        ->where('ques_id' , 32)->value('answer');
        $m_res = 'بناءاً على فحص الدكتور/ة  ' . $doctor . ' اختصاصية نفسية تبين بأن لدى الطفل '. $res ;

        ///////
        $educ_res = 'تم إحالة الطفل لإجراء اختبار البورتج والتقييم غلى المجالات الخمسة(اجتماعي - معرفي - اتصالي - عناية - حركي) وكانت النتائج كما هو موضح في المخطط البياني والجدول التالي' ;

        return [

            'name' => 'الاسم : '.$this->name ,
            'phone' => 'هاتف : ' .$this->phone ,
            't_age' => 'العمر الزمني للطفل : '.$this->age ,
            'father' => 'اسم الأب : '.$father_name,
            'mother' => 'اسم الأم : '.$mother_name ,
            'birth_date' => $birth_date ,
            'referral_reason' => $referral_reason,
            'family_info' => $family_info,
            'pregnancy_mother' => $pregnancy_mother,
            'child_dev' => $child_info,
            'notes' => $notes,
            'medical_resault' => $m_res ,
            'educ_resault' => $educ_res,

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

/*
foreach ($this->personal_info as $val) {


            else  if($val['ques_id'] == 14)
            {
                $mother_name = $val['answer'] ;
            }
            else  if($val['ques_id'] == 15)
            {
                $mother_age = $val['answer'] ;
            }
            else  if($val['ques_id'] == 16)
            {
                $mother_edu = $val['answer'] ;
            }
            else  if($val['ques_id'] == 17)
            {
                $mother_cearer = $val['answer'] ;
            }
            else  if($val['ques_id'] == 18)
            {
                $father_name = $val['answer'] ;
            }
            else  if($val['ques_id'] == 19)
            {
                $father_age = $val['answer'] ;
            }
            else  if($val['ques_id'] == 20)
            {
                $father_edu = $val['answer'] ;
            }
            else  if($val['ques_id'] == 21)
            {
                $father_cearer = $val['answer'] ;
            }
            else  if($val['ques_id'] == 23)
            {
                $mother_birth = $val['answer'] ;
            }
            else  if($val['ques_id'] == 22)
            {
                $relative_relation = $val['answer'] ;
            }
            else  if($val['ques_id'] == 24)
            {
                if($val['answer'] == 'لا')
                {
                    $check_disease = 'لا يعاني الوالدين من أي مرض';
                }
                else{
                    $check_disease = ' يعاني الوالدين من المرض';
                }
            }
            else  if($val['ques_id'] == 25)
            {
                $disease = $val['answer'] ;
            }
            else  if($val['ques_id'] == 26)
            {
                if($val['answer'] == 'لا')
                {
                    $check_disability = 'لا توجد حالة إعاقة في العائلة';
                }
                else{
                    $check_disability = 'توجد حالة إعاقة في العائلة';
                }
            }
            else  if($val['ques_id'] == 30)
            {
                $child_rank = $val['answer'] ;
            }

        }

        $brother = MemberFamily::where('child_id' ,$this->child_id)
        ->where('gender' ,'ذكر')->count() ;

        $sister = MemberFamily::where('child_id' ,$this->child_id)
        ->where('gender' ,'!=' ,'ذكر')->count() ;

        if($sister == 0 && $brother == 0)
        {
            $family = 'ليس له إخوة' ;
        }
        else{
            $family = 'له من الإخوة '.$brother .'ذكر و ' .$sister.'أنثى' ;
        }
*/
