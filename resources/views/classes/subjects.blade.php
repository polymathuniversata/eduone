@extends('master')

@section('title', $class->name)
@section('main_title', $class->name)
@section('content')

<ul class="nav nav-tabs">
    <li role="presentation"><a href='{!! url("/classes/$class->id") !!}' aria-controls="basic">Basic Info</a></li>
    <li role="presentation"><a href='{!! url("/classes/$class->id") !!}/members' aria-controls="members">Members</a></li>
    <li role="presentation" class="active"><a href='{!! url("/classes/$class->id") !!}/subjects' aria-controls="subjects">Subjects</a></li>
</ul>

<div class="row" ng-controller="ClassController">
	{!! Form::model($class, ['route' => ['classes.update', $class->id], 'method' => 'PUT', 'class' => 'col-md-6']) !!}

	<div class="subjects">
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h4 class="panel-title">
		    	Select subjects to be learned and match with teachers
		    </h4>
		  </div>
		  <div class="panel-body">
		  	@foreach($periods as $period)
				@if( ! empty($subjects[$period->id]))
			  	<table class="table">
			  		<thead>
			  			<tr>
			  				<th colspan="3">
			  					 <h4><input type="checkbox" class="panel-checkbox"> {{$period->name}}</h4>
			  				</th>
			  			</tr>
			  		</thead>
					@foreach($subjects[$period->id] as $subject)
					<tr>
					<td>
						{!! Form::checkbox('subjects[]', $subject->id, in_array($subject->id, $class_subjects)) !!}
					</td>
					<td>	
						{{$subject['name']}}
					</td>
					<td>
						{!! Form::select('teachers['.$subject->id.']', $teachers, null, ['class' => 'form-control']) !!}
					</td>
					</tr>
					@endforeach
			    </table>
				  	
				@endif
			@endforeach
		  	</div>
		</div>
	</div><!--.subjects-->
	
	<button type="submit" class="btn btn-primary">Save Changes</button>
	{!! Form::close() !!}
</div>
@endsection