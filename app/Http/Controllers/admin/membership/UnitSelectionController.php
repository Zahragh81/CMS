<?php

namespace App\Http\Controllers\admin\membership;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataFormRequest;
use App\Http\Resources\membership\AnswerResource;
use App\Http\Resources\membership\DataFormResource;
use App\Http\Resources\membership\FormResource;
use App\Http\Resources\membership\UnitSelectionResource;
use App\Models\membership\Answer;
use App\Models\membership\DataForm;
use App\Models\membership\Form;
use App\Models\membership\Question;
use App\Models\membership\Semester;
use App\Models\membership\UnitSelection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitSelectionController extends Controller
{
    public function index(Request $request)
    {
        $semesterId = $request->semester_id;

        $unitSelections = UnitSelection::select(['id', 'score', 'lesson_offered_id', 'unit_selection_status_id', 'student_id', 'status'])
            ->where('student_id', Auth::id())
            ->with([
                'lessonOffered' => function ($q) {
                    $q->select(['id', 'lesson_id', 'master_id'])
                        ->with([
                            'lesson:id,title',
                            'master:id,first_name,last_name'
                        ]);
                },
                'unitSelectionStatus:id,name'
            ])
            ->whereHas('lessonOffered', function ($q) use ($semesterId) {
                $q->where('semester_id', $semesterId);
            })->get();

        return UnitSelectionResource::collection($unitSelections);
    }


//    public function store(UnitSelection $unitSelection)
//    {
//        $questions = Question::all();
//
//        $formId = 1;
//        $unitSelectionId = $unitSelection->id;
//
//        foreach ($questions as $question) {
//            $existingDataForm = DataForm::where('form_id', $formId)
//                ->where('unit_selection_id', $unitSelectionId)
//                ->where('question_id', $question->id)
//                ->first();
//
//            if (!$existingDataForm) {
//                DataForm::create([
//                    'form_id' => $formId,
//                    'question_id' => $question->id,
//                    'unit_selection_id' => $unitSelectionId,
//                    'answer_id' => null,
//                    'status' => true,
//                ]);
//            }
//        }
//
//        return self::successResponse();
//    }


    public function store(Request $request, UnitSelection $unitSelection)
    {
        $input = $request->all();

        $formId = $input['form_id'];

        $questions = Question::where('form_id', $formId)->get();

        $unitSelectionId = $unitSelection->id;

        foreach ($questions as $question) {
            $exisingDataForm = DataForm::where('form_id', $formId)
                ->where('unit_selection_id', $unitSelectionId)
                ->where('question_id', $question->id)
                ->first();

            if (!$exisingDataForm) {
                DataForm::create([
                    'form_id' => $formId,
                    'question_id' => $question->id,
                    'unit_selection_id' => $unitSelectionId,
                    'answer_id' => null,
                    'status' => true,
                ]);
            }
        }

        return self::successResponse();
    }


//    public function show(UnitSelection $unitSelection)
//    {
//        $lessonOffered = $unitSelection->lessonOffered()->with([
//            'lesson:id,title',
//            'master:id,first_name,last_name',
//            'semester:id,title'
//        ])->first();
//
//        $dataForms = DataForm::with([
//            'question:id,title,weight',
//            'answer'
//        ])
//            ->where('unit_selection_id', $unitSelection->id)
//            ->get();
//
//        return self::successResponse([
//            'lesson' => $lessonOffered->lesson,
//            'master' => $lessonOffered->master,
//            'semester' => $lessonOffered->semester,
//            'dataForms' => DataFormResource::collection($dataForms)
//        ]);
//    }


    public function show(Request $request, UnitSelection $unitSelection)
    {
        $formId = $request->form_id;
        $lessonOffered = $unitSelection->lessonOffered()->with([
            'lesson:id,title',
            'master:id,first_name,last_name',
            'semester:id,title'
        ])->first();

        $dataForms = DataForm::with([
            'question:id,title,weight',
            'answer'
        ])
            ->where('unit_selection_id', $unitSelection->id)
            ->where('form_id', $formId)
            ->get();

        return self::successResponse([
            'lesson' => $lessonOffered->lesson,
            'master' => $lessonOffered->master,
            'semester' => $lessonOffered->semester,
            'dataForms' => DataFormResource::collection($dataForms)
        ]);
    }


    public function update(DataFormRequest $request, UnitSelection $unitSelection)
    {
        $input = $request->all();

        $dataForms = $input['dataForms'];

        foreach ($dataForms as $dataForm) {
            $existingDataForm = DataForm::find($dataForm['data_form_id']);

            if ($existingDataForm && $existingDataForm->unit_selection_id == $unitSelection->id) {
                $existingDataForm->update([
                    'answer_id' => $dataForm['answer_id']
                ]);
            }
        }

        return self::successResponse();
    }


    public function answer(Request $request)
    {
        $formId = $request->form_id;

        if ($formId){
            $answers = Answer::where('form_id', $formId)->with('form')->get();
        }else{
            $answers = Answer::with('form')->get();
        }

        return AnswerResource::collection($answers);
    }


//    public function upsertData()
//    {
//        return self::successResponse([
//            'semesters' => Semester::select(['id', 'title'])->get(),
//            'answers' => AnswerResource::collection(Answer::with('form')->get()),
//            'forms' => Form::select(['id', 'title'])->get(),
//        ]);
//    }

    public function upsertData()
    {
        return self::successResponse([
            'semesters' => Semester::select(['id', 'title'])->get(),
            'forms' => Form::select(['id', 'title'])->get(),
        ]);
    }

}


