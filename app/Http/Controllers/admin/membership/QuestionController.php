<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use App\Http\Resources\membership\QuestionResource;
use App\Models\membership\Form;
use App\Models\membership\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Form $form)
    {
        $questions = Question::select(['id', 'title', 'weight', 'form_id', 'status'])
            ->where(function ($q){
                $q->where('title', 'like', $this->search);
            })
            ->where('form_id', $form->id)
            ->paginate($this->first);

        return QuestionResource::collection($questions);
    }


    public function store(QuestionRequest $request, Form $form)
    {
        $input = $request->all();
        $input['form_id'] = $form->id;

        Question::create($input);

        return self::successResponse();
    }


    public function show(Form $form, Question $question)
    {
        return new  QuestionResource($question->load(
            'form'
        ));
    }


    public function update(QuestionRequest $request, Form $form, Question $question)
    {
        $input = $request->all();
        $question->update($input);

        return self::successResponse();
    }


    public function destroy(Form $form, Question $question)
    {
        $question->delete();

        return self::successResponse();
    }
}
