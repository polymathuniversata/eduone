@extends('master')

@section('title', $class->name)
@section('main_title', $class->name)
@section('content')

<script type="text/javascript">
	var thisClass = {!! $class!!},
		availablePrograms = {!! json_encode($programs) !!};
</script>

<ul class="nav nav-tabs">
    <li role="presentation" class="active"><a href='{!! url("/classes/$class->id") !!}' aria-controls="basic"><i class="glyphicon glyphicon-list-alt"></i> Basic Info</a></li>
    <li role="presentation"><a href='{!! url("/classes/$class->id") !!}/members' aria-controls="members"><i class="fa fa-users"></i> Members</a></li>
    <li role="presentation"><a href='{!! url("/classes/$class->id") !!}/subjects' aria-controls="subjects"><i class="fa fa-book"></i> Subjects</a></li>
</ul>

<div class="row">
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
			{!! Form::select('program_id', $programs, null, ['class' => 'form-control', 'placeholder' => 'Select a Program...']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('email', trans('app.email')) !!}
			{!! Form::text('email', null, [
				'class' => 'form-control', 
				'placeholder' => trans('app.email')]) 
			!!}
			<div class="help-block">Class email, useful when you setup an email group or email forwarding</div>
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