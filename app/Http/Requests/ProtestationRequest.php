<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProtestationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        return [
            'protestation_number' => 'required|unique:protestations,protestation_number,' . $this->protestation?->id,
            'protestation_date' => $request->isMethod('POST') ? 'required|date' : 'nullable|date',
            'protestation_text' => 'nullable|string',
            'protestation_status_id' => $request->isMethod('POST') ? 'required|exists:protestation_statuses,id' : 'nullable|exists:protestation_statuses,id'
        ];
    }
}
