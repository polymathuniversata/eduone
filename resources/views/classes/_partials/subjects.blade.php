<div class="subjects">
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h4 class="panel-title">
	    	Select subjects to be learned and match with teachers
	    </h4>
	  </div>
	  <div class="panel-body">
	  	@foreach($periods as $period)
			@if( ! empty($subjects[$period->id]))
		  	<table class="table">
		  		<thead>
		  			<tr>
		  				<th colspan="3">
		  					 <h4><input type="checkbox" class="panel-checkbox"> {{$period->name}}</h4>
		  				</th>
		  			</tr>
		  		</thead>
				@foreach($subjects[$period->id] as $subject)

				@if(in_array($subject->id, $class_subjects))
					<tr>
				@else
					<tr class="inactive">
				@endif
						<td>
							{!! Form::checkbox('subjects[]', $subject->id, in_array($subject->id, $class_subjects)) !!}
						</td>
						<td width="50%">	
							{{$subject['name']}}
						</td>
						<td>
							{!! Form::select('teachers['.$subject->id.']', $teachers, isset($subjects_teachers[$subject->id]) ? $subjects_teachers[$subject->id] : null, ['class' => 'form-control subject-teacher', 'placeholder' => 'Please select a teacher...']) !!}
						</td>
				</tr>
				@endforeach
		    </table>
			  	
			@endif
		@endforeach
	  	</div>
	</div>
</div><!--.subjects-->

<button class="btn btn-primary">Save Changes</button>