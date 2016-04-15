<div class="row">
	<div class="col-md-12">
		<p>
			Grade :grade->name for Class :class->name Subject :subject->name
		</p>
	</div>
</div>

{!! Form::open(['url' => 'grades']) !!}

<button class="btn btn-primary pull-right">Save Changes</button>

<br><br>
<div class="table-responsive panel panel-default">
	<table class="table table-bordered">
		<thead class="panel-heading">
			<tr>
				<th>#</th>
				<th>Student</th>
				<th>Mark (out of 100)</th>
				<th>Note</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($students as $index => $student)
			<tr>
				<td>{{$index+1}}</td>
				<td>{{$student->display_name}}</td>
				<td>
					{!! Form::number('students[' . $student->id .'][mark]', isset($grades[$student->id]) ? $grades[$student->id]->total : 0, ['class' => 'form-control', 'min' => 0, 'max' => 100, 'step' => '0.1']) !!}
				</td>
				<td>
					{!! Form::textarea('students[' . $student->id .'][notes]', isset($grades[$student->id]) ? $grades[$student->id]->notes : '', ['class' => 'form-control', 'rows' => 2]) !!}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<br>

<button class="btn btn-primary pull-right">Save Changes</button>

<input type="hidden" name="subject_id" value="{{$request->subject_id}}">
<input type="hidden" name="class_id" value="{{$request->class_id}}">
<input type="hidden" name="grade_id" value="{{$request->grade_id}}">

{!! Form::close() !!}