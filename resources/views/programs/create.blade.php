@extends('master')

@section('title', trans('app.create_new_program'))
@section('content')

<header>
	<h1>{!! trans('app.create_new_program') !!}</h1>
</header>

<script type="text/javascript">
	var subjects = {!! json_encode($subjects) !!};
</script>
<div class="row" ng-controller="ProgramController" ng-init="init()">
	<aside class="sidebar col-md-4 pull-right">
		<div class="panel panel-default">
			<div class="panel-heading">Periods</div>
			<div class="panel-body">
				<button type="button" class="btn btn-default btn-sm" ng-click="addPeriod()"> Add Period</button>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">Subjects</div>
			<div class="panel-body">
				<div class="checkbox-list" id="subjects">
					<div class="checkbox" ng-repeat="(key, value) in availableSubjects">
						<label>
							<input type="checkbox" ng-click="addSubject(key)"> @{{value}}
						</label>
					</div>
				</div>
			</div>
		</div>
	</aside>

	<div class="col-md-8">

		<div class="panel panel-default">
			<div class="panel-heading">
				{!! Form::open(['url' => 'programs', 'class' => 'form-horizontal']) !!}

				<button class="btn btn-primary btn-sm pull-right">{{trans('app.save_changes')}}</button>

				<div class="form-group">
					{!! Form::label('name', trans('app.name'), ['class' => 'col-md-1']) !!}
					<div class="col-md-7">
						{!! Form::text('name', null, [
							'class' => 'form-control input-sm', 
							'placeholder' => trans('app.name')]) 
						!!}
					</div>
				</div>
				<input type="hidden" name="builder_json" value="@{{cached_json}}">
				{!! Form::close() !!}
			</div>
			@{{checkedItems}}
			<div class="panel-body">
				<ul class="list-unstyled">
					<li ng-repeat="item in cached_json">
						@{{item.name}}
					</li>
				</ul>
			</div>
		</div>
	</div>
</div><!--.row-->

@endsection