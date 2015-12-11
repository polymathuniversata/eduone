<?php

namespace App\Repositories;

use App\User;
use App\Subject;

class UserRepository
{
	protected $user;

	public function setUser($user)
	{		
		$this->user = $user;

		if (is_numeric($user))
			$this->user = User::findOrFail($user);

		return $this;
	}

	public function allSubjects()
	{
		$programs = $this->user->programs;

		$subjects = [];

		foreach ($programs as $program) {
			$subjects = array_merge($subjects, $program->subjects->toArray());
		}

		return $subjects;
	}

	public function getCompletedPrograms()
	{
		return \DB::table('users_programs')
					->where('user_id', $this->user->id)
					->where('status', 'completed')
					->get(['program_id']);
	}

	public function getCompletedSubjects()
	{
		$subjects = $this->allSubjects();

		$completed_grades = \DB::table('users_grades')
								->where('user_id', $this->user->id)
								->get();

		$grades = [];

		foreach ($completed_grades as $grade) {
			$grades[$grade->subject_id][$grade->grade_id] = $grade->grade_id;
		}
		
		$completed = [];

		foreach ($subjects as $subject)  {
			if (isset($grades[$subject['id']]) && $subject['grades_count'] === count($grades[$subject['id']]))
				$completed[] = $subject['id'];
		}

		return $completed;
	}

	public function isSubjectCompleted($subject_id)
	{
		$completed = $this->getCompletedSubjects();

		return in_array($subject_id, $completed);
	}

	public function getSubjectAverageGrade($subject_id)
	{
		$subject = Subject::find($subject_id);

		if ( ! $subject)
			return;

		$grades = \DB::table('users_grades')
					->where('user_id', $this->user->id)
					->where('subject_id', $subject_id)
					->get();
		
		if (empty($grades))
			return;		// null means that student haven't completed	
		
		$grades = collect($grades)->keyBy('grade_id')->toArray();

		$grades_plan = $subject->grades_plan;
		
		$marks = [];

		foreach ($grades_plan as $index => $plan)
		{
			$marks[$index] = [
				'percent' 	=> $plan['percent'],
				'value'		=> isset_val($grades[$index]->total)
			];
		}
		
		return $this->calculateAverage($marks);
	}

	public function getPeriodAverageGrade($period_id)
	{
		// Get all subjects of period
		$period = \App\Period::find($period_id);
		if ( ! $period)
			return;

		$subjects = $period->subjects;

		$marks = [];

		foreach ($subjects as $subject) {
			$marks[$subject->id] = [
				'percent' => $subject->total_grade_rate,
				'value'	  => $this->getSubjectAverageGrade($subject->id)
			];
		}

		// Calculate percent
		return $this->calculateAverage($marks);
	}

	public function getProgramAverageGrade($program_id)
	{
		$program = \App\Program::find($program_id);
		if ( ! $program)
			return;

		$periods = $program->periods;

		$marks = [];

		foreach ($periods as $period) {
			$marks[$period->id] = [
				'percent' 	=> $period->weight,
				'value'		=> $this->getPeriodAverageGrade($period->id) 
			];
		}

		return $this->calculateAverage($marks);
	}

	protected function calculateAverage($marks)
	{
		// Todo: Get Calculation method from Setting::('calculation_method')
		$calculation_method = 'arithmetic_mean';

		$average = 0;

		foreach ($marks as $mark) {
			if ($calculation_method === 'percent')
				$average += $mark['value'] * $mark['percent'] / 100;
			else
				$average += $mark['value'] * $mark['percent'] / array_sum(array_pluck($marks, 'percent'));	
		}

		return round($average);
	}
}