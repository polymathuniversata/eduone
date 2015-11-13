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
	
		<button ng-click="addMember()" class="btn btn-default btn-sm" type="button" data-toggle="modal" data-target="#myModal">Add</button>

		<div class="row">
			@foreach ($members as $member)
			<div class="col-md-6">
				<div class="media member">
				  <div class="media-left">
				    <a href="{{url('users/' . $member['id'])}}">
				      <img class="media-object" src="http://lorempixel.com/100/100" alt="{{$member['name']}}">
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
						@else
						<i class="fa fa-check" title="{{$member['role']}}"></i>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <header class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add People to Class</h4>
      </header>
      <div class="modal-body">
        <div class="alert alert-warning">
        	Enter user id, or email, or roll no, separated by commas.
        </div>
        <input type="text" class="form-control" name="users" placeholder="Who do you want to add to this class?">
      </div>
      <footer class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm">Add</button>
      </footer>
    </div>
  </div>
</div>
@endsection