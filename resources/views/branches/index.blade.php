@extends('master')

@section('content')
<h1>{!! trans('app.branches') !!} <a href="/branches/create" class="btn btn-default">{!! trans('app.add_new') !!}</a></h1>

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Branch Name</th>
			<th>Slug</th>
			<th>Administrator</th>
		</tr>
	</thead>
	<tbody>
		@if (count($branches) > 0)
			@foreach ($branches as $branch)
			<tr>
				<td><input type="checkbox"></td>
				<td><a href="/branches/{!! $branch->id !!}/edit">{!! $branch->name !!}</a></td>
				<td>{!! $branch->email !!}</td>
				<td><a href="/users/1">{!! $branch->admin->first_name . ' ' . $branch->admin->last_name !!}</a></td>
			</tr>
			@endforeach
		@else
		<tr>
			<td colspan="4">
				<div class="alert alert-warning">
					Get started by creating a new branch
				</div>
			</td>
		</tr>
		@endif
	</tbody>
</table>

@endsection