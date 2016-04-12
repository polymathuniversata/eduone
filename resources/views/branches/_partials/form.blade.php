<div class="form-group">
	{!! Form::label('name', trans('app.branch_name')) !!}

	{!! Form::text('name', null, [
		'class' => 'form-control', 
		'placeholder' => trans('app.branch_name')]) 
	!!}
</div>

<div class="form-group">
	{!! Form::label('slug', trans('app.slug')) !!}

	{!! Form::text('slug', null, [
		'class' => 'form-control', 
		'placeholder' => trans('app.slug')]) 
	!!}
</div>

<div class="form-group">
	{!! Form::label('address', trans('app.address')) !!}
	
	{!! Form::textarea('address', null, [
		'class' => 'form-control', 
		'rows'	=> 3,
		'placeholder' => trans('app.address')]) 
	!!}
</div>

<div class="form-group">
	{!! Form::label('phone', trans('app.phone')) !!}
	
	{!! Form::tel('phone', null, [
		'class' => 'form-control', 
		'placeholder' => trans('app.phone')]) 
	!!}
</div>

<div class="form-group">
	{!! Form::label('email', trans('app.email')) !!}
	
	{!! Form::email('email', null, [
		'class' => 'form-control', 
		'placeholder' => trans('app.email')]) 
	!!}
</div>

<div class="form-group">
	{!! Form::label('administrator_id', trans('app.administrator')) !!}
	
	{!! Form::select('administrator_id', $administrators, null, ['class' => 'form-control', 'placeholder' => 'Pick an Administrator'] ) !!}
</div>

<button class="btn btn-primary">Save Changes</button>
