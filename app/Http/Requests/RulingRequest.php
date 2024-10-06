<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RulingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        return [
            'judgment_number' => 'required|min:8|max:15|unique:rulings,judgment_number,' . $this->ruling?->id,
            'judgment_date' => $request->isMethod('POST') ? 'required|date' : 'nullable|date',
            'judgment_text' => 'nullable|string',
            'ruling_status_id' => $request->isMethod('POST') ? 'required|exists:ruling_statuses,id' : 'nullable|exists:ruling_statuses,id',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2019752'
        ];
    }
}
