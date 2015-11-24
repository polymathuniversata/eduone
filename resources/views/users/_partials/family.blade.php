<h4>Add Family Members</h4>

{!! Form::text('family', null, [
	'class' => 'form-control',
	'placeholder' => 'Add family member id, separated by commas'
]) !!}

@if ($user->isParent())
	

@endif

@if ($user->isStudent())

@endif