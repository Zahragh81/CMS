<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerRequest;
use App\Http\Resources\membership\AnswerResource;
use App\Http\Resources\membership\FormResource;
use App\Models\membership\Answer;
use App\Models\membership\Form;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index(Form $form)
    {
        $answers = Answer::select(['id', 'title', 'value', 'status'])
            ->where(function ($q){
                $q->where('title', 'like', $this->search);
            })
            ->where('form_id', $form->id)
            ->paginate($this->first);

        return FormResource::collection($answers);
    }


    public function store(AnswerRequest $request, Form $form)
    {
        $input = $request->all();
        $input['form_id'] = $form->id;

        Answer::create($input);

        return self::successResponse();
    }


    public function show(Form $form, Answer $answer)
    {
        return new AnswerResource($answer->load(
            'form'
        ));
    }


    public function update(AnswerRequest $request, Form $form, Answer $answer)
    {
        $input = $request->all();
        $answer->update($input);

        return self::successResponse();

    }


    public function destroy(Form $form, Answer $answer)
    {
        $answer->delete();

        return self::successResponse();
    }
}
