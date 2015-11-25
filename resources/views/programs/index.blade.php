@extends('master')
@section('title', trans('app.programs'))
@section('main_title', trans('app.programs'))
@section('main_button')
 <a href="/programs/create" class="btn btn-default">{!! trans('app.add_new') !!}</a>
@endsection

@section('content')

<div class="row">
	@if (count($programs) > 0)
		@foreach ($programs as $program)
	  	<section class="card col-xs-6 col-sm-4 col-md-2">
	    	<header>
				<h2><a href="/programs/{{ $program->id }}">{{ $program->name }}</a></h2>
	    	</header>
	    	<div class="card-body">
	    		<table class="table">
					<tr>
						<th>Periods</th>
						<td>{{$program->periods->count()}}</td>
					</tr>
					<tr>
						<th>Subjects</th>
						<td>{{$program->subjects->count()}}</td>
					</tr>
					<tr>
						<th>Classes</th>
						<td>{{$program->classes->count()}}</td>
					</tr>
					<tr>
						<th>Students</th>
						<td>{{$program->students->count()}}</td>
					</tr>
					<tr>
						<th>Creator</th>
						<td>{{$program->creator->display_name}}</td>
					</tr>
				</table>
	    	</div>
	  	</section>
  		@endforeach
  	@else

  	@endif
</div>

@endsection