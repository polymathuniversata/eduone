@extends('master')

@section('title', trans('app.create_new_user'))
@section('content')
<header>
	<h1>{!! trans('app.create_new_user') !!}</h1>
</header>

{!! Form::open(['url' => 'users']) !!}
	@include('users/_partials/form')
{!! Form::close() !!}
@endsection