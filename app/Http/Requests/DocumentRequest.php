<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        return [
            'file_number' => 'required|min:8|max:15|unique:documents,file_number,' . $this->document?->id,
            'document_type_id' =>  $request->isMethod('POST') ? 'required|exists:document_types,id' : 'nullable|exists:document_types,id',
            'lawyer_id' => $request->isMethod('POST') ? 'required|exists:lawyers,id' : 'nullable|exists:lawyers,id',
            'user_id' => $request->isMethod('POST') ? 'required|exists:users,id' : 'nullable|exists:users,id',
            'court_branch_id' => $request->isMethod('POST') ? 'required|exists:court_branches,id' : 'nullable|exists:court_branches,id',
            'court_class_number' => 'required|min:8|max:15|unique:documents,court_class_number,' . $this->document?->id,
            'court_filing_number' => 'required|min:8|max:15|unique:documents,court_filing_number,' . $this->document?->id,
            'document_status_id' => $request->isMethod('POST') ? 'required|exists:document_statuses,id' : 'nullable|exists:document_statuses,id',
            'description' => 'nullable|string',
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf|max:2019752',
        ];
    }
}
