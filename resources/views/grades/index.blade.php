@extends('master')

@section('title', 'Grades')
@section('main_title', 'Grades')

@section('content')

@if (isset_all($request->class_id, $request->subject_id, $request->grade_id))
	@include('grades/_partials/update')
@else
	@include('grades/_partials/list')
@endif

@endsection