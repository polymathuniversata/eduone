<div class="form-group">
	{!! Form::label('name', trans('app.name')) !!}
	{!! Form::text('name', null, [
		'class' => 'form-control', 
		'placeholder' => trans('app.name')]) 
	!!}
</div>

<div class="form-group">
	{!! Form::label('program_id', trans('app.program')) !!}
	{!! Form::select('program_id', $programs, null, ['class' => 'form-control', 'placeholder' => 'Select a Program...']) !!}
</div>

<div class="form-group">
	{!! Form::label('email', trans('app.email')) !!}
	{!! Form::text('email', null, [
		'class' => 'form-control', 
		'placeholder' => trans('app.email')]) 
	!!}
	<div class="help-block">Class email, useful when you setup an email group or email forwarding</div>
</div>

<div class="form-group">
	<label for="started_at">Start Date</label>
	{!! Form::date('started_at', null, [
		'class' => 'form-control'
	]) !!}
</div>

<div class="form-group">
	<label for="finished_at">Finish Date</label>
	{!! Form::date('finished_at', null, [
		'class' => 'form-control'
	])!!}
</div>

<div class="form-group">
	<label for="branch_id">Branch</label>
	{!! Form::select('branch_id', $branches, null, [
		'class' 		=> 'form-control',
		'placeholder' 	=> 'Select Branch'
	])!!}
</div>

<div class="form-group">
	<label for="status">Status</label>
	{!! Form::select('status', config('settings.class_statuses'), null, [
		'class' 		=> 'form-control'
	])!!}
</div>

<button class="btn btn-primary">Save Changes</button>