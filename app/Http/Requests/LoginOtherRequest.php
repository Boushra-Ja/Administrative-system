<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginOtherRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'unique_number' => 'required|numeric' ,
            'role' => 'required',
            'password' => 'required' ,

        ];
    }
}
