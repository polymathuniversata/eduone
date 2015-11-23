<p>You can override role permission by using user permission here</p>
@foreach ($permissions as $group)
<header>
	<h5>{!! $group['group'] !!}</h5>
	@foreach ($group['permissions'] as $permission)
	<label class="checkbox-inline label-thin permission-label">
		{!! Form::checkbox('permissions[' . $permission . ']', 1 ) . ' ' . $permission !!}
	</label>
	@endforeach
</header>
@endforeach