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
        return [
            'name' => 'required|string|max:255',
            'national_id' => 'required|unique:organizations,national_id,' . $this->organization?->id,
            'parent_id' => 'nullable|exists:organizations,id',
            'avatar' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ];


    }
}
