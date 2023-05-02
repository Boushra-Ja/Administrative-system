<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberFamilyRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string' ,
            'gender' => 'required' ,
            'age' => 'required|numeric' ,
            'Educ_level' => 'required|string'
        ];
    }
}
