@extends('master')

@section('title', trans('app.update_branch'))
@section('main_title', trans('app.update_branch'))

@section('content')

{!! Form::model($branch, ['route' => ['branches.update', $branch->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
	<div class="col-md-6">
		@include('branches/_partials/form')
	</div>
{!! Form::close() !!}
@endsection