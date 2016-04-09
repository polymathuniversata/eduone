@extends('master')
@section('title', 'Grade Settings')
@section('main_title', 'Grade Settings')
@section('content')

<form action="">
	<div class="form-group">
		<label for="calculation_method">Grade Value</label>
		{!! Form::select('calculation_method', config('settings.calculation_method'), null, [
			'class' 		=> 'form-control'
		]); !!}
		<p class="help-block">
			This shows how we calculate the grade average<br>
			<dl>
				<dt>Percent</dt>
				<dd>Each grade is represent a percent of all grade. For example: Math <span class="badge">66%</span>, History <span class="badge">34%</span></dd>
				<dt>Coefficient</dt>
				<dd>Each grade is represent a level of all grade. For example: Math <span class="badge">2</span>, History <span class="badge">1</span></dd>
			</dl>
		</p>
	</div>


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