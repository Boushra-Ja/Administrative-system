<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\PersonalInformation;
use App\Http\Requests\StorePersonalInformationRequest;
use App\Http\Requests\UpdatePersonalInformationRequest;
use App\Http\Resources\Boshra\PersonalInfoResourse;
use App\Models\Child;
use App\Models\MemberFamily;
use Carbon\Carbon;


class PersonalInformationController extends BaseController
{

    public function validationInput($request)  {

        $messages = array();  $k = 0;
        $num_sister = 0;
        $birth_date = null;
        $status_date = null;
        $order = 0;
        $trans_date = null ;
        $b1 = false ;$b2 = false;$b3 = false ;
        $b4 = false;$b5 = false ;$b6 = false;
        $b7 = false ;$b8 = false;
        $b9 = false ;$b10 = false;
        $b11 = false ;$b12 = false;
        $b13 = false ;$b14 = false;
        $b15 = false ;$b16 = false; $b17 = false;
        $personal_info = $request->child_info;
            foreach ($personal_info as $item) {

                if ($item['ques_id'] == 4) {
                    $b1 = true ;
                }
                if ($item['ques_id'] == 3) {
                    $b2 = true ;
                }
                if ($item['ques_id'] == 11)
                {
                    $b3 = true ;
                }

                if ($item['ques_id'] == 16) {
                    $b4 = true ;
                }

                if ($item['ques_id'] == 20){
                    $b5 = true ;
                }
                if ($item['ques_id'] == 25){
                    $b6 = true ;
                }

                if ($item['ques_id'] == 30){
                    $b7 = true ;
                }
                if ($item['ques_id'] == 31){
                    $b8 = true ;
                }
                if ($item['ques_id'] == 10){
                    $b9 = true ;
                }
                if ($item['ques_id'] == 34){
                    $b10 = true ;
                }
                if ($item['ques_id'] == 17){
                    $b11 = true ;
                }
                if ($item['ques_id'] == 18){
                    $b12 = true ;
                }
                if ($item['ques_id'] == 21){
                    $b13 = true ;
                }
                if ($item['ques_id'] == 22){
                    $b14 = true ;
                }
                if ($item['ques_id'] == 23){
                    $b15 = true ;
                }
                if ($item['ques_id'] == 26){
                    $b16 = true ;
                }
                if ($item['ques_id'] == 28){
                    $b17 = true ;
                }
            }
            if($b1 == true && $b2 == true &&  $b3 == true && $b4 == true
            && $b5 == true && $b6 == true && $b9 == true && $b10 == true
            && $b11 == true && $b12 == true && $b13 == true && $b14 == true
            && $b15 == true && $b16 == true && $b17 == true)
            {
                foreach ($personal_info as $item) {

                    if ($item['ques_id'] == 4) {
                        $birth_date = $item['answer'];
                        if (strtotime($item['answer']) > time()) {
                            $messages[$k] = 'لا يمكن أن يكون تاريخ الميلاد أكبر من تاريخ اليوم';
                            $k++;
                        }
                    }
                    if ($item['ques_id'] == 3) {
                        $status_date = $item['answer'];

                        if (strtotime($item['answer']) > time()) {
                            $messages[$k] = 'لا يمكن أن يكون تاريخ دراسة الحالة أكبر من التاريخ الحالي';
                            $k++;
                        }

                    }

                    if ($item['ques_id'] == 11) {
                        $trans_date = $item['answer'] ;
                        if (strtotime($item['answer']) > time()) {
                            $messages[$k] = 'لا يمكن أن يتجاوز تاريخ التحويل التاريخ الحالي';
                            $k++;
                        }
                    }
                    if ($item['ques_id'] == 16) {
                        if (intval($item['answer']) < 15) {
                            $messages[$k] = 'لا يمكن أن يكون عمر الأم أصغر من 15 سنة';
                            $k++;
                        }
                    }

                    if ($item['ques_id'] == 20) {
                        if (intval($item['answer'] )< 20) {
                            $messages[$k] = 'لا يمكن أن يكون عمر الأب أصغر من 20 سنة';
                            $k++;
                        }
                    }
                    if ($item['ques_id'] == 25) {
                        if (intval($item['answer']) < 16) {
                            $messages[$k] = 'عمر الأم عند إنجاب الطفل غير متناسب مع بقية المعلومات';
                            $k++;
                        }
                    }
                    if ($item['ques_id'] == 30) {
                        $num_sister = intval($item['answer']);
                    }
                    if ($item['ques_id'] == 31) {
                        $order = intval($item['answer']);
                    }
                }
                if ($order < 1 || $order > $num_sister) {
                    $messages[$k] = 'ترتيب الطفل في الأسرة غير صحيح';
                    $k++;
                }

                $status_date = Carbon::createFromFormat('d/m/Y', $status_date);
                $birth_date = Carbon::createFromFormat('d/m/Y', $birth_date);
                $trans_date = Carbon::createFromFormat('d/m/Y', $trans_date);

                if ($status_date->lt($birth_date)) {
                    $messages[$k] = 'تاريخ دراسة الحالة لا يمكن أن يسبق تاريخ ميلاد الطفل';
                    $k++;
                }
                if ($trans_date->lt($birth_date)) {
                    $messages[$k] = 'تاريخ التحويل لا يمكن أن يسبق تاريخ ميلاد الطفل';
                    $k++;
                }

            }

            else{

                if($b1 == false)
                {
                    $messages[$k] = 'تاريخ الميلاد مطلوب';
                    $k++;
                }
                if($b2 == false)
                {
                    $messages[$k] = 'تاريخ دراسة الحالة مطلوب';
                    $k++;
                }
                if($b3 == false)
                {
                    $messages[$k] = 'تاريخ التحويل مطلوب';
                    $k++;
                }
                if($b4 == false)
                {
                    $messages[$k] = 'عمر الأم مطلوب';
                    $k++;
                }
                if($b5 == false)
                {
                    $messages[$k] = 'عمر الأب مطلوب';
                    $k++;
                }
                if($b6 == false)
                {
                    $messages[$k] = 'عمر الأم عند إنجاب الطفل مطلوب';
                    $k++;
                }
                if($b7 == false)
                {
                    $messages[$k] = 'عدد الإخوة مطلوب';
                    $k++;
                }
                if($b8 == false)
                {
                    $messages[$k] = 'ترتيب الطفل في الأسرة مطلوب';
                    $k++;
                }
                if($b9 == false)
                {
                    $messages[$k] = 'حقل الجهة المحولة مطلوب';
                    $k++;
                }
                if($b10 == false)
                {
                    $messages[$k] = 'هل يعيش الطفل مع والديه؟؟';
                    $k++;
                }
                if($b11 == false)
                {
                    $messages[$k] = 'الرجاء ادخال المستوى التعليمي للأم';
                    $k++;
                }
                if($b12 == false)
                {
                    $messages[$k] = 'الرجاء ادخال عمل الأم';
                    $k++;
                }
                if($b13 == false)
                {
                    $messages[$k] = 'الرجاء ادخال المستوى التعليمي للأب';
                    $k++;
                }
                if($b14 == false)
                {
                    $messages[$k] = 'الرجاء ادخال عمل الأب';
                    $k++;
                }
                if($b15 == false)
                {
                    $messages[$k] = 'هل يوجد صلة قرابة؟؟';
                    $k++;
                }
                if($b16 == false)
                {
                    $messages[$k] = ' هل يعاني أحد الوالدين من الأمراض؟؟';
                    $k++;
                }
                if($b17 == false)
                {
                    $messages[$k] = 'هل يوجد حالة اعاقة في العائلة؟';
                    $k++;
                }

            }
            return $messages ;
    }

