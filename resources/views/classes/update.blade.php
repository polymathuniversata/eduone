@extends('master')

@section('title', $class->name)
@section('content')

<header>
	<h1>{{ $class->name }}</h1>
	<div class="label label-info">Active</div>
</header>

<script type="text/javascript">
	var thisClass = {!! $class!!},
		availablePrograms = {!! json_encode($programs) !!};
</script>
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
		
		<div class="form-group" ng-show="thisClass.program_id > 0">
			{!! Form::label('periods', 'Periods') !!}
			<select ng-change="showSubjects()" id="periods" class="form-control" ng-model="thisClass.periods_id" multiple="multiple" ng-options="period.id as period.name for period in periods">
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