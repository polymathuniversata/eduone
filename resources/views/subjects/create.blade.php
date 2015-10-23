@extends('master')

@section('title', trans('app.create_new_subject'))
@section('content')

<header>
	<h1>{!! trans('app.create_new_subject') !!}</h1>
</header>

<div class="row">

	<div class="col-md-3">
		{!! Form::open(['url' => 'subjects']) !!}
			
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

			<button class="btn btn-primary">{{trans('app.save_changes')}}</button>

		{!! Form::close() !!}
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

	    	<div class="form-group col-md-4">
    			<label for="">Grade Name</label>
    			<input type="text" ng-model="grade.name" class="form-control input-sm">
    		</div>

    		<div class="form-group col-md-4">
    			<label for="">Percent</label>
    			<input type="number" ng-model="grade.name" class="form-control input-sm">
    		</div>

    		<div class="form-group col-md-4">
    			<label for="">Minimum</label>
    			<input type="number" ng-model="grade.name" class="form-control input-sm">
    		</div>
	    </div>
	    <div role="tabpanel" class="tab-pane" id="sessions">
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
	    </div>
	  </div>
	</div>
</div>
@endsection