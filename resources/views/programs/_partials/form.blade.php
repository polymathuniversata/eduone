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
			<small>Click to Add</small>
			<div class="row">
				<button type="button" class="btn btn-sm btn-default col-md-6" ng-click="addSubject(key)" ng-repeat="(key, value) in subjects">@{{value}}</button>
			</div>
		</div>
	</div>
</aside>

<div class="col-md-8">

	<section class="panel panel-default">
		<header class="panel-heading">
			
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
			<input type="hidden" name="periods" value="@{{periods}}">
			
		</header>
		
		<small>Drag subjects and periods to the order you want</small>

		<ul class="panel-group sortable list-unstyled" id="accordion" ui-sortable="sortableOptions" ng-model="periods">
			<li ng-repeat="item in periods track by $index" ng-click="setActiveField(item)">
			
			<div class="panel panel-default panel-@{{item.type}}">
			    <div class="panel-heading" role="tab">
			      <h4 class="panel-title">
			      	<span ng-show="item.name">
			      		@{{item.name}}
			      	</span>
			       <span ng-show="!item.name">
						@{{subjects[item.id]}}
			       </span>
			        <div class="btn-group pull-right" role="group">
					   <button ng-show="item.type" type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#field-@{{$index}}" aria-expanded="true" aria-controls="field-@{{$index}}">
				          <i class="glyphicon glyphicon-plus"></i>
				        </button>
						<button type="button" class="btn btn-xs" ng-click="removeItem($index)"><i class="glyphicon glyphicon-remove"></i></button>
					</div>
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
								<button type="button" class="btn btn-default btn-xs">Close</button>
								<button type="button" class="btn btn-danger btn-xs" ng-show="$index != 0">Delete</button>
							</div>
			    		</div>
			    		
			      	</div>
			    </div>
		 	</div>
		 	</li>
	 	</ul><!--/panel-group-->
	</section>
</div>