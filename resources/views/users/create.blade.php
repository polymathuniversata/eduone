@extends('master')

@section('title', trans('app.create_new_user'))
@section('content')
<header>
	<h1>{!! trans('app.create_new_user') !!}</h1>
</header>

{!! Form::open() !!}

<div class="row">
	<div class="col-md-6 basic">
		<h4>{!! trans('app.basic_information') !!}</h4>
		<hr>
		<div class="form-group">
			<label>{!! trans('app.user_name') !!}</label>
			{!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Enter User Name']) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.email') !!}</label>
			{!! Form::email('email', 'tan@fitwp.com', ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.role') !!}</label>
			{!! Form::select('role', ['Registered', 'Student', 'SRO', 'Parent', 'Teacher', 'Administrator', 'Super Administrator'], 1, ['class' => 'form-control'] ) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.first_name') !!}</label>
			{!! Form::text('fist_name', null, ['class' => 'form-control']) !!}
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
			<label>{!! trans('app.branch') !!}</label>
				{!! Form::select('branch', ['FPT Polytechnic Hanoi', 'FPT Polytechnic HCMC', 'FPT Polytechnic Hai Phong'], null, ['class' => 'form-control', 'multiple' => 'multiple' ]) !!}
		</div>

	</div>

	<div class="col-md-6 additional">
		<h4>{!! trans('app.additional_information') !!}</h4>
		
		<hr>
		
		<div class="form-group">
			<label>{!! trans('app.phone') !!}</label>
			{!! Form::tel('phone', null, ['class' => 'form-control', 'placeholder' => trans('app.phone') ]) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.date_of_birth') !!}</label>
			{!! Form::date('date_of_birth', null, ['class' => 'form-control', 'placeholder' => trans('app.date_of_birth') ]) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.gender') !!}</label>
			{!! Form::select('gender', config('settings.genders'), 'm', ['class' => 'form-control'] ) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.id_code_or_passport') !!}</label>
			{!! Form::text('id_code', null, ['class' => 'form-control', 'placeholder' => trans('app.id_code_or_passport') ]) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.roll_no') !!}</label>
			{!! Form::text('roll_no', null, ['class' => 'form-control', 'placeholder' => trans('app.roll_no') ]) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.facebook') !!}</label>
			{!! Form::text('facebook', null, ['class' => 'form-control', 'placeholder' => trans('app.facebook') ]) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.address') !!}</label>
			{!! Form::textarea('address', null, ['rows' => 3, 'class' => 'form-control', 'placeholder' => trans('app.address') ]) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.state_province') !!}</label>
			{!! Form::select('state', ['A', 'B', 'C'], null, ['class' => 'form-control', 'placeholder' => trans('app.state_province') ]) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.country') !!}</label>
			{!! Form::select('country', config('settings.countries'), null, ['class' => 'form-control', 'placeholder' => trans('app.country') ]) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.postcode') !!}</label>
			{!! Form::number('postcode', null, ['class' => 'form-control', 'placeholder' => trans('app.postcode') ]) !!}
		</div>

		<div class="form-group">
			<label>{!! trans('app.profile_picture') !!}</label>
			{!! Form::file('profile_picture', ['class' => 'form-control']) !!}
		</div>
	</div>
	
</div>

	<button class="btn btn-primary">Save Changes</button>


{!! Form::close() !!}
@endsection