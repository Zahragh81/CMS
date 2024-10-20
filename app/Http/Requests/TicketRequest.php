<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'ticket_group_id' => 'required|exists:ticket_groups,id',
            'ticket_priority_id' => 'required|exists:ticket_priorities,id',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2019752'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'ticket_status_id' => 1,
        ]);
    }
}