    public function store(StorePersonalInformationRequest $request)
    {
        $answers = null; $family = null; $k =0 ;

        $personal_info = $request->child_info;

        if ($request->has('child_info')) {
            /////validation
            $messages = PersonalInformationController::validationInput($request) ;
            //////////end validation

            if (empty($messages)) {
                $res = ChildController::store($request->age , $request->phone_number , $request->name);

                if($res == false)
                {
                    return $this->sendErrors([], 'failed in added child');
                }
                $child_id = Child::orderBy('created_at', 'desc')->first()['id'];

                foreach ($personal_info as $item) {

                    $answers = PersonalInformation::create(
                        [
                            'answer' => $item['answer'],
                            'ques_id' => $item['ques_id'],
                            'child_id' =>  $child_id
                        ]
                    );

                    if ($answers == null) {
                        return $this->sendErrors([], 'failed in added child');
                    }
                }


                if ($request->has('sister_info')) {
                    $my_family  = $request->sister_info;
                    $family = MemberFamilyController::store($my_family, $child_id);
                }
                $messages[$k] = 'تمت إضافة معلومات الطفل بنجاح';
                return $this->sendResponse($messages, 'success in add all information ');
            } else {
                return $this->sendResponse($messages, 'error in some information');
            }
        }
        return $this->sendErrors([], 'failed in added child');
    }



    public function update_child(UpdatePersonalInformationRequest $request)
    {

        $personal_info = $request->child_info;
        $my_family  = $request->sister_info;
        $age = Child::where('id', $request->child_id)->value('age');

        $messages = PersonalInformationController::validationInput($request) ;

        if (empty($messages)) {
            foreach ($personal_info as $item) {
                $found = PersonalInformation::where('child_id', '=', $request->child_id)->where('ques_id', $item['ques_id'])->get();

                if (!($found->isEmpty())) {
                    $child = PersonalInformation::where('child_id', '=', $request->child_id)->where('ques_id', $item['ques_id']);

                    if ($item['answer'] == '') {
                        $child->delete();
                    } else {
                        $child->update([
                            'answer' => $item['answer'],
                        ]);
                    }
                } else {
                    if ($item['answer'] != '') {
                        $child = PersonalInformation::create(
                            [
                                'answer' => $item['answer'],
                                'ques_id' => $item['ques_id'],
                                'child_id' =>  $request->child_id
                            ]
                        );
                    } else {
                        $child = true;
                    }
                }
                if ($item['ques_id'] == 4) {
                    $age = ChildController::calculateAge($item['answer']) ;
                }
            }

            $c = Child::where('id', $request->child_id);
            if ($c) {
                $c->update([
                    'phone_num' => $request->phone_number,
                    'name' => $request->name,
                    'age' => $age
                ]);
            }

            $my_sister = MemberFamily::where('child_id', '=', $request->child_id);
            $my_sister->delete();
            if ($request->has('sister_info')) {
                $my_family  = $request->sister_info;
                $family = MemberFamilyController::store($my_family, $request->child_id);
            }

            if ($child && $family)
            {
                $messages[0] = 'تم تعديل معلومات الطفل بنجاح';
                return $this->sendResponse($messages, 'success in update all information ');

            }
            return $this->sendErrors([], 'failed in update information of child');

        }else {
            return $this->sendResponse($messages, 'error in update some information');
        }

    }
}

/*
     foreach ($my_family as $indivual) {
            $family = MemberFamily::where('id', '=', $indivual['id']);

            if ($family) {
                $family->create(
                    [
                        'child_id' => $request->child_id,
                        'age' => $indivual['age'],
                        'name' => $indivual['name'],
                        'gender' => $indivual['gender'],
                        'Educ_level' => $indivual['Educ_level']
                    ]
                );
            }
        }
*/
