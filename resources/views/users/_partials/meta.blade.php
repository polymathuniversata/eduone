<div class="panel panel-default">
  <div class="panel-body">
    <div class="row">
    	<div class="form-group col-md-6">
    		<label for="">{!! trans('app.meta_key') !!}</label>
    		<input type="text" class="form-control">
    	</div>
    	<div class="form-group col-md-6">
    		<label for="">{!! trans('app.value') !!}</label>
    		<textarea name="meta_value[]" class="form-control" rows="3"></textarea>
    	</div>
    </div>
  </div>
</div>
<button type="button" class="btn btn-sm btn-default">{!! trans('app.add_meta') !!}</button>