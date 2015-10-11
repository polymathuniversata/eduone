@extends('master')

@section('title', 'Roles &amp; Permissions')

@section('content')
<header>
	<h1>Roles &amp; Permissions <a href="/roles/create" class="btn btn-default">Add New</a></h1>
</header>

<table class="table table-bordered table-condensed table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Role Name</th>
			<th>Slug</th>
			<th>Count</th>
			<th>Created at</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><input type="checkbox"></td>
			<td><a href="/roles/edit/1">Registered</a></td>
			<td><a href="/roles/edit/1">registered</a></td>
			<td>98</td>
			<td>July 1, 2015</td>
		</tr>
		<tr>
			<td><input type="checkbox"></td>
			<td><a href="/roles/edit/1">Parent</a></td>
			<td><a href="/roles/edit/1">parent</a></td>
			<td>956</td>
			<td>July 1, 2015</td>
		</tr>
		<tr>
			<td><input type="checkbox"></td>
			<td><a href="/roles/edit/1">Teacher</a></td>
			<td><a href="/roles/edit/1">teacher</a></td>
			<td>39</td>
			<td>July 1, 2015</td>
		</tr>
		<tr>
			<td><input type="checkbox"></td>
			<td><a href="/roles/edit/1">SRO</a></td>
			<td><a href="/roles/edit/1">sro</a></td>
			<td>0</td>
			<td>July 1, 2015</td>
		</tr>
		<tr>
			<td><input type="checkbox"></td>
			<td><a href="/roles/edit/1">Student</a></td>
			<td><a href="/roles/edit/1">student</a></td>
			<td>984</td>
			<td>July 1, 2015</td>
		</tr>
		<tr>
			<td><input type="checkbox" disabled></td>
			<td><a href="/roles/edit/1">Super Administrator</a></td>
			<td><a href="/roles/edit/1">super_administrator</a></td>
			<td>1</td>
			<td>July 1, 2015</td>
		</tr>
		<tr>
			<td><input type="checkbox"></td>
			<td><a href="/roles/edit/1">Administrator</a></td>
			<td><a href="/roles/edit/1">administrator</a></td>
			<td>3</td>
			<td>July 1, 2015</td>
		</tr>
	</tbody>
</table>
@endsection