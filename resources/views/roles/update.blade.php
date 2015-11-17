@extends('master')

@section('title', trans('app.create_new_role'))
@section('main_title', trans('app.create_new_role'))

@section('content')

{!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) !!}

	@include ('roles/_partials/form')
	
	@if ($role->id !== 1)
	<button class="btn btn-primary">{!! trans('app.save_changes') !!}</button>
	@else
	<div class="alert alert-info">
		You cannot update super admin role
	</div>
	@endif
{!! Form::close() !!}
@endsection