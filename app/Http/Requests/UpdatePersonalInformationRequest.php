<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalInformationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'child_id' => 'required' ,
            'name' => 'required|string' ,
            'phone_number' => 'required' ,
            'child_info' => 'required',
        ];
    }
}
