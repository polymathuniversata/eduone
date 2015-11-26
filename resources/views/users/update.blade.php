@extends('master')

@if ($request->tab === 'family')
	@section('header')
	<script type="text/javascript" src="{{ url('/assets/js/controllers/user-controller.js') }}"></script>
	@endsection
@endif

@section('title', trans('app.update_user'))

@section('content')

<header>
	<div id="profile-picture">
		<img src="{{$user->photo}}" alt="Profile Picture">
	
		<div role="button" id="update-profile-picture" data-toggle="modal" data-target="#update-profile-picture-modal">
			<i class="fa fa-camera-retro"></i> Update Profile Picture
		</div>
	</div>
	
	<h1>{{ $user->getFullName() }}</h1>
</header>

{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}

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
			@if(isset($request->tab) && in_array($request->tab, ['account', 'profile', 'family', 'contact', 'permissions', 'subjects', 'meta']))
				@include('users/_partials/' . $request->tab)
			@endif
	  	</div>

	</div>
</div>

<button class="btn btn-primary">{!! trans('app.save_changes') !!}</button>


@include('users/_partials/upload_photo')

{!! Form::close() !!}

@endsection