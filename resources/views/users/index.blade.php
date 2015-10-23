@extends('master')

@section('title', trans('app.all_users'))
@section('content')
<header>
	<h1>{!! trans('app.users') !!} <a href="/users/create" class="btn btn-default">{!! trans('app.add_new') !!}</a></h1>
</header>

<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>{!! trans('app.name') !!}</th>
			<th>{!! trans('app.email') !!}</th>
			<th>{!! trans('app.role') !!}</th>
			<th>{!! trans('app.status') !!}</th>
			<th>{!! trans('app.created_at') !!}</th>
			<th>{!! trans('app.login_as') !!}</th>
		</tr>
	</thead>

	<tbody>
		@foreach ($users as $user)
		<tr>
			<td><input type="checkbox" disabled></td>
			<td><a href="/users/{{$user->id}}">{!! $user->name !!}</a></td>
			<td><a href="/users/{{$user->id}}">{{ $user->email }}</a></td>
			<td>{{ $user->role->name }}</td>
			<td>{!! $user->status !!}</td>
			<td>{!! $user->created_at !!}</td>
			<td><a href="/login-as/{{$user->id}}">{!! trans('app.login_as') !!}</a></td>
		</tr>
		@endforeach
	</tbody>
</table>

<!-- Button trigger modal -->
<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">{!! trans('app.mass_update') !!}</button>
<button type="button" class="btn btn-default btn-sm">{!! trans('app.import') !!}...</button>
<button type="button" class="btn btn-default btn-sm">{!! trans('app.export') !!}...</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{!! trans('app.mass_update') !!}</h4>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        	<div class="alert alert-warning">
        		{!! trans('app.user_mass_update_attention') !!}
        	</div>
        	<div class="form-group">
        		<label for="">{!! trans('app.select_a_property') !!}</label>
        		{!! Form::select('property', ['Role', 'State', 'Postcode', 'Country'], null, ['class' => 'form-control']) !!}
        	</div>
        	<div class="form-group">
        		<label for="">{!! trans('app.enter_value') !!}</label>
        		<input type="text" class="form-control">
        	</div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{!! trans('app.cancel') !!}</button>
        <button type="button" class="btn btn-primary">{!! trans('app.update') !!}</button>
      </div>
    </div>
  </div>
</div>
@endsection