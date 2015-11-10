@extends('master')

@section('title', trans('app.create_new_class'))
@section('main_title', trans('app.create_new_class'))

@section('content')

<div ng-controller="ClassController" class="row">
{!! Form::open(['url' => 'classes', 'class' => 'col-lg-6']) !!}
	
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
			'ng-model'	=> 'selectedProgram'
		]) !!}
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
	
	<button class="btn btn-primary">Save Changes</button>

{!! Form::close() !!}
</div>
@endsection