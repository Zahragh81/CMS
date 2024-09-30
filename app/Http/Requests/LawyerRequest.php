<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class LawyerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        return [
            'user_id' => $request->isMethod('POST') ? 'required|exists:users,id' : 'nullable|exists:users,id',
            'office_name' => $request->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'office_address' => $request->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'office_phone' => 'nullable|digits:11',
            'degree_id' => $request->isMethod('POST') ? 'required|exists:degrees,id' : 'nullable|exists:degrees,id',
        ];
    }
}
