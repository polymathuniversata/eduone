<!-- Modal -->
<div class="modal fade" id="update-profile-picture-modal" tabindex="-1" role="dialog" aria-labelledby="update-profile-picture-modal-label">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="update-profile-picture-modal-label">Update Profile Picture</h4>
	      	</div>
	      	<div class="modal-body">
		        <h5>Upload from Computer</h5>
		        {!! Form::file('photo', ['class' => 'form-control', 'placeholder' => 'Start Upload...']) !!}
				
				
				<br><br><br>
		        or
				<br><br><br>
		        <h5>Browse on Photo Library</h5>
		        <input type="text" name="browse_photo" id="browse_photo" class="form-control" placeholder="Enter image url or keyword to search...">

	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        	<button type="submit" class="btn btn-primary">Update</button>
	      	</div>
	    </div>
  	</div>
</div>
