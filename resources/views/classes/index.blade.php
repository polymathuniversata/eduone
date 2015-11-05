@extends('master')

@section('title', trans('app.all_classes'))
@section('content')
<header>
    {!! Form::model($request, ['url' => '/classes', 'method' => 'GET']) !!}
    <div class="input-group pull-right col-md-7" id="advanced-search">
        {!! Form::text('q', null, ['class' => 'form-control', 'placeholder' => 'Enter search terms']) !!}
        <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Show Advanced Search Options">
                <span class="caret"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="row">
                    <div class="form-group col-md-6">
                        {!! Form::label('program') !!}
                        {!! Form::select('program', $programs, null, ['class' => 'form-control']) !!}
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

    <h1>{!! trans('app.classes') !!} <a href="/classes/create" class="btn btn-default">{!! trans('app.add_new') !!}</a></h1>

</header>

<div class="table-responsive panel panel-default">
    <table class="table table-hover">
    	<thead class="panel-heading">
    		<tr>
    			<th>#</th>
    			<th>{!! trans('app.name') !!}</th>
    			<th>{!! trans('app.program') !!}</th>
                <th>{{ trans('app.subjects') }}</th>
    			<th>{!! trans('app.teachers') !!}</th>
    			<th>{!! trans('app.status') !!}</th>
    			<th>{!! trans('app.created_at') !!}</th>
    		</tr>
    	</thead>
    	<tbody>
    		@foreach ($classes as $class)
    		<tr>
    			<td><input type="checkbox" disabled></td>
    			<td class="table-title"><a href="/classes/{{$class->id}}">{{ $class->name }}</a></td>
    			<td><a href="/programs/{{$class->program->id}}">{{ $class->program->name }}</a></td>
    			<td>
                    @if ( is_array($class->getSubjects()))
                        @foreach ($class->getSubjects() as $id => $name)
                            {{$name}}
                        @endforeach
                    @endif
                </td>
                <td></td>
    			<td>{!! $class->status !!}</td>
    			<td>{!! $class->created_at !!}</td>
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