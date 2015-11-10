@extends('master')

@section('title', $class->name)
@section('main_title', $class->name)
@section('content')

<script type="text/javascript">
	var thisClass = {!! $class!!},
		availablePrograms = {!! json_encode($programs) !!};
</script>

<ul class="nav nav-tabs">
    <li role="presentation" class="active"><a href="{!! url('/classes/' . $class->id ) !!}" aria-controls="basic">Basic Info</a></li>
    <li role="presentation"><a href="{!! url('/classes/' . $class->id ) !!}/members" aria-controls="members">Members</a></li>
    <li role="presentation"><a href="{!! url('/classes/' . $class->id ) !!}/subjects" aria-controls="subjects">Subjects</a></li>
</ul>

<div class="row" ng-controller="ClassController" ng-init="init()">
	{!! Form::model($class, ['route' => ['classes.update', $class->id], 'method' => 'PUT', 'class' => 'col-md-6']) !!}
		
		  <div class="form-group">
				{!! Form::label('name', trans('app.name')) !!}
				{!! Form::text('name', null, [
					'class' => 'form-control', 
					'placeholder' => trans('app.name')]) 
				!!}
			</div>

			<div class="form-group">
				{!! Form::label('program_id', trans('app.program')) !!}
				
				<select name="program_id" id="program_id" class="form-control" placeholder="Please select" ng-model="thisClass.program_id" ng-change="showPeriods()" ng-options="key*1 as value for (key, value) in availablePrograms">
					<option value="">Select a Program</option>
				</select>
			</div>
			
			<div class="form-group" ng-show="selectedPeriods.length == 1">
				<label for="subjects">Subjects</label>
				<div class="checkbox-list checkbox-inline" id="subjects">
					<div class="checkbox checkbox-inline" ng-repeat="(key, value) in subjects">
						<label>
							<input type="checkbox" name="subjects_id" value="@{{key}}"> @{{value}}
						</label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label for="started_at">Start Date</label>
				{!! Form::date('started_at', null, [
					'class' => 'form-control'
				]) !!}
			</div>

			<div class="form-group">
				<label for="finished_at">Finish Date</label>
				{!! Form::date('finished_at', null, [
					'class' => 'form-control'
				])!!}
			</div>

			<div class="form-group">
				<label for="branch_id">Branch</label>
				{!! Form::select('branch_id', $branches, null, [
					'class' 		=> 'form-control',
					'placeholder' 	=> 'Select Branch'
				])!!}
			</div>
		<input type="hidden" name="periods_id" value="@{{selectedPeriods}}">

		<button class="btn btn-primary">Save Changes</button>

	{!! Form::close() !!}
</div>
@endsection