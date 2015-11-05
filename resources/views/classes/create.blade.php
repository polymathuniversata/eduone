@extends('master')

@section('title', trans('app.create_new_class'))
@section('content')

<header>
	<h1>{!! trans('app.create_new_class') !!}</h1>
</header>

<script type="text/javascript">
	var subjects = {!! $subjects !!},
		programs = {!! $programs_periods !!};
</script>
<div ng-controller="ClassController">
{!! Form::open(['url' => 'classes']) !!}

	<div class="form-group">
		{!! Form::label('name', trans('app.name')) !!}
		{!! Form::text('name', null, [
			'class' => 'form-control', 
			'placeholder' => trans('app.name')]) 
		!!}
	</div>

	<div class="form-group">
		{!! Form::label('program_id', trans('app.program')) !!}
		{!! Form::select('program_id', $programs, null, [
			'class' => 'form-control', 
			'placeholder' => 'Please select',
			'ng-model'	=> 'selectedProgram',
			'ng-change' => 'showPeriods()'])
		!!}
	</div>
	
	<div class="form-group" ng-show="selectedProgram != null">
		{!! Form::label('periods', 'Periods') !!}
		<select ng-change="showSubjects()" id="periods" class="form-control" ng-model="selectedPeriods" multiple="multiple" ng-options="period.id as period.name for period in periods"></select>
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
	
	<input type="hidden" name="periods_id" value="@{{selectedPeriods}}">

	<button class="btn btn-primary">Save Changes</button>

{!! Form::close() !!}
</div>
@endsection