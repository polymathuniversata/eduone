<div class="btn-toolbar" role="toolbar">
  	<div class="btn-group" role="group">
		<a role="button" class="btn btn-default" href="{{url('classes/1?tab=schedules&amp;date_start=' . $dates['today'])}}">This Week</a>
  	</div>

  	<div class="btn-group" role="group">
  		<a role="button" class="btn btn-default" href="{{url('classes/1?tab=schedules&amp;date_start=' . $dates['previous_week']['start'] )}}"><i class="fa fa-chevron-left"></i></a>
  		<a role="button" class="btn btn-default" href="{{url('classes/1?tab=schedules&amp;date_start=' . $dates['next_week']['start'])}}"><i class="fa fa-chevron-right"></i></a>
  	</div>

  	<date class="text-muted">From: {{$dates['weekdays'][0]}} to {{$dates['weekdays'][5]}}</date>

  	<div class="btn-group right" role="group">
		<button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
  	</div>
</div>

<div class="schedules">
	<div class="table-responsive panel">
		<table class="table table-bordered table-striped">
			<thead class="panel-heading">
				<tr>
					<th>Date</th>
					@foreach (config('settings.slots') as $slot)
					<th>{{$slot['name']}}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@for($i = 0; $i < 6; $i++)
				<tr>
					<td>
						{{config('settings.weekdays')[$i]}} <br>
						
						{{ $dates['weekdays'][$i] }}
					</td>
					
					@foreach (config('settings.slots') as $slot)
					<td>
						@foreach ($schedules as $schedule)
							@if ($schedule->slot_id == $slot['id'] && str_contains($schedule->started_at, $dates['weekdays'][$i]))
								<h4 class="schedule-subject">{{$all_subjects[$schedule->subject_id]}}</h4>

								<h5 class="schedule-teacher">{{$teachers[$schedule->teacher_id]}}</h5>

								<a href="{{url('attendances/')}}" class="btn btn-info btn-xs">Take Attendance</a>
							@endif
						@endforeach
					</td>
					@endforeach
				</tr>
				@endfor
			</tbody>
		</table>
	</div>
</div>