@extends('master')

@section('title', $class->name)
@section('main_title', $class->name)
@section('content')

@section('header')
@if (isset($request->modal_open) || $class->users_count === 0)
<script type="text/javascript">
	$(function(){
		$('#myModal').modal('show')
	});
</script>
@endif
@endsection


@include('classes/_partials/tabs')

<div class="row">
	{!! Form::model($class, ['route' => ['classes.update', $class->id], 'method' => 'PUT', 'class' => 'col-md-7']) !!}
		
	  	@if(isset($request->tab) && in_array($request->tab, ['info', 'members', 'subjects']))
				@include('classes/_partials/' . $request->tab)
		@endif
		
		<input type="hidden" name="tab" value="{{$request->tab}}">
	{!! Form::close() !!}
</div>
@endsection