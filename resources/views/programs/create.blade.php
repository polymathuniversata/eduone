@extends('master')

@section('title', trans('app.create_new_program'))
@section('content')

<header>
	<h1>{!! trans('app.create_new_program') !!}</h1>
</header>

<script type="text/javascript">
	var subjects = {!! json_encode($subjects) !!};
</script>
<div class="row" ng-controller="ProgramController" ng-init="init()">
	{!! Form::open(['url' => 'programs', 'class' => 'form-horizontal']) !!}
	@include('programs/_partials/form');
	{!! Form::close() !!}
</div><!--.row-->

@endsection