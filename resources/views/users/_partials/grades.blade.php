<div id="grades">
	
	@foreach ($student_grades as $subject_id => $grades)
		<h4>{{$subjects[$subject_id]}}</h4>

		<div class="table-responsive panel panel-default">
			<table class="table table-bordered table-striped">
				<thead class="panel-heading">
					<tr>
						<th>Grade Name</th>
						<th>Score (%)</th>
						<th>Grade</th>
						<th>Status</th>
						<th>Notes</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($grades as $grade)
					<tr>
						<td>{{$grade->grade_id}}</td>
						<td>{{$grade->total}}</td>
						<td>A</td>
						<td><span class="label label-success">Pass</span></td>
						<td>{{$grade->notes}}</td>
					</tr>
					@endforeach
					<tr>
						<td><span class="label label-default">Average</span></td>
						<td>{{$user_repository->getSubjectAverageGrade($subject_id)}}</td>
						<td>A</td>
						<td><span class="label label-success">Pass</span></td>
						<td></td>
					</tr>
				</tbody>
			</table>

		</div>

	@endforeach

</div>