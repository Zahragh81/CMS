<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'username' => "required|unique:users,username,{$this->user?->id}|digits:10",
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|digits:11|unique:users,mobile,' . $this->user?->id,
            'avatar' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'gender_id' => 'required|exists:genders,id',
            'organization_id' => 'nullable|exists:organizations,id '
        ];
    }
}
