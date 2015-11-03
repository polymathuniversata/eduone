@extends('master')

@section('title', trans('app.create_new_subject'))
@section('content')

<header>
	<h1>{!! trans('app.create_new_subject') !!}</h1>
</header>

<div class="row" ng-controller="SubjectController">
	{!! Form::open(['url' => 'subjects']) !!}
	@include('subjects/_partials/form')
	{!! Form::close() !!}
</div><!--/row-->
@endsection