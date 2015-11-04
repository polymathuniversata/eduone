@extends('master')

@section('content')
<h1>{!! trans('app.programs') !!} <a href="/programs/create" class="btn btn-default">{!! trans('app.add_new') !!}</a></h1>

<div class="panel panel-default table-responsive">
	<table class="table table-hover">
		<thead class="panel-heading">
			<tr>
				<th>{!! trans('app.name') !!}</th>
				<th>{!! trans('app.slug') !!}</th>
				<th>{{ trans('app.creator') }}</th>
				<th>{!! trans('app.student_count') !!}</th>
			</tr>
		</thead>
		<tbody>
			@if (count($programs) > 0)
				@foreach ($programs as $program)
				<tr>
					<td class="table-title"><a href="/programs/{!! $program->id !!}/edit">{!! $program->name !!}</a></td>
					<td>{!! $program->slug !!}</td>
					<td>{{ $program->creator->getFullName() }}</td>
					<td>{!! count( $program->students ) !!}</td>
				</tr>
				@endforeach
			@else
			<tr>
				<td colspan="4">
					<div class="alert alert-warning">
						Get started by creating a new program
					</div>
				</td>
			</tr>
			@endif
		</tbody>
	</table>
</div>
{!! $programs->render() !!}

@endsection