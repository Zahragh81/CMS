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
            'username' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'avatar' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'genders_id' => 'required|exists:genders,id',
            'organizations_id' => 'nullable|exists:organizations,id'
        ];
    }
}
