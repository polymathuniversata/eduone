<div class="schedules">
	<table class="table table-bordered table-striped">
		<thead>
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
					
					{{ $weekdays[$i] }}
				</td>
				
				@foreach (config('settings.slots') as $slot)
				<td>
					@foreach ($schedules as $schedule)
						@if ($schedule->slot_id == $slot['id'] && str_contains($schedule->started_at, $weekdays[$i]))
							{{$schedule->subject_id}}
						@endif
					@endforeach
				</td>
				@endforeach
			</tr>
			@endfor
		</tbody>
	</table>
</div>