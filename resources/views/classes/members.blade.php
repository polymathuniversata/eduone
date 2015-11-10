@extends('master')

@section('title', $class->name)
@section('main_title', $class->name)
@section('content')

<ul class="nav nav-tabs">
    <li role="presentation"><a href='{!! url("/classes/$class->id") !!}' aria-controls="basic">Basic Info</a></li>
    <li role="presentation" class="active"><a href='{!! url("/classes/$class->id") !!}/members' aria-controls="members">Members</a></li>
    <li role="presentation"><a href='{!! url("/classes/$class->id") !!}/subjects' aria-controls="subjects">Subjects</a></li>
</ul>

<div class="row" ng-controller="ClassController">
	<div class="col-md-7 members">
		<div class="row">
			@foreach ($members as $member)
			<div class="col-md-6">
				<div class="media member">
				  <div class="media-left">
				    <a href="{{url('users/' . $member['id'])}}">
				      <img class="media-object" src="{{$member['photo']}}" alt="{{$member['name']}}">
				    </a>
				  </div>
				  <div class="media-body">
				    <h4 class="media-heading">
				    	<a href="{{url('users/' . $member['id'])}}">{{$member['name']}}</a> 
				    </h4>
				    <small class="text-muted">{{$member['email']}}</small>
				    <div class="text-muted"><small>Joined since 01/01/2014</small></div>
				  </div>
				  <div class="media-actions media-right">
				  	<div class="btn-group">
					  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  	@if (in_array($member['role'],['Teacher']))
						<i class="fa fa-star" title="{{$member['role']}}"></i>
						@endif
					    {{$member['role']}} <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					    <li><a href="#">Set as Student</a></li>
					    <li><a href="#">Set as Teacher</a></li>
					    <li role="separator" class="divider"></li>
					    <li><a href="#">Promote...</a></li>
					    <li role="separator" class="divider"></li>
					    <li><a href="#">Drop Out</a></li>
					  </ul>
					</div><!--btn-group-->
				  </div>
				</div>
			</div>
			@endforeach
		</div>
	</div><!--.members-->
</div>
@endsection