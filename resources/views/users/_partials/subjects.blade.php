@if ($user->isTeacher())

	<h4>Subjects</h4>
	<p class="text-muted">Select subjects which <strong>{{$user->getFullName()}}</strong> can teach. 
	If none of them selected, that means current teacher can teaches all subject.</p>
	
	<div class="checkboxes">
    	@foreach($subjects as $id => $name)
		<label class="checkbox label-thin subject-label">
			{!! Form::checkbox('subjects[]', $id ) !!}
			{{$name}}
		</label>
    	@endforeach
	</div>

@endif