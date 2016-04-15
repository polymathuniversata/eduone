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
						@if ($class->subjects->count() > 0)
							<ul class="list-unstyled">
							@foreach ($class->subjects as $subject)
								<li><a href="{{url('grades?class_id=' . $class->id . '&amp;subject_id=' . $subject->id)}}">{{$subject->name}}</a></li>
							@endforeach
							</ul>
						@else
							<span class="text-muted">No subject</span>
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
								@foreach (json_decode($subjects[$request->subject_id]->grades_plan) as $index => $grade)
								<li>
									<a href="{{url('grades?class_id=' . $class->id . '&amp;subject_id=' . $request->subject_id . '&amp;grade_id=' . $index)}}">
										{{$grade->name}}
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
