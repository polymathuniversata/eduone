@extends('master')

@section('title', 'Attendance')
@section('main_title', 'Attendance')

@section('content')
	
	{!! Form::open(['url' => 'attendances']) !!}
	
	<table class="table table-bordered panel panel-default">
		<thead>
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
				<td><input type="checkbox"></td>
				<td><textarea name="aaa" class="form-control" rows="2"></textarea></td>
			</tr>
			
			@endforeach
		</tbody>
	</table>

	{!! Form::close() !!}
@stop