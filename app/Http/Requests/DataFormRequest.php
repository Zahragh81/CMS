<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DataFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
       return [
         'dataForms' => 'required|array',
           'dataForms.*.data_form_id' => 'required|integer|exists:data_forms,id',
           'dataForms.*.answer_id' => 'nullable|integer|exists:answers,id'
       ];
    }
}
