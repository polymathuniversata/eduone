@extends('master')
@section('title', trans('branch.new_branch'))
@section('main_title', trans('branch.new_branch'))

@section('content')
{!! Form::open(['url' => 'branches', 'class' => 'form-horizontal']) !!}
	@include('branches/_partials/form')
{!! Form::close() !!}
@endsection