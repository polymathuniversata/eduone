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
			<p class="text-muted">Click to Add</p>
			
			<div class="checkbox-list" id="subjects">
				<div class="checkbox" ng-repeat="(key, value) in subjects" ng-hide="alreadyAddedSubject.indexOf(key)!=-1">
					<label>
						<input type="checkbox" ng-click="addSubject(key)" ng-checked="false"> @{{value}}
					</label>
				</div>
			</div>
		</div>
	</div>
</aside>

<div class="col-md-8">

	<section class="panel panel-default" id="subject-orders">
		<header class="panel-heading">
			
			<button class="btn btn-primary btn-sm pull-right">{{trans('app.save_changes')}}</button>
			<div class="row">
			<div class="col-md-9">
			{!! Form::text('name', null, [
				'class' => 'form-control input-sm', 
				'placeholder' => 'Enter Program Name...']) 
			!!}
			</div>
			</div>

			<input type="hidden" name="periods" value="@{{periods}}">
			
		</header>
		<div class="panel-body">
			<p class="text-muted" ng-show="alreadyAddedSubject.length > 0">Drag subjects and periods to the order you want</p>
			<p class="text-muted" ng-show="alreadyAddedSubject.length == 0">Get started by adding subjects and periods from the right panes</p>

			<ul class="panel-group sortable list-unstyled" id="accordion" ui-sortable="sortableOptions" ng-model="periods">
				<li ng-repeat="item in periods track by $index" ng-click="setActiveField(item)">
				
				<div class="panel panel-default panel-@{{item.type}}">
				    <div class="panel-heading" role="tab">
				      	<h4 class="panel-title">
				      		<div class="btn-group pull-right">
							<button title="Delete" type="button" ng-show="$index != 0" ng-click="removeItem($index)" class="btn btn-xs btn-danger"><i class="typcn typcn-delete"></i></button>
							
							<a ng-show="item.type != 'period'" role="button" class="btn btn-default btn-xs" href="{{url('/subjects')}}/@{{item.id}}"><i class="typcn typcn-arrow-forward-outline" title="Go to Edit Subject"></i></a>
							
							<button title="Edit This Period" class="btn btn-default btn-xs" ng-show="item.type === 'period'" class="pull-right" data-toggle="collapse" data-parent="#accordion" href="#field-@{{$index}}" aria-expanded="true" aria-controls="field-@{{$index}}">
					          <i class="typcn typcn-pencil"></i>
					        </button>

							</div>
					      	<span ng-show="item.name">
					      		@{{item.name}}
					      	</span>

					       	<span ng-show="!item.name">
								@{{subjects[item.id]}}
					       	</span>
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

									<button type="button" class="btn btn-danger btn-xs" ng-show="$index != 0" ng-click="removeItem($index)">
										<i class="glyphicon glyphicon-trash"></i> Delete
									</button>
								</div>
				    		</div>
				      	</div>
				    </div>
			 	</div>
			 	</li>
		 	</ul><!--/panel-group-->
	 	</div><!--/panel-body-->
	</section>
</div>