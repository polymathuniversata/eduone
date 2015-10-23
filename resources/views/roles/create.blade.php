@extends('master')

@section('title', trans('app.create_new_role'))

@section('content')
<header>
	<h1>{!! trans('app.create_new_role') !!}</h1>
</header>

{!! Form::open(['url' => 'roles']) !!}

	<div class="form-group">
		<label for="name">Role Name</label>

		{!! Form::text('name', null, [
				'class' => 'form-control', 
				'placeholder' => trans('app.name')]) 
		!!}
	</div>

	<div class="form-group">
		<label for="slug">Slug</label>
		{!! Form::text('slug', null, [
				'class' => 'form-control', 
				'placeholder' => trans('app.slug')]) 
		!!}
	</div>

	<hr>

	<h4>{!! trans('app.permissions') !!}</h4>

	<section class="permissions">
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
	</section>

	<button class="btn btn-primary">{!! trans('app.save_changes') !!}</button>

{!! Form::close() !!}
@endsection