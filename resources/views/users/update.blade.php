@extends('master')

@section('title', trans('app.update_user'))

@section('content')

<header>
	<h1>{!! trans('app.update_user') !!}</h1>
</header>

{!! Form::open() !!}

<div class="row">
	<div class="col-md-12">
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Overview</a></li>
	    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Contact</a></li>
	    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Meta</a></li>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content col-md-9">
	    <div role="tabpanel" class="tab-pane active" id="home">
	    	<div class="form-group">
	    		<label for="">{!! trans('app.user_name') !!}</label>
	    		{!! Form::text('user_name', 'tan', ['class' => 'form-control', 'placeholder' => trans('app.user_name')]) !!}
	    	</div>

	    	<div class="form-group">
	    		<label for="">{!! trans('app.first_name') !!}</label>
	    		{!! Form::text('first_name', 'tan', ['class' => 'form-control', 'placeholder' => trans('app.first_name')]) !!}
	    	</div>

	    	<div class="form-group">
	    		<label for="">{!! trans('app.last_name') !!}</label>
	    		{!! Form::text('last_name', 'tan', ['class' => 'form-control', 'placeholder' => trans('app.last_name')]) !!}
	    	</div>

	    	<div class="form-group">
	    		<label for="">{!! trans('app.email') !!}</label>
	    		{!! Form::email('email', 'tan', ['class' => 'form-control', 'placeholder' => trans('app.email')]) !!}
	    	</div>

			<div class="form-group">
				<label>{!! trans('app.role') !!}</label>
				{!! Form::select('role', ['Registered', 'Student', 'SRO', 'Parent', 'Teacher', 'Administrator', 'Super Administrator'], 1, ['class' => 'form-control'] ) !!}
			</div>


	    	<div class="form-group">
	    		<label for="">{!! trans('app.password') !!}</label>
	    		{!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('app.password')]) !!}
	    	</div>

	    	<div class="form-group">
	    		<label for="">{!! trans('app.password_confirmation') !!}</label>
	    		{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('app.password_confirmation')]) !!}
	    	</div>


			<div class="form-group">
				<label>{!! trans('app.branch') !!}</label>
				{!! Form::select('branch', ['FPT Polytechnic Hanoi', 'FPT Polytechnic HCMC', 'FPT Polytechnic Hai Phong'], null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
			</div>

	    </div>
	    <div role="tabpanel" class="tab-pane" id="profile">
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
				<label>{!! trans('app.parents') !!} multiple</label>
				{!! Form::select('parents', config('settings.countries'), null, ['class' => 'form-control', 'placeholder' => trans('app.parents') ]) !!}
			</div>

			<div class="form-group">
				<label>{!! trans('app.profile_picture') !!}</label>
				{!! Form::file('profile_picture', ['class' => 'form-control']) !!}
			</div>
	    </div>

	    <div role="tabpanel" class="tab-pane" id="messages">
	    	<div class="panel panel-default">
			  <div class="panel-body">
			    <div class="row">
			    	<div class="form-group col-md-6">
			    		<label for="">{!! trans('app.meta_key') !!}</label>
			    		<input type="text" class="form-control">
			    	</div>
			    	<div class="form-group col-md-6">
			    		<label for="">{!! trans('app.value') !!}</label>
			    		<textarea name="meta_value[]" class="form-control" rows="3"></textarea>
			    	</div>
			    </div>
			  </div>
			</div>
			<button type="button" class="btn btn-sm btn-default">{!! trans('app.add_meta') !!}</button>
	    </div>
	  </div>

	</div>
</div>

<button class="btn btn-primary">{!! trans('app.save_changes') !!}</button>

{!! Form::close() !!}
@endsection