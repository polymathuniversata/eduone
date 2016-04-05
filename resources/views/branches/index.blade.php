@extends('master')
@section('title', 'All Branches')
@section('main_title', 'All Branches')
@section('main_button')
<a href="/branches/create" class="btn btn-default">{!! trans('app.add_new') !!}</a>
@endsection

@section('content')

<div class="table-responsive panel panel-default">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Branch Name</th>
				<th>Slug</th>
				<th>Administrator</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@if (count($branches) > 0)
				@foreach ($branches as $branch)
				<tr>
					<td><a href="{{url('/')}}/branches/{{ $branch->id }}/edit">{{ $branch->name }}</a></td>
					<td>{{ $branch->email }}</td>
					<td><a href="{{url('/')}}/users/1">{{ $branch->admin->getFullName() }}</a></td>
					<td>
						<a href="{{url('/')}}/branches/{{ $branch->id }}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
						<button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
					</td>
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
</div>

@endsection