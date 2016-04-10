@extends('master')
@section('title', 'Grade Settings')
@section('main_title', 'Grade Settings')
@section('content')

<form action="">
	
	<h2>Grade Converter</h2>

	<table class="table table-striped pane">
		<thead>
			<tr>
				<th>Grade Name</th>
				<th>Mark Range</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Exellence</td>
				<td>90 - 100</td>
				<td><button class="btn btn-default btn-xs">Remove</button></td>
			</tr>
			<tr>
				<td>Great</td>
				<td>75 - 89</td>
				<td><button class="btn btn-default btn-xs">Remove</button></td>

			</tr>
			<tr>
				<td>Ngon</td>
				<td>60 - 74</td>
				<td><button class="btn btn-default btn-xs">Remove</button></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="4"><button class="btn btn-default btn-sm">Add New Grade</button></td>
			</tr>
		</tfoot>
	</table>

</form>


@endsection