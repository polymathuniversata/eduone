@extends('master')

@section('title', trans('app.create_new_room'))
@section('main_title', trans('app.create_new_room'))

@section('content')

{!! Form::open(['url' => 'rooms', 'class' => 'form-horizontal']) !!}
	
	@include('rooms/_partials/form')

	<button class="btn btn-primary">Create New Room</button>

{!! Form::close() !!}
@endsection