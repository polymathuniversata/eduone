@extends('master')

@section('content')
<h1>{!! trans('app.subjects') !!} <a href="/subjects/create" class="btn btn-default">{!! trans('app.add_new') !!}</a></h1>

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>{!! trans('app.name') !!}</th>
			<th>{!! trans('app.slug') !!}</th>
			<th>{!! trans('app.period') !!}</th>
			<th>{!! trans('app.grades_count') !!}</th>
			<th>{!! trans('app.sessions_count') !!}</th>
		</tr>
	</thead>
	<tbody>
		@if (count($subjects) > 0)
			@foreach ($subjects as $subject)
			<tr>
				<td><input type="checkbox"></td>
				<td><a href="/subjects/{!! $subject->id !!}/edit">{!! $subject->name !!}</a></td>
				<td>{!! $subject->slug !!}</td>
				<td>{!! $subject->program->name !!}</td>
				<td>{!! $subject->period !!}</td>
				<td><a href="/users/1">{!! $subject->grades_count !!}</a></td>
				<td><a href="/users/1">{!! $subject->sessions_count !!}</a></td>
			</tr>
			@endforeach
		@else
		<tr>
			<td colspan="7">
				<div class="alert alert-warning">
					Get started by creating a new subject
				</div>
			</td>
		</tr>
		@endif
	</tbody>
</table>

@endsection