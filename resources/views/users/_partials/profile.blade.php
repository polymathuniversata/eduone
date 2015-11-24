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

@if ($user->isStudent())
<div class="form-group">
	<label>{!! trans('app.roll_no') !!}</label>
	{!! Form::text('roll_no', null, ['class' => 'form-control', 'placeholder' => trans('app.roll_no') ]) !!}
</div>
@endif