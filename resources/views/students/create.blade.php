@extends('master')

@section('title', trans('app.create_new_student'))
@section('main_title', trans('app.create_new_student'))

@section('content')
{!! Form::open(['url' => 'students']) !!}
	@include('users/_partials/form', compact('view'))
{!! Form::close() !!}
@endsection