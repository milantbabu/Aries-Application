<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Http\Trait\ExamTrait;
use DataTables;
use Validator;

class ExamController extends Controller
{
    use ExamTrait;

    protected function index(Request $request)
    {
        if ($request->ajax()) {
            $exams = $this->getExams();
            return DataTables::of($exams)
            ->addIndexColumn()
            ->addColumn('actions', function($row) {
                $button = "";
                $button .= '<a href="javascript:void(0)"  data-id="' . $row->id . '" class="' . \config('buttons.edit-class') . '" title="Edit">' . \config('buttons.edit-icon') . '</a>&nbsp;';

                $button .= '<a href="'. route('questions', base64_encode($row->id)) .'"  title="Questions">' . \config('buttons.question-icon') . '</a>&nbsp;';

                $button .= '<a href="'. route('attend', base64_encode($row->id)) .'"  title="Attend Exam">' . \config('buttons.user-icon') . '</a>&nbsp;';
            
               $button .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="' . \config('buttons.delete-class') . '" title="Delete">' . \config('buttons.delete-icon') . '</a>';
                
                return $button;

            })
            ->rawColumns(['actions'])
            ->toJson();
        }
        return view('exam.index');
    }

    protected function get(Request $request): JsonResponse
    {
        try {
            if ($this->examIdValidate($request)->fails()) {
                $jsonArray = [
                    'status' => 'validationError', 
                    'message' => 'Invalid exam.'
                ];
            } else {
                $exam = $this->getExams()->find($request->id);
                $jsonArray = [
                    'status' => 'success',
                    'data' => $exam
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
                'title' => 'bail|required|unique:exams,title,'.$id.',id,deleted_at,NULL',
                'subject' => 'required'
            ], [
                'title.required' => 'Exam name is mandatory.',
                'title.unique' => 'Exam name is already exist.',
                'subject.required' => 'Subject is mandatory.'
            ]);
            if ($validatedData->fails()) {
                $jsonArray = [
                    'status' => 'validationError',
                    'messages' => $validatedData->messages()
                ];
            } else {
                $exam = $this->getExams()->updateOrCreate(['id' => $id], $request->all());
                if ($exam->wasRecentlyCreated) {
                    $message = 'Exam Created Successfully.';
                } else if ((!$exam->wasRecentlyCreated && $exam->wasChanged()) || (!$exam->wasRecentlyCreated && !$exam->wasChanged())) {
                    $message = 'Exam Updated Successfully.';
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
            if ($this->examIdValidate($request)->fails()) {
                $jsonArray = [
                    'status' => 'validationError', 
                    'message' => 'Invalid Exam.'
                ];
            } else {
                $this->getExams()->find($request->id)->delete();
                $jsonArray = [
                    'status' => 'success',
                    'message' => 'Exam Deleted Successfully.' 
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

    private function examIdValidate($request): object
    {
        return Validator::make($request->all(),[
            'id' => 'bail|required|exists:exams,id'
        ]);
    }
}
