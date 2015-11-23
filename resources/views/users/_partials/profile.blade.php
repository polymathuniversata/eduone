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

@if ($user->isStudent())
<div class="form-group">
	<label>{!! trans('app.roll_no') !!}</label>
	{!! Form::text('roll_no', null, ['class' => 'form-control', 'placeholder' => trans('app.roll_no') ]) !!}
</div>
@endif

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
