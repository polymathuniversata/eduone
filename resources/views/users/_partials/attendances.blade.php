<div id="attendance">
	
	@foreach ($user_subjects_pivot as $pivot)
		<h4>{{$subjects[$pivot->subject_id]}}</h4>

		<div class="table-responsive panel panel-default">
			<table class="table table-bordered table-striped">
				<thead class="panel-heading">
					<tr>
						<th>Date</th>
						<th>Session</th>
						<th>Slot</th>
						<th>Status</th>
						<th>Note</th>
					</tr>
				</thead>
				<tbody>
					@foreach (json_decode($pivot->attendance_detail) as $index => $attendance)
					<tr>
						<td>{{$attendance->date}}</td>
						<td>{{$index + 1}}</td>
						<td>{{$attendance->slot}}</td>
						<td>{{$attendance->status}}</td>
						<td>{{$attendance->note}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>

	@endforeach

</div>