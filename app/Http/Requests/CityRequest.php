<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        return [


            'name' => $request->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:cities,id'
        ];
    }
}
