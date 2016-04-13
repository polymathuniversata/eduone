<script>
	var searchParams = {
		role_id: '3,4',
		not_in_group: {{$class->id}}
	};
</script>
<script type="text/javascript" src="{{ url('/assets/js/controllers/user-controller.js') }}"></script>

<div class="members">

@if ( count($class->users) > 0 )
	<button ng-click="addMember()" class="btn btn-default btn-sm" type="button" data-toggle="modal" data-target="#myModal">Invite</button>
<div class="row">
	@foreach ($class->users as $index => $user)
	
	<div class="col-md-6">
		<div class="media member">
		  <div class="media-left">
		    <a href="{{url('users/' . $user->id)}}">
		      <img class="media-object" width="100" height="100" src="{!! $user->photo !!}" alt="{{$user->getFullName()}}">
		    </a>
		  </div>
		  <div class="media-body">
		    <h4 class="media-heading">
		    	<a href="{{url('users/' . $user->id)}}">{{$user->display_name}}</a> 
		    </h4>
		    <small class="text-muted">{{$user->email}}</small>
		    <div class="text-muted"><small>Joined since {{$class->users[$index]->created_at->format('Y-m-d') }}</small></div>
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
			    <li><a href="{{url('users/' . $user->id)}}">View Profile</a></li>
			    
			    @if ($user->isStudent())
			    <li role="separator" class="divider"></li>
			    <li><a href="#">Promote...</a></li>
			    @endif

			    <li role="separator" class="divider"></li>
			    <li><a href="{{url('classes/' . $class->id . '?remove=' . $user->id)}}">Remove</a></li>
			  </ul>
			</div><!--btn-group-->
		  </div>
		</div>
	</div>
	@endforeach
</div><!--.row-->
@else
<div class="alert alert-warning">
	<p>
		Start this class by <a href="#" role="button" type="button" data-toggle="modal" data-target="#myModal">Inviting members</a>
	</p>
</div>
@endif
</div><!--.members-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" ng-controller="UserController" ng-init="init()">
	<div class="modal-dialog" role="document">
		
	<div class="modal-content">

	    <header class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Invite People to Class</h4>
	    </header>
	    <div class="modal-body">
	        <div class="row">
	        	<div class="col-md-6">
	        		<input type="text" class="form-control" name="search_users" ng-model="search" ng-model-options="{debounce: 500}" placeholder="Search people and click to add...">
	        		
	        		<ul class="list-unstyled" id="ajax-users-list">
	        			<li ng-repeat="user in users track by $index" ng-click="addUser($index)">
	        				<img ng-src="@{{user.photo}}"> @{{user.display_name}}
	        			</li>
	        			<li class="not-found" ng-show="users.length == 0">Sorry we cannot found any user.</li>
	        		</ul>
	        	</div>
	        	
	        	<div class="col-md-6">
	        		<h4>People in queue <span class="badge">@{{queue.length}}</span></h4>
	        		<ul class="list-unstyled" id="queue-users-list">
	        			<li ng-repeat="user in queue track by $index">
	        				<img ng-src="@{{user.photo}}"> @{{user.display_name}} 

	        				<button class="btn btn-default btn-xs pull-right" ng-click="removeQueueUser($index)">
	        					<i class="fa fa-times"></i> 
	        				</button>
	        			</li>
	        		</ul>
	        	</div>
	        </div>
	    </div>
	  	<footer class="modal-footer">
	  		<input type="hidden" name="queue" value="@{{queue}}">
	    	<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
	    	<button type="submit" class="btn btn-primary btn-sm">Invite</button>
	  	</footer>
		
	</div>
</div><!--/modal-->