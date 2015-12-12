<div class="table-responsive panel panel-default">
	<table class="table table-bordered">
		<thead class="panel-heading">
			<tr>
				<th>Class</th>
				<th>Subjects</th>
				<th>Grades</th>
			</tr>
		</thead>
		<tbody>
			@if ( ! empty($classes))
				@foreach ($classes as $index => $class)
				<tr>
					<td>{{ $class->name }}</td>
					<td>
						@if ( ! empty($class->subjects))
							<ul class="list-unstyled">
							@foreach ($class->subjects as $subject)
								<li><a href="{{url('grades?class_id=' . $class->id . '&amp;subject_id=' . $subject->id)}}">{{$subject->name}}</a></li>
							@endforeach
							</ul>
						@endif
					</td>
					@if ($index === 0)
					<td rowspan="{{$classes->count()}}">
						@if (empty($request->class_id) || empty($request->subject_id))
						<div class="alert alert-warning">
							Please select a subject to view grades
						</div>
						@else
						
							@if ( ! empty($subjects[$request->subject_id]))
							
							<ul class="list-unstyled">
								@foreach ($subjects[$request->subject_id]->grades_plan as $id => $grade)
								<li>
									<a href="{{url('grades?class_id=' . $class->id . '&amp;subject_id=' . $subject->id . '&amp;grade_id=' . $id)}}">
										{{$grade['name']}}
									</a>
								</li>
								@endforeach
							</ul>
							@endif
						@endif
					</td>
					@endif
				</tr>
				@endforeach
			@else
			<tr>
				<td colspan="3">
					<div class="alert alert-warning">
						Oops! There're no class here. Consider to <a href="{{url('classes/create')}}">create new one</a>
					</div>
				</td>
			</tr>
			@endif
		</tbody>
	</table>
</div>
