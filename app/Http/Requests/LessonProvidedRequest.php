<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonProvidedRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'semester_id' => 'required|exists:semesters,id'
        ];
    }
}
