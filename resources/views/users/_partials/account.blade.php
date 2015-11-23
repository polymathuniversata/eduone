<div role="tabpanel" class="tab-pane active" id="basic">
	<div class="form-group">
		<label for="">{!! trans('app.user_name') !!}</label>
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.user_name')]) !!}
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