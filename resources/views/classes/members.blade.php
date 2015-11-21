@extends('master')

@section('title', $class->name)
@section('main_title', $class->name)
@section('content')

@include('classes/_partials/tabs', ['active' => 2])

<div class="row" ng-controller="MemberController">
	<div class="col-md-7 members">
	
		<button ng-click="addMember()" class="btn btn-default btn-sm" type="button" data-toggle="modal" data-target="#myModal">Add</button>

		<div class="row">
			@foreach ($class->users as $user)
			<div class="col-md-6">
				<div class="media member">
				  <div class="media-left">
				    <a href="{{url('users/' . $user->id)}}">
				      <img class="media-object" src="{!! $user->getPhoto() !!}" alt="{{$user->getFullName()}}">
				    </a>
				  </div>
				  <div class="media-body">
				    <h4 class="media-heading">
				    	<a href="{{url('users/' . $user->id)}}">{{$user->getFullName()}}</a> 
				    </h4>
				    <small class="text-muted">{{$user->email}}</small>
				    <div class="text-muted"><small>Joined since 01/01/2014</small></div>
				  </div>
				  <div class="media-actions media-right">
				  	<div class="btn-group">
					  <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					  	@if (in_array($user->role_id, [3]))
						<i class="fa fa-star" title="{{$user->role->name}}"></i>
						@else
						<i class="fa fa-check" title="{{$user->role->name}}"></i>
						@endif
					    {{$user->role->name}} <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					    <li><a href="#" ng-click="setRole()">Set as Student</a></li>
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
  		{!! Form::model($class, ['route' => ['classes.update', $class->id], 'method' => 'PUT']) !!}
    	<div class="modal-content">

		    <header class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Add People to Class</h4>
		    </header>
		    <div class="modal-body">
		        <div class="alert alert-warning">
		        	Enter user id, user name, or email, or roll no, separated by commas.
		        </div>
		        <input type="text" class="form-control" name="users" placeholder="Who do you want to add to this class?">
		    </div>
	      	<footer class="modal-footer">
	        	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
	        	<button type="submit" class="btn btn-primary btn-sm">Add</button>
	      	</footer>
    		
    	</div>
    	{!! Form::close() !!}
  	</div>
</div>
@endsection