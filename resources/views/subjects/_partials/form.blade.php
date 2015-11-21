<div class="col-md-3">
	
	<div class="form-group">
		{!! Form::label('name', trans('app.name')) !!}
		{!! Form::text('name', null, [
			'class' => 'form-control', 
			'placeholder' => trans('app.name')]) 
		!!}
	</div>

	<div class="form-group">
		{!! Form::label('total_grade_rate', trans('app.total_grade_rate')) !!}
		{!! Form::number('total_grade_rate', null, [
			'class' => 'form-control', 
			'placeholder' => trans('app.total_grade_rate')]) 
		!!}
	</div>

	<div class="form-group">
		{!! Form::label('minimum_student_present_session', trans('app.minimum_student_present_session')) !!}
		{!! Form::number('minimum_student_present_session', null, [
			'class' => 'form-control', 
			'placeholder' => trans('app.minimum_student_present_session')]) 
		!!}
	</div>

	<div class="form-group">
		{!! Form::label('minimum_student_grade', trans('app.minimum_student_grade')) !!}
		{!! Form::number('minimum_student_grade', null, [
			'class' => 'form-control', 
			'placeholder' => trans('app.minimum_student_grade')]) 
		!!}
	</div>

	<div class="form-group">
		{!! Form::label('grade_type', trans('app.grade_type')) !!}
		{!! Form::select('grade_type', config('settings.grade_types'), 'vi', 
		['class' => 'form-control'] ) !!}
	</div>
	
	<div class="form-group">
		{!! Form::label('is_required', trans('app.is_required')) !!}
		{!! Form::checkbox('is_required', 1, null) !!}
	</div>

	<input type="hidden" name="grades_plan" value="@{{grades}}">
	<input type="hidden" name="sessions_plan" value="@{{sessions}}">

	<button class="btn btn-primary">{{trans('app.save_changes')}}</button>
</div>

<div class="col-md-9">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#grades" aria-controls="grades" role="tab" data-toggle="tab">Grades</a></li>
    <li role="presentation"><a href="#sessions" aria-controls="sessions" role="tab" data-toggle="tab">Sessions</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="grades">
    	<table class="table table-condensed">
    		<thead>
	    		<tr>
	    			<th>Grade Name</th>
	    			<th>Percent</th>
	    			<th>Minimum</th>
	    			<th></th>
	    		</tr>
    		</thead>
    		<tbody>
    			<tr ng-repeat="grade in grades">
    				<td><input type="text" ng-model="grade.name" class="form-control input-sm"></td>
    				<td><input type="number" ng-model="grade.percent" min="0" max="100" step="1" class="form-control input-sm"></td>
    				<td><input type="number" ng-model="grade.minimum" min="0" max="100" step="1" class="form-control input-sm"></td>
    				<td><button type="button" class="btn btn-default btn-sm" ng-click="removeGrade($index)"><i class="glyphicon glyphicon-trash"></i></button></td>
    			</tr>
    		</tbody>
    	</table>
    	<button type="button" class="btn btn-default btn-sm" ng-click="addGrade()"><i class="glyphicon glyphicon-plus-sign"></i></button>
    </div>
    <div role="tabpanel" class="tab-pane" id="sessions">
    	<table class="table table-condensed">
    		<thead>
    			<tr>
    				<th>Session Type</th>
    				<th>Session Name</th>
    				<th>Description</th>
    				<td></td>
    			</tr>
    		</thead>
    		<tbody>
    			<tr ng-repeat="session in sessions">
    				<td>
    					<select name="session.type" id="session_type" class="form-control input-sm">
		    				<option value="t">Theory</option>
		    				<option value="l">Lab</option>
		    				<option value="o">Outdoor</option>
		    				<option value="i">Internet</option>
		    				<option value="m">Mixed</option>
		    				<option value="e">Exam</option>
		    				<option value="t">Test</option>
		    			</select>
    				</td>
					<td><input type="text" ng-model="session.name" class="form-control input-sm"></td>
					<td><input type="text" ng-model="session.description" class="form-control input-sm"></td>
					<td><button type="button" class="btn btn-default btn-sm" ng-click="removeSession($index)"><i class="glyphicon glyphicon-trash"></i></button></td>
    			</tr>
    		</tbody>
    	</table>
    	<button type="button" ng-click="addSession()" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-plus-sign"></i></button>
    </div>
  </div>
</div>