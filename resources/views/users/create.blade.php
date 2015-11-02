@extends('master')

@section('title', trans('app.create_new_user'))
@section('content')
<header>
	<h1>{!! trans('app.create_new_user') !!}</h1>
</header>

{!! Form::open(['url' => 'users']) !!}

<div class="row">
	<div class="col-md-6 basic">
		<div class="form-group">
			<label>{!! trans('app.user_name') !!}</label>
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter User Name']) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.email') !!}</label>
			{!! Form::email('email', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.role') !!}</label>
			{!! Form::select('role_id', $roles, null, ['class' => 'form-control'] ) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.first_name') !!}</label>
			{!! Form::text('first_name', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.last_name') !!}</label>
			{!! Form::text('last_name', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.password') !!}</label>
			{!! Form::password('password', ['class' => 'form-control']) !!}
			<button type="button" class="btn btn-sm btn-default">{!! trans('app.generate') !!}</button>
		</div>

		<div class="form-group">
			<label>{!! trans('app.password_confirmation') !!}</label>
			{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
		</div>
		
		<div class="form-group">
			<label>{!! trans('app.branches') !!}</label>
				{!! Form::select('branches', $branches, null, ['class' => 'form-control', 'multiple' => 'multiple' ]) !!}
		</div>

	</div>	
</div>

<button class="btn btn-primary">{{ trans('app.save_changes') }}</button>


{!! Form::close() !!}
@endsection