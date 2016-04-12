@extends('master')

@section('header')
<script type="text/javascript" src="{{ url('/assets/js/controllers/program-controller.js') }}"></script>
@endsection
@section('title', trans('app.program_designer'))

@section('main_title')
{!! trans('app.program_designer') !!}
@endsection

@section('content')
<script type="text/javascript">
	var subjects = {!! json_encode($subjects) !!};
</script>

<div class="row row-md" ng-controller="ProgramController" ng-init="init()">
	{!! Form::open(['url' => 'programs']) !!}
	@include('programs/_partials/form')
	{!! Form::close() !!}
</div><!--.row-->
@endsection