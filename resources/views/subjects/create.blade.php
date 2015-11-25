@extends('master')

@section('header')
<script type="text/javascript" src="{{ url('/assets/js/controllers/subject-controller.js') }}"></script>
@endsection

@section('title', trans('app.create_new_subject'))
@section('main_title', trans('app.create_new_subject'))
@section('main_button', '<a href="/subjects" class="btn btn-default">Back</a>')

@section('content')
<div class="row" ng-controller="SubjectController">
	{!! Form::open(['url' => 'subjects']) !!}
	@include('subjects/_partials/form')
	{!! Form::close() !!}
</div><!--/row-->
@endsection