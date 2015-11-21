@extends('master')
@section('title', 'Rooms')
@section('main_title', 'Rooms')
@section('content')

<div class="table-responsive panel panel-default">
	<table class="table table-striped table-hover">
		<thead class="panel-heading">
			<tr>
				<th>Room Name</th>
				<th>{!! trans('app.type') !!}</th>
				<th>{!! trans('app.capacity') !!}</th>
				<th>{!! trans('app.branch') !!}</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@if (count($rooms) > 0)
				@foreach ($rooms as $room)
				<tr>
					<td><a href="/rooms/{!! $room->id !!}/edit">{!! $room->name !!}</a></td>
					<td>{!! $room->type !!}</td>
					<td>
						<span class="badge">
							{{ $room->capacity }}
						</span>
					</td>
					<td><a href="/users/1">{!! $room->branch->name !!}</a></td>
					<td>
						<a href="/rooms/{{ $room->id }}/" class="btn btn-default"><i class="fa fa-pencil"></i></a>
						<button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
					</td>
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
</div>

@endsection