@extends('master')

@section('content')
<h1>{!! trans('app.programs') !!} <a href="/programs/create" class="btn btn-default">{!! trans('app.add_new') !!}</a></h1>

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>{!! trans('app.name') !!}</th>
			<th>{!! trans('app.slug') !!}</th>
			<th>{!! trans('app.grade_type') !!}</th>
			<th>{!! trans('app.student_count') !!}</th>
		</tr>
	</thead>
	<tbody>
		@if (count($programs) > 0)
			@foreach ($programs as $program)
			<tr>
				<td><input type="checkbox"></td>
				<td><a href="/programs/{!! $program->id !!}/edit">{!! $program->name !!}</a></td>
				<td>{!! $program->slug !!}</td>
				<td>{!! $program->grade_type !!}</td>
				<td>{!! count( $program->students ) !!}</td>
			</tr>
			@endforeach
		@else
		<tr>
			<td colspan="6">
				<div class="alert alert-warning">
					Get started by creating a new program
				</div>
			</td>
		</tr>
		@endif
	</tbody>
</table>

@endsection