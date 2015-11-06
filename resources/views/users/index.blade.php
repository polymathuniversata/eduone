@extends('master')

@section('title', trans('app.all_users'))

@section('main_title')
 {!! trans('app.users') !!}
@endsection

@section('search_box')
    {!! Form::model($request, ['url' => '/users', 'method' => 'GET']) !!}
    <div class="input-group" id="advanced-search">
        {!! Form::text('q', null, ['class' => 'form-control', 'placeholder' => 'Enter search terms']) !!}
        <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Show Advanced Search Options">
                <span class="caret"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="row">
                    <div class="form-group col-md-6">
                        {!! Form::label('role') !!}
                        {!! Form::select('role', $roles, null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::label('branch') !!}
                        {!! Form::select('branch', $branches, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
             
            </div>
            <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-search"></i></button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection

@section('main_button')
    <a href="/users/create" role="button" class="btn btn-success">Add New</a>
@endsection

@section('content')

<div class="table-responsive panel panel-default">
    <table class="table table-hover">
    	<thead class="panel-heading">
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
    			<td class="table-title"><a href="/users/{{$user->id}}">{!! $user->getFullName() !!}</a></td>
    			<td><a href="/users/{{$user->id}}">{{ $user->email }}</a></td>
    			<td>{{ $user->role->name }}</td>
    			<td>{!! $user->status !!}</td>
    			<td>{!! $user->created_at !!}</td>
    			<td><a href="/login-as/{{$user->id}}">{!! trans('app.login_as') !!}</a></td>
    		</tr>
    		@endforeach
    	</tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-2">
        <select name="bulk_action" id="bulk_action" class="form-control input-sm">
            <option value="">Bulk Action</option>
            <option value="delete">Delete</option>
            <option value="ban">Ban</option>
            <option value="export">Export</option>
        </select>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">{!! trans('app.mass_update') !!}</button>
    <button type="button" class="btn btn-default btn-sm">{!! trans('app.import') !!}...</button>
    <button type="button" class="btn btn-default btn-sm">{!! trans('app.export') !!}...</button>
    <button type="button" class="btn btn-danger btn-sm">{{ trans('app.delete') }}</button>
</div>

{!! $users->render() !!}

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