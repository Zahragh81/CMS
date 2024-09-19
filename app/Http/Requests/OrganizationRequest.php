<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
//        if ($this->isMethod('POST')){
        return [
            'name' => 'required|string|max:255',
            'national_id' => 'required|string|unique:organizations,national_id|min:8|max:15',
            'parent_id' => 'nullable|exists:organizations,id',
            'avatar' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
        ];
//        }else{
//            return [
//                'name' => 'required|string|max:255',
//                'national_id' => 'required|string|unique:organizations,national_id|max:255',
//                'parent_id' => 'nullable|exists:organizations,id'
//            ];
//        }



    }
}
