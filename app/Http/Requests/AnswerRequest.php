<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AnswerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        return [
            'title' => $this->isMethod('POST') ? 'required|string' : 'nullable|string',
            'value' => $this->isMethod('POST') ? 'required|integer|between:1,5' : 'nullable|integer|between:1,5'
        ];
    }
}
