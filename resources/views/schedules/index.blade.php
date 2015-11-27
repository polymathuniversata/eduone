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

	<div class="btn-toolbar" role="toolbar">
	  	<div class="btn-group" role="group">
			<button type="button" class="btn btn-default">Today</button>
	  	</div>
	  	<div class="btn-group" role="group">
			<button type="button" class="btn btn-default"><i class="fa fa-chevron-left"></i></button>
			<button type="button" class="btn btn-default"><i class="fa fa-chevron-right"></i></button>
	  	</div>

	  	<div class="btn-group right" role="group">
			<button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
	  	</div>
	</div>

	<div class="table-responsive">
		<table class="table table-bordered" id="table-schedule">
			<thead>
				<tr>
					<th style="max-width: 50px;"></th>
					<th ng-repeat="(slot_name, time) in slots">
						@{{slot_name}}
						<small>@{{time}}</small>
					</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="(room_id, slots) in schedules">
					<th style="max-width: 50px;">@{{room_id}}</th>
					<td data-toggle="modal" data-target="#myModal" ng-repeat="(slot_name, schedule) in slots" ng-click="setSchedule(schedule, slot_name, room_id)">

						<span class="text-muted" ng-hide="schedule.class_id">Click to Add</span>
						<div ng-show="schedule.class_id">
							
							<p>@{{classes[schedule.class_id]}}</p>

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