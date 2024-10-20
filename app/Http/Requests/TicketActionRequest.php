<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TicketActionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        if ($request->isMethod('POST')) {
            return [
                'referral_order' => 'required|string',
                'referral_type_id' => 'required|exists:referral_types,id',
//            'referrer_id' => 'required|exists:users,id',
                'organization_id' => 'required|exists:organizations,id',
                'referral_recipient_id' => 'required|exists:users,id',
                'action_status_id' => 'required|exists:ticket_statuses,id',
                'files' => 'nullable|array',
                'files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2019752'
            ];

        } else {
            return [
                'description_action' => 'required|string',
                'progress_percentage' => 'required|integer|min:0|max:100',
//                'action_status_id' => 'required|exists:ticket_statuses,id',
                'files' => 'nullable|array',
                'files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2019752'
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->isMethod('POST')){
        $this->merge([
            'action_status_id' => 1,
        ]);
        }
    }
}
