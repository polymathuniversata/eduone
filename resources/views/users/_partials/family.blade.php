<script>

var searchParams = {};

@if ($user->isParent())
	searchParams.role_id = 4;
	searchParams.not_in = {{$user->childrens->pluck('id')->toJson() }};
@elseif ($user->isStudent())
	searchParams.role_id = 5;
	searchParams.not_in = {{$user->parents->pluck('id')->toJson() }};
@endif
</script>
<div class="form-group" ng-controller="UserController" ng-init="init()">
	
	<div class="col-md-6">
		@if ($user->isStudent())
		<h4>Parents</h4>
		@else
		<h4>Childrens</h4>
		@endif
		<ul class="list-unstyled" id="queue-users-list">
			
			@if ($user->familyMembers()->count() > 0)
				@foreach ($user->familyMembers() as $member)
				<li>
					<img src="{!! $member->photo !!}"> {{ $member->display_name }}

					<a class="btn btn-default btn-xs pull-right" href="{{url('/')}}/users/{{$user->id}}/remove-family-member/{{$member->id}}">
						<i class="fa fa-times"></i>
					</a>
				</li>
				@endforeach
			@else
				<li class="not-found"><h4>Start adding family members by typing in the search box below</h4></li>
			@endif


			<li ng-repeat="user in queue track by $index">
				<img ng-src="@{{user.photo}}"> @{{user.display_name}} 

				<button class="btn btn-default btn-xs pull-right" ng-click="removeQueueUser($index)">
					<i class="fa fa-times"></i> 
				</button>
			</li>
		</ul>
	</div>

	<div class="clearfix"></div>
	<br><br><br>
	<div class="col-md-6">
		<label for="search-family-member">
		@if ($user->isStudent())
		<h4>Add Parents</h4>
		@else
		<h4>Add Childrens</h4>
		@endif
		</label>

		<input id="search-family-member" type="text" class="form-control" ng-model="search" ng-model-options="{debounce: 500}" placeholder="Search for user and click to add...">

		<ul class="list-unstyled" id="ajax-users-list">
			<li ng-repeat="user in users track by $index" ng-click="addUser($index)">
				<img ng-src="@{{user.photo}}"> @{{user.display_name}}
			</li>
			<li class="not-found" ng-show="users.length == 0 && search.length > 0">Sorry we cannot found any user.</li>
		</ul>

		<input type="hidden" name="family_members" value="@{{queue}}">
	</div>

</div>