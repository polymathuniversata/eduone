@extends('master')

@section('title', trans('app.all_users'))

@section('main_title')
    @if(isset($roles[$request->role]))
    {{ $roles[$request->role] }}
    @else
    {{ trans('app.users') }}
    @endif

    <span class="badge">
        {{$users->total()}}
    </span>
@endsection

@section('main_button')
    @if(isset($request->role))
    <a href="/users/create/?role={{$request->role}}" role="button" class="btn btn-default">Add New</a>
    @else
    <a href="/users/create" role="button" class="btn btn-default">Add New</a>
    @endif
@endsection

@section('search_box')
    {!! Form::model($request, ['url' => '/users', 'method' => 'GET']) !!}
    <div class="input-group" id="advanced-search">
        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Enter search terms']) !!}
        
        <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Show Advanced Search Options">
                <span class="caret"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="row">
                    <div class="form-group col-md-6">
                        {!! Form::label('role_id', 'Role') !!}
                        {!! Form::select('role_id', $roles, null, ['class' => 'form-control', 'placeholder' => 'Select a Role']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::label('branch_id', 'Branch') !!}
                        {!! Form::select('branch_id', $branches, null, ['class' => 'form-control', 'placeholder' => 'Select a Branch']) !!}
                    </div>
                </div>
                
                <div class="row row-margin-md">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-right"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection


@section('content')

<div class="table-responsive panel panel-default">
    <table class="table table-hover">
    	<thead class="panel-heading">
    		<tr>
    			<th><input type="checkbox"></th>
    			<th>{{ trans('app.name') }}</th>
    			<th>{{ trans('app.email') }}</th>
                 @if( ! isset($request->role))
    			<th>{{ trans('app.role') }}</th>
                @endif
    			<th>{{ trans('app.status') }}</th>
    			<th>{{ trans('app.created_at') }}</th>
    		</tr>
    	</thead>

    	<tbody>
            @if ($users->count() > 0)
        		@foreach ($users as $user)
        		<tr>
        			<td><input type="checkbox" disabled></td>
        			<td class="table-title"> <img src="{!! $user->profile_picture !!}" width="32" height="32" alt="Profile Picture"> <a href="/users/{{$user->id}}">
                        {{ $user->display_name }}</a>
                    </td>
        			<td><a href="/users/{{$user->id}}">{{ $user->email }}</a></td>
                    
        			<td>@if ( ! isset($request->role) && isset($user->role->name))
                            {{ $user->role->name }}
                        @endif
                    </td>
        			
                    <td>
                        @if ( ! empty($user->status))
                        {!! $user->status !!}
                        @endif
                    </td>
        			<td>{!! $user->created_at !!}</td>
        		</tr>
        		@endforeach
            @else
                <tr>
                    <td colspan="7" class="">
                        <h4 class="text-muted text-center row-padding-md">There are no user with the search result. Please try with different keywords...</h4>
                    </td>
                </tr>
            @endif
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