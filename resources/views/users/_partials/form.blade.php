<div class="row">
	<div class="col-md-6 basic">
		<div class="form-group">
			<label>{!! trans('app.user_name') !!}</label>
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Enter User Name']) !!}
			<span class="help-block">Unique, lowercase, do not contains special characters</span>
		</div>

		<div class="form-group">
			<label>{!! trans('app.email') !!}</label>
			{!! Form::email('email', null, ['class' => 'form-control']) !!}
		</div>
		
		@if (isset($roles))
		<div class="form-group">
			<label>{!! trans('app.role') !!}</label>
			{!! Form::select('role_id', $roles, null, ['class' => 'form-control'] ) !!}
		</div>
		@endif

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
		
		<div class="form-group">
			<label for="roll_no">{{ trans('app.roll_no') }}</label>
			{!! Form::text('roll_no', null, ['class' => 'form-control']) !!}
		</div>
	</div>	
</div>

<button class="btn btn-primary">{{ trans('app.save_changes') }}</button>