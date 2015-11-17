@extends('master')

@section('title', trans('app.create_new_role'))
@section('main_title', trans('app.create_new_role'))

@section('content')
{!! Form::open(['url' => 'roles']) !!}

	@include ('roles/_partials/form')

	<button class="btn btn-primary">{!! trans('app.save_changes') !!}</button>

{!! Form::close() !!}
@endsection