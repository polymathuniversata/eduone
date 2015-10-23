@extends('master')

@section('title', trans('app.roles_and_permissions'))

@section('content')
<header>
	<h1>{!! trans('app.roles_and_permissions') !!} <a href="/roles/create" class="btn btn-default">{!! trans('app.add_new') !!}</a></h1>
</header>

<table class="table table-bordered table-condensed table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>{!! trans('app.role_name') !!}</th>
			<th>{!! trans('app.slug') !!}</th>
			<th>{!! trans('app.count') !!}</th>
			<th>{!! trans('app.created_at') !!}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($roles as $role)
		<tr>
			<td>
				<input type="checkbox" @if ($role->id < 5) disabled @endif>
			</td>
			<td><a href="/roles/edit/1">{!! $role->name !!}</a></td>
			<td><a href="/roles/edit/1">{!! $role->slug !!}</a></td>
			<td>{!! $role->count !!}</td>
			<td>{!! $role->created_at !!}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endsection