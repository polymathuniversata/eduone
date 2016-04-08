@extends('master')

@section('content')

<header>
	<h1>Update Branch</h1>
</header>
{!! Form::model($branch, ['route' => ['branches.update', $branch->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
	@include('branches/_partials/form');
{!! Form::close() !!}
@endsection