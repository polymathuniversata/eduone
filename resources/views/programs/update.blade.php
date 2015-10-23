@extends('master')

@section('title', trans('app.program_designer'))
@section('content')

<header>
	<h1>{!! trans('app.program_designer') !!}</h1>
</header>

{!! Form::open(['url' => 'programs']) !!}
	
	<div class="row">
		<div class="col-md-12 form-inline">
			<div class="form-group">
				{!! Form::label('name', trans('app.name')) !!}
					{!! Form::text('name', null, [
						'class' => 'form-control', 
						'placeholder' => trans('app.name')]) 
					!!}
			</div>

			<div class="form-group">
				{!! Form::label('slug', trans('app.slug')) !!}
				{!! Form::text('slug', null, [
					'class' => 'form-control', 
					'placeholder' => trans('app.slug')]) 
				!!}
			</div>

			<div class="form-group">
				{!! Form::label('grade_type', trans('app.grade_type')) !!}
				{!! Form::select('grade_type', config('settings.grade_types'), 'vi', 
					['class' => 'form-control'] ) !!}
			</div>
			
			<button class="btn btn-primary">{{trans('app.save_changes')}}</button>

		</div>	
	</div>

	<hr>

	<div class="row">
		<div class="col-md-3">
			<h4>Period #1</h4>
			<div class="list-group">
			  	<a href="#" class="list-group-item active">
			    	Computer Foundation
			  	</a>

			  	<a href="#" class="list-group-item">
			    	Basic C
			  	</a>

			  	<a href="#" class="list-group-item">
			    	Advanced C
			  	</a>

			  	<a href="#" class="list-group-item">
			    	HTML
			  	</a>

			  	<a href="#" class="list-group-item">
			    	+ Add Subject
			  	</a>
			</div>

		</div>


		<div class="col-md-9">
			<header>
				<h4>Subject Settings</h4>
			</header>

			<div class="subject-settings-form row">
				<div class="form-group col-md-4">
					<label for="">Subject Name</label>
					<input type="text" class="form-control" ng-model="active.name">
				</div>

				<div class="form-group col-md-4">
					<label for="">Slug</label>
					<input type="text" class="form-control" ng-model="active.slug">
				</div>

				<div class="form-group col-md-4">
					<label for="">Total Grade Rate</label>
					<input type="number" min="0" max="100" class="form-control" ng-model="active.slug">
				</div>

				<div class="form-group col-md-4">
					<label for="">Required Present Percent</label>
					<input type="number" min="0" max="100" class="form-control" ng-model="active.slug">
				</div>

				<div class="form-group col-md-4">
					<label for="">Required Grade to Pass</label>
					<input type="number" min="0" max="100" class="form-control" ng-model="active.slug">
				</div>

				<div class="form-group col-md-4">
				{!! Form::label('grade_type', trans('app.grade_type')) !!}
					{!! Form::select('grade_type', config('settings.grade_types'), 'vi', 
					['class' => 'form-control'] ) !!}
				</div>
			</div>
			
			<h4>Subject Detail</h4>
			<div class="subject-plan-form row">
				<div class="col-md-12">
					  	<ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Grade Plan</a></li>
					    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Session Plan</a></li>
					    <li role="presentation"><a href="#meta" aria-controls="meta" role="tab" data-toggle="tab">Custom Fields</a></li>
					 	</ul>

					  	<div class="tab-content">
					    	<div role="tabpanel" class="tab-pane active" id="home">
					    		
					    		<div class="grade-item form-inline">
						    		<div class="form-group">
						    			<label for="">Grade Name</label>
						    			<input type="text" ng-model="grade.name" class="form-control input-sm">
						    		</div>

						    		<div class="form-group">
						    			<label for="">Percent</label>
						    			<input type="number" ng-model="grade.name" class="form-control input-sm">
						    		</div>

						    		<div class="form-group">
						    			<label for="">Minimum</label>
						    			<input type="number" ng-model="grade.name" class="form-control input-sm">
						    		</div>

								</div><!--/grade-item-->

								<div class="grade-item form-inline">
						    		<div class="form-group">
						    			<label for="">Grade Name</label>
						    			<input type="text" ng-model="grade.name" class="form-control input-sm">
						    		</div>

						    		<div class="form-group">
						    			<label for="">Percent</label>
						    			<input type="number" ng-model="grade.name" class="form-control input-sm">
						    		</div>

						    		<div class="form-group">
						    			<label for="">Minimum</label>
						    			<input type="number" ng-model="grade.name" class="form-control input-sm">
						    		</div>

								</div><!--/grade-item-->

					    		<button class="btn btn-default">Add Grade</button>
					    	</div>

					    	<div role="tabpanel" class="tab-pane" id="profile">
					    		<div class="session-item">

					    			<div class="form-group">
						    			<label for="">Session Type</label>
						    			<select name="session_type" id="session_type" class="form-control input-sm">
						    				<option value="t">Theory</option>
						    				<option value="l">Lab</option>
						    				<option value="o">Outdoor</option>
						    				<option value="i">Internet</option>
						    				<option value="m">Mixed</option>
						    				<option value="e">Exam</option>
						    				<option value="t">Test</option>
						    			</select>
						    		</div>

						    		<div class="form-group">
						    			<label for="">Session Name</label>
						    			<input type="text" ng-model="grade.name" class="form-control input-sm">
						    		</div>

						    		<div class="form-group">
						    			<label for="">Session Description</label>
						    			<input type="text" ng-model="grade.name" class="form-control input-sm">
						    		</div>

								</div><!--/grade-item-->
					    	</div><!--/session-plan-->
					  	</div>
				</div>
			</div><!-- /subject-plan-->

		</div>
	</div>
	
{!! Form::close() !!}
@endsection