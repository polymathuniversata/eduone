@extends('master')

@section('title', trans('app.create_new_room'))
@section('main_title', trans('app.create_new_room'))

@section('content')

{!! Form::open(['url' => 'rooms', 'class' => 'form-horizontal']) !!}

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
		{!! Form::label('capacity', trans('app.capacity'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::number('capacity', null, [
				'class' => 'form-control', 
				'placeholder' => trans('app.capacity')]) 
			!!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('type', trans('app.type'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::text('type', null, [
				'class' => 'form-control', 
				'placeholder' => trans('app.type')]) 
			!!}
		</div>
	</div>
	
	<div class="form-group">
		{!! Form::label('branch_id', trans('app.branch'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::select('branch_id', $branches, null, ['class' => 'form-control'] ) !!}
		</div>
	</div>


	<button class="btn btn-primary">Save Changes</button>

{!! Form::close() !!}
@endsection