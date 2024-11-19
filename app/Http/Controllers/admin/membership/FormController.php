<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomFormRequest;
use App\Http\Resources\membership\FormResource;
use App\Models\membership\Form;
use App\Models\membership\Semester;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::select(['id', 'title', 'status'])
            ->where(function ($q) {
                $q->where('title', 'like', $this->search);
            })->paginate($this->first);

        return FormResource::collection($forms);
    }


    public function store(CustomFormRequest $request)
    {
        Form::create($request->all());

        return self::successResponse();
    }


    public function show(Form $form)
    {
        return new FormResource($form);
    }


    public function update(CustomFormRequest $request, Form $form)
    {
        $form->update($request->all());

        return self::successResponse();
    }


    public function destroy(Form $form)
    {
        $form->delete();

        return self::successResponse();
    }
}
