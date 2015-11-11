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
		@foreach($periods as $period)
		
		<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><input type="checkbox" class="panel-checkbox"> {{$period->name}}</h3>
		  </div>
		  <div class="panel-body">
		    @if( ! empty($subjects[$period->id]))
				@foreach($subjects[$period->id] as $subject)
				<div class="checkbox">
					<label>
						{!! Form::checkbox('subjects[]', $subject->id, in_array($subject->id, $class_subjects)) !!}
						{{$subject['name']}}
					</label>
				</div>
				@endforeach
		    @endif
		  </div>
		</div>

		@endforeach
	</div><!--.subjects-->
	
	<button type="submit" class="btn btn-primary">Save Changes</button>
	{!! Form::close() !!}
</div>
@endsection