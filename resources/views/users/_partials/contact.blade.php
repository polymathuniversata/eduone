<div class="form-group">
	<label for="">{!! trans('app.email') !!}</label>
	{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('app.email')]) !!}
</div>

<div class="form-group">
	<label>{!! trans('app.phone') !!}</label>
	{!! Form::tel('phone', null, ['class' => 'form-control', 'placeholder' => trans('app.phone') ]) !!}
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