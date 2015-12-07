@extends('master')

@section('title', trans('app.update_room'))
@section('main_title', trans('app.update_room'))

@section('content')

{!! Form::model($room, ['route' => ['rooms.update', $room->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
	
	@include('rooms/_partials/form')
	
	<button class="btn btn-primary">Update</button>

{!! Form::close() !!}
@endsection