@extends('master')

@section('title', trans('app.create_new_program'))
@section('content')

<header>
	<h1>{!! trans('app.create_new_program') !!}</h1>
</header>

{!! Form::open(['url' => 'programs', 'class' => 'form-horizontal']) !!}

	<div class="form-group">
		{!! Form::label('name', trans('app.name'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::text('name', null, [
				'class' => 'form-control', 
				'placeholder' => trans('app.name')]) 
			!!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('slug', trans('app.slug'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::text('slug', null, [
				'class' => 'form-control', 
				'placeholder' => trans('app.slug')]) 
			!!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('grade_type', trans('app.grade_type'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::select('grade_type', config('settings.grade_types'), 'vi', 
			['class' => 'form-control'] ) !!}
		</div>
	</div>

	<button class="btn btn-primary">{{trans('app.save_changes')}}</button>

{!! Form::close() !!}
@endsection