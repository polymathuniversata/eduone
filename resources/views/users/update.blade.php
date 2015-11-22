@extends('master')

@section('title', trans('app.update_user'))

@section('content')

<header>
	<div class="thumbnail" id="profile-thumbnail">
		<img src="{{$user->getPhoto()}}" alt="Profile Photo">
	</div>
	<h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
</header>

{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}

<div class="row">
	<div class="col-md-12">
	  <!-- Nav tabs -->
	  <ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Overview</a></li>
	    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Contact</a></li>
	    <li role="presentation"><a href="#permissions" aria-controls="permissions" role="tab" data-toggle="tab">Permissions</a></li>
	    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Meta</a></li>
	  </ul>

	  <!-- Tab panes -->
	  <div class="tab-content col-md-9">
	    <div role="tabpanel" class="tab-pane active" id="home">
	    	<div class="form-group">
	    		<label for="">{!! trans('app.name') !!}</label>
	    		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.name')]) !!}
	    	</div>

	    	<div class="form-group">
	    		<label for="">{!! trans('app.first_name') !!}</label>
	    		{!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => trans('app.first_name')]) !!}
	    	</div>

	    	<div class="form-group">
	    		<label for="">{!! trans('app.last_name') !!}</label>
	    		{!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => trans('app.last_name')]) !!}
	    	</div>

			<div class="form-group">
				<label>{!! trans('app.role') !!}</label>
				{!! Form::select('role_id', $roles, null, ['class' => 'form-control'] ) !!}
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
				<label>{!! trans('app.branches') !!}</label>
				{!! Form::select('branches[]', $branches, $user_branches, [
					'class' => 'form-control', 
					'multiple' => 'multiple'
				]) !!}
			</div>
			
			@if ($user->isStudent())
			<div class="form-group">
				{!! Form::label('programs', 'Programs') !!}

				{!! Form::select('programs[]', $programs, $user_programs, [
					'class' => 'form-control', 
					'multiple' => 'multiple'
				]) !!}
			</div>
			@endif

	    </div>
	    <div role="tabpanel" class="tab-pane" id="profile">
	    	<div class="form-group">
	    		<label for="">{!! trans('app.email') !!}</label>
	    		{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('app.email')]) !!}
	    	</div>
	    	
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
				{!! Form::select('gender', config('settings.genders'), null, ['class' => 'form-control'] ) !!}
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

	   	<div role="tabpanel" class="tab-pane" id="permissions">
			<p>You can override role permission by using user permission here</p>
			@foreach ($permissions as $group)
			<header>
				<h5>{!! $group['group'] !!}</h5>
				@foreach ($group['permissions'] as $permission)
				<label class="checkbox-inline label-thin permission-label">
					{!! Form::checkbox('permissions[' . $permission . ']', 1 ) . ' ' . $permission !!}
				</label>
				@endforeach
			</header>
			@endforeach
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