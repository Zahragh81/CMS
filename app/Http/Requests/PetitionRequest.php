<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'petition_number' => 'required|unique:petitions,petition_number,' . $this->petition?->id,
            'petition_date' => 'required|date',
            'petition_text' => 'required|string',

        ];
    }
}
