<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MeetingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        return [
            'title' => $request->isMethod('POST') ? 'required|string' : 'nullable|string',
            'start_time' =>  $request->isMethod('POST') ? '' : 'nullable|date',
            'end_time' =>  'nullable|date|after:start_time',
            'location' =>  $request->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'description' => 'nullable|string',
            'meeting_status_id' => $request->isMethod('POST') ? 'required|exists:meeting_statuses,id' : 'nullable|exists:meeting_statuses,id' ,
            'holding_type_id' => $request->isMethod('POST') ? 'required|exists:holding_types,id' : 'nullable|exists:holding_types,id',
            'notification' => $request->isMethod('POST') ? 'required|boolean' : 'nullable|boolean' ,
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2019752'
        ];
    }
}
