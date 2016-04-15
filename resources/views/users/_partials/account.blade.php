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

@if ( ! isset($request->role_id))
<div class="form-group">
	<label>{!! trans('app.role') !!}</label>
	{!! Form::select('role_id', $roles, null, ['class' => 'form-control'] ) !!}
</div>
@endif

@if (isset($request->role_id) && ! isset($user))
<input type="hidden" name="role_id" value="{{$request->role_id}}">
@endif

<div class="form-group">
	<label for="">{!! trans('app.password') !!}</label>
	{!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('app.password')]) !!}
</div>

<div class="form-group">
	<label for="">{!! trans('app.password_confirmation') !!}</label>
	{!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('app.password_confirmation')]) !!}
</div>

@if ($request->role_id > 1)
<div class="form-group">
	<label>{!! trans('app.branches') !!}</label>
	<br>
	<div class="checkbox">
	@foreach ($branches as $id => $branch)
		<label class="checkbox-inline">
			{!! Form::checkbox('branches[]', $id, null) !!} {{$branch}}
		</label>
	@endforeach
	</div>
</div>
@endif

@if ($user->isStudent())
<div class="form-group">
	<label>{!! trans('app.programs') !!}</label>
	<br>
	<div class="checkbox">
	@foreach ($programs as $id => $program)
		<label class="checkbox-inline">
			{!! Form::checkbox('programs[]', $id, null) !!} {{$program}}
		</label>
	@endforeach
	</div>
</div>
@endif