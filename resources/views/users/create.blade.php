@extends('master')

@section('title', trans('app.create_new_user'))

@section('main_title', trans('app.create_new_user'))

@section('main_button')
    <a href="/users/create" role="button" class="btn btn-default">Back</a>
@endsection

@section('content')
{!! Form::open(['url' => 'users']) !!}
	@include('users/_partials/form')
{!! Form::close() !!}
@endsection