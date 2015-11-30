@extends('master')

@section('title', 'Schedule')
@section('header')
	<script>
		var teachers 	= {!! json_encode($teachers) !!},
			rooms 		= {!! json_encode($rooms) !!},
			slots 		= {!! json_encode($slots) !!},
			schedules 	= {!! json_encode($schedules) !!},
			classes 	= {!! json_encode($classes) !!},
			subjects 	= {!! json_encode($subjects) !!};
	</script>
	<script type="text/javascript" src="{{ url('/assets/js/controllers/schedule-controller.js') }}"></script>
@endsection
@section('main_title', 'Schedule')

@section('content')

<div ng-controller="ScheduleController" ng-init="init()">
	
	{!! Form::model($request, ['url' => 'schedules', 'method' => 'GET']) !!}
	<div class="btn-toolbar" role="toolbar">
	  	<div class="btn-group" role="group">
			<a role="button" class="btn btn-default" href="{{url('schedules/?date=' . $dates['today'])}}">Today</a>
	  	</div>

	  	<div class="btn-group" role="group">
	  		<a role="button" class="btn btn-default" href="{{url('schedules/?date=' . $dates['previous_day'] )}}"><i class="fa fa-chevron-left"></i></a>
	  		<a role="button" class="btn btn-default" href="{{url('schedules/?date=' . $dates['next_day'])}}"><i class="fa fa-chevron-right"></i></a>
			{!! Form::date('date', $dates['viewing_day'], ['class' => 'form-control']) !!}
	  	</div>

	  	<div class="btn-group right" role="group">
			<button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
	  	</div>
	</div>
	{!! Form::close() !!}

	<div class="table-responsive">
		<table class="table table-bordered" id="table-schedule">
			<thead>
				<tr>
					<th style="max-width: 50px;"></th>
					<th ng-repeat="slot in slots">
						@{{slot.name}}
						<small>@{{slot.time}}</small>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="(room_id, slot_schedules) in schedules">
					<th style="max-width: 50px;">@{{room_id}}</th>
					<td data-toggle="modal" data-target="#myModal" ng-repeat="(slot_id, schedule) in slot_schedules" ng-click="setSchedule(schedule, slot_id, room_id)">

						<span class="text-muted" ng-hide="schedule.class_id">Click to Add</span>
						<div ng-show="schedule.class_id">
							
							<h4>@{{classes[schedule.class_id]}}</h4>

							<span class="label label-success">@{{subjects[schedule.subject_id]}}</span>
							
							@{{teachers[schedule.teacher_id]}}
							
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	@include('schedules/_partials/modal_create')

</div><!--ScheduleController-->
@endsection