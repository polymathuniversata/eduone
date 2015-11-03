@extends('master')

@section('title', trans('app.create_new_class'))
@section('content')

<header>
	<h1>{!! trans('app.create_new_class') !!}</h1>
</header>

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
		{!! Form::select('program_id', $programs, null, ['class' => 'form-control']) !!}
	</div>
	
	<div class="form-group">
		{!! Form::label('subjects', trans('app.subjects')) !!}
	</div>


	<button class="btn btn-primary">Save Changes</button>

{!! Form::close() !!}
@endsection