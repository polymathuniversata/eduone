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
			
			<ul class="panel-group sortable list-unstyled" id="accordion" ui-sortable="sortableOptions" ng-model="cached_json">
				<li ng-repeat="item in cached_json" ng-click="setActiveField(item)">
				<div class="panel panel-default panel-@{{item.type}}">
				    <div class="panel-heading" role="tab">
				      <h4 class="panel-title">
				        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#field-@{{$index}}" aria-expanded="true" aria-controls="field-@{{$index}}">
				          @{{item.name}}
				        </a>
				      </h4>
				    </div>
				    <div id="field-@{{$index}}" class="panel-collapse collapse @{{active==field}}" role="tabpanel" ng-if="item.type">
				      	<div class="panel-body">
				    		<div class="row">
								<div class="form-group col-md-6">
									<label> Period Name
									<input type="text" ng-model="item.name" class="form-control">
									</label>
								</div>
								<div class="form-group col-md-6">
										<label>Weight
									<input type="number" ng-model="item.weight" class="form-control">
									</label>
								</div>
								<div class="col-md-12">
									<button class="btn btn-default btn-xs">Close</button>
									<button class="btn btn-danger btn-xs" ng-show="$index != 0">Delete</button>
								</div>
				    		</div>
				    		
				      	</div>
				    </div>
			 	</div>
			 	</li>
		 	</ul><!--/panel-group-->
		</div>
	</div>
</div><!--.row-->

@endsection