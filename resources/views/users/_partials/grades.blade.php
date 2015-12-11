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
						<th>Note</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($grades as $grade)
					<tr>
						<td>{{$grade->grade_id}}</td>
						<td>{{$grade->total}}</td>
						<td>{{$grade->total}}</td>
						<td>{{$grade->notes}}</td>
						<td>{{$grade->created_at}}</td>
					</tr>
					@endforeach
					<tr>
						<td>Average</td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
			</table>

		</div>

	@endforeach

</div>