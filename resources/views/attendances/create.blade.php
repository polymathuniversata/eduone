@extends('master')

@section('title', 'Attendance')
@section('main_title', 'Attendance')

@section('content')
	
	{!! Form::open(['url' => 'attendances']) !!}
	
	<button class="btn btn-primary pull-right">Save Changes</button>

	<br><br>

	<div class="table-responsive panel panel-default">
		<table class="table">
			<thead class="panel-heading">
				<tr>
					<th>#</th>
					<th>Student</th>
					<th><input type="checkbox"> Present?</th>
					<th>Note</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($students as $id => $student_name)
				<tr>
					<td>1</td>
					<td>{{$student_name}}</td>
					<td>
						{!! Form::checkbox("students[{$id}][status]", 'present', ! empty($attendance_detail[$id]['status']) && $attendance_detail[$id]['status'] == 'present') !!}
						
					</td>
					<td><textarea name="students[{{$id}}][note]" class="form-control" rows="2">{{ ( ! empty($attendance_detail[$id]['note'])) ? $attendance_detail[$id]['note'] : '' }}</textarea></td>
				</tr>
				
				@endforeach
			</tbody>
		</table>
	</div>
	
	<input type="hidden" name="schedule_id" value="{{$request->schedule_id}}">
	<button class="btn btn-primary pull-right">Save Changes</button>
	{!! Form::close() !!}
@stop