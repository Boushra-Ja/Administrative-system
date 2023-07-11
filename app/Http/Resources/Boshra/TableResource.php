<?php

namespace App\Http\Resources\Boshra;

use App\Models\PortageDimenssion;
use App\Models\TestResault;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use NunoMaduro\Collision\Adapters\Phpunit\TestResult;

class TableResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        ////الاجتماعي //
        $social_basal_age = TestResault::where('child_id', $this->id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الاجتماعي')->value('id'))
            ->orderby('created_at' , 'desc')->first()
            ->value('basal');

        $social_additional_age = TestResault::where('child_id', $this->id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الاجتماعي')->value('id'))->value('additional');

        /////الحركي///
        $montor_basal_age = TestResault::where('child_id', $this->id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الحركي')->value('id'))->value('basal');

        $montor_additional_age = TestResault::where('child_id', $this->id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الحركي')->value('id'))->value('additional');

        /////الاتصالي///////
        $comm_basal_age = TestResault::where('child_id', $this->id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الاتصالي')->value('id'))->value('basal');

        $comm_additional_age = TestResault::where('child_id', $this->id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد الاتصالي')->value('id'))->value('additional');

        ///////////////العنايه الذاتيه////
        $care_basal_age = TestResault::where('child_id', $this->id)
            ->where('dim_id', PortageDimenssion::where('title', 'بعد العناية الذاتية')->value('id'))->value('basal');

        $care_additional_age = TestResault::where('child_id', $this->id)
            ->where('dim_id', PortageDimenssion::where('title', 'بعد العناية الذاتية')->value('id'))->value('additional');

        /////المعرفي////
        $know_basal_age = TestResault::where('child_id', $this->id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد المعرفي')->value('id'))->value('basal');

        $know_additional_age = TestResault::where('child_id', $this->id)
            ->where('dim_id', PortageDimenssion::where('title', 'البعد المعرفي')->value('id'))->value('additional');

        return [
            'social_basal_age' => $social_basal_age
        ];
    }
}
