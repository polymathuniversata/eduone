@extends('master')

@section('header')
<script type="text/javascript" src="{{ url('/assets/js/controllers/subject-controller.js') }}"></script>
@endsection
@section('title', trans('app.update_subject'))
@section('main_title', trans('app.update_subject'))
@section('content')

<script type="text/javascript">
	var grades 	= {!! $subject->grades_plan !!},
		sessions= {!! $subject->sessions_plan !!};
</script>

<div class="row" ng-controller="SubjectController" ng-init="init()">
	{!! Form::model($subject, ['route' => ['subjects.update', $subject->id], 'method' => 'PUT']) !!}
	@include('subjects/_partials/form')
	{!! Form::close() !!}
</div>
@endsection