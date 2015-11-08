@extends('master')
@section('title', trans('app.subjects'))
@section('main_title', trans('app.subjects'))
@section('main_button', '<a href="/subjects/create" class="btn btn-default">'. trans('app.add_new') . '</a>')
@section('search_box')
	{!! Form::model($request, ['url' => 'subjects', 'method' => 'GET']) !!}
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
                </div>
            </div>
            <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-search"></i></button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
@section('content')

<div class="table-responsive panel panel-default">
	<table class="table table-hover">
		<thead class="panel-heading">
			<tr>
				<th>#</th>
				<th>{!! trans('app.name') !!}</th>
				<th>{!! trans('app.slug') !!}</th>
				<th>{!! trans('app.grades_count') !!}</th>
				<th>{!! trans('app.sessions_count') !!}</th>
			</tr>
		</thead>
		<tbody>
			@if (count($subjects) > 0)
				@foreach ($subjects as $subject)
				<tr>
					<td><input type="checkbox"></td>
					<td class="table-title"><a href="/subjects/{!! $subject->id !!}/edit">{{ $subject->name }}</a></td>
					<td>{{ $subject->slug }}</td>
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
</div>

@endsection