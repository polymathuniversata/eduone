@extends('master')

@section('title', 'Schedule')
@section('header')
	<script>
	var teachers = {!! json_encode($teachers) !!}
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
					@foreach ($slots as $slot_name => $time)
					<th>
						{{$slot_name}}
						<small>{{$time}}</small>
					</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach ($rooms as $room_id => $room_name)
				<tr>
					<th style="max-width: 50px;">{{$room_name}}</th>
					@foreach ($slots as $slot_name => $time)
					<td data-toggle="modal" data-target="#myModal">
						<span class="text-muted" ng-hide="schedules[{{$room_id}}]['{{$slot_name}}']">Click to Add</span>
					</td>
					@endforeach
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	@include('schedules/_partials/modal_create')

</div><!--ScheduleController-->
@endsection