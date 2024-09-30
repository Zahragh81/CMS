<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CourtBranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        return [
            'name' => $request->isMethod('POST') ? 'required|string|max:255' : 'nullable|string|max:255',
            'city_id' => $request->isMethod('POST') ? 'required|exists:cities,id' : 'nullable|exists:cities,id',
            'branch_code' => $request->isMethod('POST')
                ? 'required|unique:court_branches,branch_code'
                : 'nullable|unique:court_branches,branch_code,' . $this->courtBranch?->id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|digits:11',
            'branch_type_id' => $request->isMethod('POST') ? 'required|exists:branch_types,id' : 'nullable|exists:branch_types,id',
        ];
    }
}
