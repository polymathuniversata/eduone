@extends('master')

@section('title', 'Grades')
@section('main_title', 'Grades')

@section('content')

@if (isset($request->class_id) && isset($request->subject_id) && isset($request->grade_id))
	@include('grades/_partials/update')
@else
	@include('grades/_partials/list')
@endif

@endsection