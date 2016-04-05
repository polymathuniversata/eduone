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
			{!! Form::select('role_id', $roles, isset($request->role) ? $request->role : null, [
				'class' => 'form-control', 
				'placeholder' => 'Please select',
				'ng-model' => 'role_id'
				]) 
			!!}
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
		</div>

		<div class="form-group">
			<label>{!! trans('app.password_confirmation') !!}</label>
			{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
		</div>
		
		<div class="form-group" ng-show="role_id != 1">
			<label>{!! trans('app.branches') !!}</label>
			<br>
			<div class="checkbox">
			@foreach ($branches as $id => $branch)
				<label class="checkbox-inline">
					{!! Form::checkbox('branches[]', $id) !!} {{$branch}}
				</label>
			@endforeach
			</div>
		</div>
		
		<div class="form-group" ng-show="role_id == 4">
			<label for="roll_no">{{ trans('app.roll_no') }}</label>
			{!! Form::text('roll_no', null, ['class' => 'form-control']) !!}
		</div>
	</div>	
</div>

<button class="btn btn-primary">{{ trans('app.save_changes') }}</button>