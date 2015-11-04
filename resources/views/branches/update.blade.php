@extends('master')

@section('content')

<header>
	<h1>Update Branch</h1>
</header>

{!! Form::model($branch, ['route' => ['branchs.update', $branch->id], 'method' => 'PUT']) !!}
	@include('branches/_partials/form');
{!! Form::close() !!}
@endsection