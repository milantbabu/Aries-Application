<?php

namespace App\Http\Trait;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamResult;

trait ExamTrait
{
	private function getExams(): Builder
	{
		return Exam::select('id', 'title', 'subject')
		->latest();
	}

	private function getQuestions($examId = 0): Builder
	{
		return ExamQuestion::when($examId > 0, function ($query) use($examId) {
			$query->where('exam_id', $examId);
		})
		->with([
			'exam:id,title,subject'
		])
		->select('id', 'exam_id', 'question', 'first_option', 'second_option', 'third_option', 'fourth_option', 'answer')
		->oldest();
	}

	private function getResult(): Builder
	{
		return ExamResult::with([
			'exam:id,title'
		])
		->select('id', 'exam_id', 'name', 'email', 'mark', 'total_mark')
		->latest();
	}
} 