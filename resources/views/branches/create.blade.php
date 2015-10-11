@extends('master')

@section('content')

<header>
	<h1>Create New Branch</h1>
</header>

{!! Form::open(['url' => 'branches', 'class' => 'form-horizontal']) !!}

<form action="/" class="form-horizontal">
	<div class="form-group">
		{!! Form::label('name', trans('branch_name'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::text('name', null, [
				'class' => 'form-control', 
				'placeholder' => trans('branch_name')]) 
			!!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('address', trans('address'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::textarea('address', null, [
				'class' => 'form-control', 
				'rows'	=> 3,
				'placeholder' => trans('address')]) 
			!!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('phone', trans('phone'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::number('phone', null, [
				'class' => 'form-control', 
				'placeholder' => trans('phone')]) 
			!!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('email', trans('email'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::email('email', null, [
				'class' => 'form-control', 
				'placeholder' => trans('email')]) 
			!!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('language', trans('language'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::select('language', config('settings.languages'), 'en_UK', 
			['class' => 'form-control'] ) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('currency', trans('currency'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::select('currency', config('settings.currencies'), 'en_UK', 
			['class' => 'form-control'] ) !!}

		</div>
	</div>
	
	<div class="form-group">
		{!! Form::label('country', trans('country'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::select('country', config('settings.countries'), 'VN', ['class' => 'form-control'] ) !!}
		</div>
	</div>

	<div class="form-group">
		<label for="input-title" class="col-sm-2">State / Province</label>
		<div class="col-sm-6">
			<select name="state" id="state" class="form-control">
				<option value="hn">Hanoi</option>
				<option value="hcmc">HCM City</option>
				<option value="hp">Hai Phong</option>
				<option value="dn">Danang</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('postcode', trans('postcode'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::number('postcode', null, [
				'class' => 'form-control', 
				'placeholder' => trans('postcode')]) 
			!!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('administrator_id', trans('administrator'), ['class' => 'col-md-2']) !!}
		<div class="col-md-6">
			{!! Form::select('administrator_id', $users, null, ['class' => 'form-control', 'placeholder' => 'Pick an Administrator'] ) !!}

		</div>
	</div>

	<button class="btn btn-primary">Save Changes</button>

{!! Form::close() !!}
@endsection