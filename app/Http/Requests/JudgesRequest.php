<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class JudgesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(Request $request): array
    {
        return [
            'user_id' => $request->isMethod('POST') ? 'required|exists:users,id' : 'nullable|exists:users,id',
            'court_branch_id' => $request->isMethod('POST') ? 'required|exists:court_branches,id' : 'nullable|exists:court_branches,id',
            'organizational_post_id' => $request->isMethod('POST') ? 'required|exists:organizational_posts,id' : 'nullable|exists:organizational_posts,id'
        ];
    }
}
