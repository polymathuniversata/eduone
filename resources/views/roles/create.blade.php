@extends('master')

@section('title', 'New Role')

@section('content')
<header>
	<h1>Create New Role</h1>
</header>

<form action="/">
	<div class="form-group">
		<label for="name">Role Name</label>
		<input type="text" class="form-control" placeholder="Enter Role Name...">
	</div>

	<div class="form-group">
		<label for="slug">Slug</label>
		<input type="text" class="form-control" placeholder="Enter Role Name...">
	</div>

	<hr>

	<h4>Permissions</h4>

	<section class="permissions">
		<header>
			<h5>Global</h5>
			<label class="checkbox-inline label-thin">
				<input type="checkbox"> Super Admin
			</label>
		</header>

		<header>
			<h5>Settings</h5>
			<label class="checkbox-inline label-thin">
				<input type="checkbox"> Manage Settings
			</label>
		</header>


		<header>
			<h5>Users</h5>
			<label class="checkbox-inline label-thin">
				<input type="checkbox"> List
			</label>

			<label class="checkbox-inline label-thin">
				<input type="checkbox"> Create
			</label>

			<label class="checkbox-inline label-thin">
				<input type="checkbox"> Update
			</label>

			<label class="checkbox-inline label-thin">
				<input type="checkbox"> Self Update
			</label>

			<label class="checkbox-inline label-thin">
				<input type="checkbox"> Delete
			</label>

			<label class="checkbox-inline label-thin">
				<input type="checkbox"> Import
			</label>

			<label class="checkbox-inline label-thin">
				<input type="checkbox"> Export
			</label>
		</header>

		<header>
			<h5>Rooms</h5>
			<label class="checkbox-inline label-thin">
				<input type="checkbox"> List
			</label>
			<label class="checkbox-inline label-thin">
				<input type="checkbox"> Create
			</label>

			<label class="checkbox-inline label-thin">
				<input type="checkbox"> Update
			</label>

			<label class="checkbox-inline label-thin">
				<input type="checkbox"> Delete
			</label>

			<label class="checkbox-inline label-thin">
				<input type="checkbox"> Import
			</label>

			<label class="checkbox-inline label-thin">
				<input type="checkbox"> Export
			</label>
		</header>

	</section>

	<button class="btn btn-primary">Save Changes</button>

</form>	
@endsection