<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Http\Trait\ExamTrait;
use DataTables;
use Validator;

class ExamQuestionController extends Controller
{
    use ExamTrait;

    protected function index(Request $request, $id)
    {
        if ($request->ajax()) {
            $questions = $this->getQuestions(base64_decode($id));
            return DataTables::of($questions)
            ->addIndexColumn()
            ->addColumn('actions', function($row) {
                $button = "";

                $button .= '<a href="javascript:void(0)"  data-id="' . $row->id . '" class="' . \config('buttons.edit-class') . '" title="Edit">' . \config('buttons.edit-icon') . '</a>&nbsp;';
            
               $button .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="' . \config('buttons.delete-class') . '" title="Delete">' . \config('buttons.delete-icon') . '</a>';
                
                return $button;

            })
            ->rawColumns(['actions'])
            ->toJson();
        }
        return view('question.index', compact('id'));
    }

    protected function get(Request $request): JsonResponse
    {
        try {
            if ($this->questionIdValidate($request)->fails()) {
                $jsonArray = [
                    'status' => 'validationError', 
                    'message' => 'Invalid question.'
                ];
            } else {
                $question = $this->getQuestions()->find($request->id);
                //dd($question);
                $jsonArray = [
                    'status' => 'success',
                    'data' => $question
                ];
            }
        } catch (\Exception $e) {
            $jsonArray = [
                'status' => "error",
                'message' => $e->getMessage(),
            ];
        }
        return response()->json($jsonArray);
    }

    protected function save(Request $request): JsonResponse
    {
        try {
            $id = $request->id;
            $validatedData = Validator::make($request->all(), [
                'question' => 'required',
                'first_option' => 'required',
                'second_option' => 'required',
                'third_option' => 'required',
                'fourth_option' => 'required',
                'answer' => 'required',
                'exam_id' => 'required',
            ], [
                'question.required' => 'Question is mandatory.',
                'first_option.required' => 'Option 1 is mandatory.',
                'second_option.required' => 'Option 2 is mandatory.',
                'third_option.required' => 'Option 3 is mandatory.',
                'fourth_option.required' => 'Option 4 is mandatory.',
                'answer.required' => 'Correct answer is mandatory.',
                'exam_id.required' => 'Invalid exam.',

            ]);
            if ($validatedData->fails()) {
                $jsonArray = [
                    'status' => 'validationError',
                    'messages' => $validatedData->messages()
                ];
            } else {
                $formData = $request->all();
                $formData['exam_id'] = base64_decode($request->exam_id);
                // dd($exam);
                $question = $this->getQuestions()->updateOrCreate(['id' => $id], $formData);
                if ($question->wasRecentlyCreated) {
                    $message = 'Question Created Successfully.';
                } else if ((!$question->wasRecentlyCreated && $question->wasChanged()) || (!$question->wasRecentlyCreated && !$question->wasChanged())) {
                    $message = 'Question Updated Successfully.';
                }
                $jsonArray = [
                    'status' => 'success',
                    'message' => $message,
                ];
            }
        } catch (\Exception $e) {
            $jsonArray = [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
        return response()->json($jsonArray);
    }

    protected function delete(Request $request): JsonResponse
    {
        try {
            if ($this->questionIdValidate($request)->fails()) {
                $jsonArray = [
                    'status' => 'validationError', 
                    'message' => 'Invalid question.'
                ];
            } else {
                $this->getQuestions()->find($request->id)->delete();
                $jsonArray = [
                    'status' => 'success',
                    'message' => 'Question Deleted Successfully.' 
                ];
            }
        } catch (\Exception $e) {
            $jsonArray = [
                'status' => "error",
                'message' => $e->getMessage(),
            ];
        }
        return response()->json($jsonArray);
    }

    private function questionIdValidate($request): object
    {
        return Validator::make($request->all(),[
            'id' => 'bail|required|exists:exam_questions,id'
        ]);
    }

}
