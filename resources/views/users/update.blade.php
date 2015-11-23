@extends('master')

@section('title', trans('app.update_user'))

@section('content')

<header>
	<div id="profile-picture">
		<img src="{{$user->getPhoto()}}" alt="Profile Picture">
	
		<div role="button" id="update-profile-picture" data-toggle="modal" data-target="#update-profile-picture-modal">
			<i class="fa fa-camera-retro"></i> Update Profile Picture
		</div>
	</div>
	
	<h1>{{ $user->getFullName() }}</h1>
</header>

{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}

<div class="row">
	<div class="col-md-12">

	  	<!-- Nav tabs -->
	  	<ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="{{ $request->tab === 'account' ? 'active' : ''  }}"><a href="?tab=account">Account Settings</a></li>
		    <li role="presentation" class="{{ $request->tab === 'profile' ? 'active' : ''  }}"><a href="?tab=profile">Profile</a></li>
		    <li role="presentation" class="{{ $request->tab === 'contact' ? 'active' : ''  }}"><a href="?tab=contact">Contact</a></li>
		    @if ($user->isStudent() || $user->isParent())
		    <li role="presentation" class="{{ $request->tab === 'family' ? 'active' : ''  }}"><a href="?tab=family">Family &amp; Relationship</a></li>
		    @endif
		    <li role="presentation" class="{{ $request->tab === 'permissions' ? 'active' : ''  }}"><a href="?tab=permissions">Permissions</a></li>
		    @if ($user->isTeacher())
		    <li role="presentation" class="{{ $request->tab === 'subjects' ? 'active' : ''  }}"><a href="?tab=subjects">Subjects</a></li>
			@endif
	  	</ul>

	  	<!-- Tab panes -->
	  	<div class="col-md-9">
			@if(isset($request->tab) && in_array($request->tab, ['account', 'profile', 'contact', 'permissions', 'subjects', 'meta']))
				@include('users/_partials/' . $request->tab)
			@endif
	  	</div>

	</div>
</div>

<button class="btn btn-primary">{!! trans('app.save_changes') !!}</button>

{!! Form::close() !!}


<!-- Modal -->
<div class="modal fade" id="update-profile-picture-modal" tabindex="-1" role="dialog" aria-labelledby="update-profile-picture-modal-label">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="update-profile-picture-modal-label">Update Profile Picture</h4>
	      	</div>
	      	<div class="modal-body">
		        <span class="btn btn-lg btn-default btn-file col-md-6 text-center">
				    <i class="fa fa-upload"></i> Upload Photo <input type="file">
				</span>
				<br><br><br>
		        or
				<br><br><br>
		        <h5>Browse on Photo Library</h5>
		        <input type="text" name="browse_photo" id="browse_photo" class="form-control" placeholder="Enter image url or keyword to search...">

	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        	<button type="button" class="btn btn-primary">Update</button>
	      	</div>
	    </div>
  	</div>
</div>

@endsection