<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Http\Trait\ExamTrait;
use Validator;
use DataTables;

class ExamResultController extends Controller
{
    use ExamTrait;

    protected function index($id): View
    {
        return view('exam.attend', compact('id'));
    }

    protected function saveUser(Request $request): JsonResponse
    {
        try {
             $validatedData = Validator::make($request->all(), [
                'name' => 'bail|required',
                'email' => 'bail|required|email|unique:exam_results,email'
            ], [
                'name.required' => 'Name is mandatory.',
                'email.required' => 'Email is mandatory.',
                'email.unique' => 'This email is already attend other exam'
            ]);
            if ($validatedData->fails()) {
                $jsonArray = [
                    'status' => 'validationError',
                    'messages' => $validatedData->messages()
                ];
            } else {
                $result = $this->getResult()->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'exam_id' => base64_decode($request->exam_id)
                ]);
                $jsonArray = [
                    'status' => 'success',
                    'next' => route('startExam', $result->id)
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

    protected function startExam($resultId): View
    {
        $examId = $this->getResult()->find($resultId);
        $questions = $this->getQuestions($examId->exam_id)->get();
        return view('exam.start_exam', compact('resultId', 'questions'));
    }

    protected function submitExam(Request $request): JsonResponse
    {
        $resultId = $request->id;
        $answers = $request->answers;
        if ($answers != null) {
            $count = 0;
            $exam = $this->getResult()->find($resultId);
            $examQuestions = $this->getQuestions($exam->exam_id)->get();
            foreach($examQuestions as $examQuestion) {
                foreach($answers as $answer) {
                    if ($answer == $examQuestion->answer) {
                      $count = $count + 1;  
                    }
                }
            }
            $this->getResult()->where('id', $resultId)->update([
                'mark' => $count,
                'total_mark' => count($examQuestions)
            ]);
            $jsonArray = [
                'status' => 'success',
                'next' => route('thankYou', $resultId)
            ];
        } else {
            $jsonArray = [
                'status' => 'error'
            ];
        }
        return response()->json($jsonArray);
    }

    protected function thankYou($resultId): View
    {
        $result = $this->getResult()->find($resultId);
        $totalMark = $this->getQuestions($result->exam_id)->count();
        return view('exam.thank_you', compact('result', 'totalMark'));
    }

    protected function results(Request $request)
    {
        if ($request->ajax()) {
            $results = $this->getResult();
            return DataTables::of($results)
            ->addIndexColumn()
            ->addColumn('exam', function ($row) {
                if ($row->exam === null) {
                    return 'NIL';
                } else{
                    return $row->exam->title;
                }
            })
            ->rawColumns(['exam'])
            ->toJson();
        }
        return view('exam.result');
    }
}
