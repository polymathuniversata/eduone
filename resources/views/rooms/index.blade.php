@extends('master')

@section('content')
<h1>{!! trans('app.rooms') !!} <a href="/rooms/create" class="btn btn-default">{!! trans('app.add_new') !!}</a></h1>

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>{!! trans('app.name') !!}</th>
			<th>{!! trans('app.type') !!}</th>
			<th>{!! trans('app.capacity') !!}</th>
			<th>{!! trans('app.branch') !!}</th>
		</tr>
	</thead>
	<tbody>
		@if (count($rooms) > 0)
			@foreach ($rooms as $room)
			<tr>
				<td><input type="checkbox"></td>
				<td><a href="/rooms/{!! $room->id !!}/edit">{!! $room->name !!}</a></td>
				<td>{!! $room->type !!}</td>
				<td>{!! $room->capacity !!}</td>
				<td><a href="/users/1">{!! $room->branch_id !!}</a></td>
			</tr>
			@endforeach
		@else
		<tr>
			<td colspan="4">
				<div class="alert alert-warning">
					Get started by creating a new room
				</div>
			</td>
		</tr>
		@endif
	</tbody>
</table>

@endsection