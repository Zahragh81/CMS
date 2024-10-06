<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PetitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        return [
            'petition_number' => 'required|unique:petitions,petition_number,' . $this->petition?->id,
            'petition_date' => $request->isMethod('POST') ? 'required|date' : 'nullable|date',
            'petition_text' => 'nullable|string',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2019752',
        ];
    }
}
