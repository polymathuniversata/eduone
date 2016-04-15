<div class="form-group">
	<label>{!! trans('app.date_of_birth') !!}</label>
	{!! Form::date('date_of_birth', null, ['class' => 'form-control', 'placeholder' => trans('app.date_of_birth') ]) !!}
</div>

<div class="form-group">
	<label>{!! trans('app.gender') !!}</label>
	{!! Form::select('gender', config('settings.genders'), null, ['class' => 'form-control'] ) !!}
</div>

<div class="form-group">
	<label>{!! trans('app.identity_number') !!}</label>
	{!! Form::text('identity_number', null, ['class' => 'form-control', 'placeholder' => trans('app.identity_number') ]) !!}
</div>

@if ($user->isStudent())
<div class="form-group">
	<label>{!! trans('app.roll_no') !!}</label>
	{!! Form::text('roll_no', null, ['class' => 'form-control', 'placeholder' => trans('app.roll_no') ]) !!}
</div>
@endif