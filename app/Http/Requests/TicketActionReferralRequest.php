<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketActionReferralRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'referral_order' => 'required|string',
            'referral_type_id' => 'required|exists:referral_types,id',
            'organization_id' => 'required|exists:organizations,id',
            'referral_recipient_id' => 'required|exists:users,id',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2019752'
        ];
    }
}
