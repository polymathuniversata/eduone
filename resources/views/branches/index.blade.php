@extends('master')
@section('title', 'Branches')
@section('main_title', 'Branches')

@section('content')

<div class="row">
	<div class="col-md-4">
		<h4>Add New Branch</h4>
		{!! Form::open(['url' => 'branches']) !!}
			<div class="form-group">
				{!! Form::label('name', trans('app.branch_name')) !!}

				{!! Form::text('name', null, [
					'class' 		=> 'form-control', 
					'placeholder' 	=> trans('app.branch_name')]) 
				!!}
			</div>

			<div class="form-group">
				{!! Form::label('slug', trans('app.slug')) !!}

				{!! Form::text('slug', null, [
					'class' 		=> 'form-control', 
					'placeholder' 	=> trans('app.slug')]) 
				!!}

				<span class="help-block">Unique, lowercase, do not contains special characters</span>
			</div>

			<div class="form-group">
				{!! Form::label('phone', trans('app.phone')) !!}
				
				{!! Form::tel('phone', null, [
					'class' => 'form-control', 
					'placeholder' => trans('app.phone')]) 
				!!}
			</div>

			<div class="form-group">
				{!! Form::label('email', trans('app.email')) !!}
				
				{!! Form::email('email', null, [
					'class' => 'form-control', 
					'placeholder' => trans('app.email')]) 
				!!}
			</div>

			<div class="form-group">
				{!! Form::label('administrator_id', trans('app.administrator')) !!}
				
				{!! Form::select('administrator_id', $administrators, 1, ['class' => 'form-control', 'placeholder' => 'Pick an Administrator'] ) !!}
			</div>

			<button class="btn btn-primary">Save Changes</button>

		{!! Form::close() !!}
	</div>

	<div class="col-md-8">
		<h4>Branches</h4>
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
							<td>{{ $branch->slug }}</td>
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
	</div>
</div>

@endsection