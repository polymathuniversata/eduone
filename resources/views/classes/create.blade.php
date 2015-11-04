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
			'ng-change' => 'showChild()'])
		!!}
	</div>
	
	@{{selectedPeriods | json}}
	<div class="form-group" ng-if="periods != null">
		<select class="form-control" ng-model="selectedPeriods" multiple="multiple" ng-options="period.name for (id, period) in periods"></select>
	</div>

	<div class="form-group">
		{!! Form::label('subjects', trans('app.subjects')) !!}
	</div>
	
	<div class="form-group">
		{!! Form::label('students', 'Members') !!}
		
		<script type="text/ng-template" id="customTemplate.html">
		  <a>
		      <img ng-src="http://upload.wikimedia.org/wikipedia/commons/thumb/@{{match.model.photo}}" width="16">
		      <span ng-bind-html="match.model.name | uibTypeaheadHighlight:query"></span>
		  </a>
		</script>

		<input type="text" ng-model="selected" placeholder="Select a student to add" uib-typeahead="student as student.name for student in students | filter:{name:$viewValue}" typeahead-template-url="customTemplate.html" typeahead-on-select="addStudent($item, $model, $label)" class="form-control">

		<div class="members">
			<div class="media" ng-repeat="student in selectedStudents">
			  <div class="media-left media-middle">
			    <a href="#">
			      <img class="media-object" ng-src="http://upload.wikimedia.org/wikipedia/commons/thumb/@{{student.photo}}" alt="@{{student.name}}">
			    </a>
			  </div>
			  <div class="media-body">
			    <h4 class="media-heading">@{{student.name}}</h4>
			    <button class="btn btn-default btn-sm" ng-click="removeStudent(student.id)"><i class="glyphicon glyphicon-remove"></i></button>
			  </div>
			</div>
		</div>

	</div>

	<button class="btn btn-primary">Save Changes</button>
	
	<input type="hidden" name="students_id" value="@{{selectedStudents}}">
{!! Form::close() !!}
</div>
@endsection