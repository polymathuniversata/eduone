@extends('master')

@section('title', trans('app.create_new_student'))
@section('content')
<header>
	<h1>{!! trans('app.create_new_student') !!}</h1>
</header>

{!! Form::open(['url' => 'students']) !!}
	@include('users/_partials/form', compact('view'))
{!! Form::close() !!}
@endsection