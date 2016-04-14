@extends('master')

@section('title', trans('app.all_classes'))
@section('main_title')
{!! trans('app.classes') !!}
<span class="badge">
    {{$classes->total()}}
</span>
@endsection

@section('main_button')
    <button class="btn btn-default" data-toggle="modal" data-target="#myModal">{!! trans('app.add_new') !!}</button>
@endsection

@section('search_box')
 {!! Form::model($request, ['url' => '/classes', 'method' => 'GET']) !!}
    <div class="input-group pull-right col-md-7" id="advanced-search">
        {!! Form::text('s', null, ['class' => 'form-control', 'placeholder' => 'Enter search terms']) !!}
        <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Show Advanced Search Options">
                <span class="caret"></span>
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="row">
                    <div class="form-group col-md-6">
                        {!! Form::label('program') !!}
                        {!! Form::select('program', $programs, null, ['class' => 'form-control', 'placeholder' => 'Select a Program']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::label('branch') !!}
                        {!! Form::select('branch', $branches, null, ['class' => 'form-control', 'placeholder' => 'Select a Branch']) !!}
                    </div>
                </div>
                
                <div class="row row-margin-md">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-search"></i></button>
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
    			<th>{{ trans('app.program') }}</th>
                <th>{{ trans('app.users_count') }}</th>
    			<th>{{ trans('app.status') }}</th>
    			<th>{{ trans('app.started') }}</th>
                <th>{{ trans('app.finished') }}</th>
    		</tr>
    	</thead>
    	<tbody>
            @if ($classes->count() > 0)
        		@foreach ($classes as $class)
        		<tr>
        			<td><input type="checkbox"></td>
        			<td class="table-title"><a href="/classes/{{$class->id}}">{{ $class->name }}</a></td>
        			<td><a href="/programs/{{$class->program->id}}">{{ $class->program->name }}</a></td>
                    <td><span class="badge">{{ $class->users_count }}</span></td>
        			<td>{{ $class->status }}</td>
        			<td>{{ $class->started_at }}</td>
                    <td>{{ $class->finished_at }}</td>
        		</tr>
        		@endforeach
            @else
                <tr>
                    <td colspan="7">
                        <h4 class="text-muted text-center row-padding-md">
                            There are no class match with your request. <br><br>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">{!! trans('app.create_new_class') !!}</button>
                        </h4>
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
    <button type="button" class="btn btn-default btn-sm">Go</button>
    <button type="button" class="btn btn-default btn-sm">{!! trans('app.import') !!}...</button>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        {!! Form::open(['url' => 'classes', 'class' => 'form-horizontal']) !!}

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">{!! trans('app.create_new_class') !!}</h4>
            </div>
            <div class="modal-body">    
                <div class="form-group">
                    {!! Form::label('name', trans('app.name'), ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::text('name', null, [
                            'class' => 'form-control', 
                            'placeholder' => trans('app.name')]) 
                        !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('program_id', trans('app.program'), ['class' => 'col-md-3 control-label']) !!}
                    <div class="col-md-9">
                        {!! Form::select('program_id', $programs, null, [
                            'class' => 'form-control', 
                            'placeholder' => 'Please select',
                            'ng-model'  => 'selectedProgram'
                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="started_at" class="col-md-3 control-label">Start Date</label>
                    <div class="col-md-9">
                        {!! Form::date('started_at', null, [
                            'class' => 'form-control'
                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="finished_at" class="col-md-3 control-label">Finish Date</label>
                    <div class="col-md-9">
                        {!! Form::date('finished_at', null, [
                            'class' => 'form-control'
                        ])!!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="branch_id" class="col-md-3 control-label">Branch</label>
                    <div class="col-md-9">
                        {!! Form::select('branch_id', $branches, null, [
                            'class'         => 'form-control'
                        ])!!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{!! trans('app.cancel') !!}</button>
                <button type="submit" class="btn btn-primary">{!! trans('app.create') !!}</button>
            </div>
        {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection