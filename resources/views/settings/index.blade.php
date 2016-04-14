@extends('master')

@section('main_title', trans('app.settings'))
@section('title', trans('app.settings'))

@section('content')

{!! Form::open(['url' => 'settings', 'class' => 'form-horizontal']) !!}

  	<!-- Nav tabs -->
  	<ul class="nav nav-tabs" role="tablist">
	    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
	    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Languages &amp; Regions</a></li>
	    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Contact Info</a></li>
	    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Privacy &amp; Policy</a></li>
	    <li role="presentation"><a href="#email" aria-controls="email" role="tab" data-toggle="tab">Email</a></li>
  	</ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
		
		<div class="form-group">
			{!! Form::label('title', 'App Title', ['class' => 'col-sm-2'] ) !!}
			<div class="col-sm-6">
				{!! Form::text('title', App\Setting::get('title', null), ['class' => 'form-control']) !!}
			</div>
		</div>

		<div class="form-group">
			<label for="enable_ssl" class="col-sm-2">SSL</label>
			<div class="col-sm-6">
				<label class="label-secondary">
					{!! Form::checkbox('enable_ssl') !!}
					 Enable SSL
				</label>
			</div>
		</div>

		<div class="form-group">
			<label for="email" class="col-sm-2">Administrator Email</label>
			<div class="col-sm-6">
				{!! Form::email('email', Setting::get('administrator_email'), [
					'class' => 'form-control',
					'id'	=> 'email'
				]) !!}				
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Logo</label>
			<div class="col-sm-6">
				<input type="file" class="form-control">
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Fav Icon</label>
			<div class="col-sm-6">
				<input type="file" class="form-control">
			</div>
		</div>

    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
    	<div class="form-group">
			<label for="input-title" class="col-sm-2">Language</label>
			<div class="col-sm-6">
				{!! Form::select('language', config('settings.languages'), 'en_UK', ['class' => 'form-control'] ) !!}
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">User language</label>
			<div class="col-sm-6">
				<label class="checkbox-inline">
					<input type="checkbox"> Allows users choose their language
				</label>
			</div>
		</div>
		
		<div class="form-group">
			<label for="input-title" class="col-sm-2">Currency</label>
			<div class="col-sm-6">
				{!! Form::select('currency', config('settings.currencies'), 'USD', ['class' => 'form-control'] ) !!}
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Timezone</label>
			<div class="col-sm-6">
				<select class="form-control">
					<option value="on">Bangkok/Hanoi/Jakarta</option>
					<option value="on">Africa</option>
					<option value="on">Brisbane</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Date Format</label>
			<div class="col-sm-6">
				<fieldset>
					<label title="F j, Y"><input type="radio" name="date_format" value="F j, Y" checked="checked"> October 8, 2015</label><br>
					<label title="Y-m-d"><input type="radio" name="date_format" value="Y-m-d"> 2015-10-08</label><br>
					<label title="m/d/Y"><input type="radio" name="date_format" value="m/d/Y"> 10/08/2015</label><br>
					<label title="d/m/Y"><input type="radio" name="date_format" value="d/m/Y"> 08/10/2015</label><br>
					<label><input type="radio" name="date_format" id="date_format_custom_radio" value="\c\u\s\t\o\m"> Custom:</label>
					<input type="text" name="date_format_custom" id="date_format_custom" value="F j, Y" class="small-text"> <span class="screen-reader-text">example: </span><span class="example"> October 8, 2015</span> <span class="spinner"></span>
				</fieldset>
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Time Format</label>
			<div class="col-sm-6">
				<fieldset>
					<label title="g:i a"><input type="radio" name="time_format" value="g:i a"> 11:22 pm</label><br>
					<label title="H:i"><input type="radio" name="time_format" value="H:i"> 23:22</label><br>
					<label><input type="radio" name="time_format" id="time_format_custom_radio" value="\c\u\s\t\o\m"> Custom:</label>
					<input type="text" name="time_format_custom" id="time_format_custom" value="g:i A" class="small-text"> <span class="example"> 11:22 PM</span> <span class="spinner"></span>
					<p><a href="https://codex.wordpress.org/Formatting_Date_and_Time">Documentation on date and time formatting</a>.</p>
				</fieldset>
			</div>
		</div>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">
    	<div class="form-group">
			<label for="input-title" class="col-sm-2">Organization Name</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" value="FPT University">
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Address</label>
			<div class="col-sm-6">
				<textarea class="form-control">8 Ton That Thuyet, My Dinh, Tu Liem, Hanoi</textarea>
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Phone</label>
			<div class="col-sm-6">
				<input type="tel" class="form-control" value="0433940591">
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Email</label>
			<div class="col-sm-6">
				<input type="email" class="form-control" value="info@fpt.edu.vn">
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Country</label>
			<div class="col-sm-6">
				{!! Form::select('country', config('settings.countries'), 'VN', ['class' => 'form-control'] ) !!}
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">State / Province</label>
			<div class="col-sm-6">
				<select name="country" id="country" class="form-control">
					<option value="vn">Vietnam</option>
					<option value="vn">United Kingdom</option>
					<option value="vn">United State</option>
					<option value="vn">Australia</option>
					<option value="vn">Italia</option>
					<option value="vn">China</option>
					<option value="vn">Japan</option>
					<option value="vn">Korea</option>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<label for="input-title" class="col-sm-2">Postcode</label>
			<div class="col-sm-6">
				<input type="number" class="form-control" value="100000">
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Website</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" value="http://binaty.org">
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Facebook</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" value="http://facebook.com/binatyorg">
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Twitter</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" value="http://twitter.com/binatyorg">
			</div>
		</div>
    </div>

    <div role="tabpanel" class="tab-pane" id="settings">
    	<div class="form-group">
			<label for="input-title" class="col-sm-2">Membership</label>
			<div class="col-sm-6">
				<input type="checkbox" name="allow_registration"> Anyone can register
			</div>
		</div>

		<div class="form-group" ng-show="anyone_can_register==1">
			<label for="input-title" class="col-sm-2">Account Activation</label>
			<div class="col-sm-6">
				<select name="country" id="country" class="form-control">
					<option value="vn">Admin activation</option>
					<option value="vn">Activation by email</option>
					<option value="vn">No activation (immediate access)</option>
				</select>
			</div>
		</div>

		<div class="form-group" ng-show="anyone_can_register==1">
			<label for="input-title" class="col-sm-2">Default User Role</label>
			<div class="col-sm-6">
				<select name="country" id="country" class="form-control">
					<option value="vn">Student</option>
					<option value="vn">Parent</option>
					<option value="vn">Administrator</option>
					<option value="vn">Super Administrator</option>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Help Info</label>
			<div class="col-sm-6">
				<input type="checkbox" name="allow_registration"> Display help info
			</div>
		</div>

		<div class="form-group">
			<label for="input-title" class="col-sm-2">Strong Password</label>
			<div class="col-sm-6">
				<input type="checkbox" name="allow_registration"> Force users using strong password
			</div>
		</div>
    </div>

    <div role="tabpanel" class="tab-pane" id="email">
		<fieldset>

						
														<div class="form-group">

								<label for="driver" class="col-lg-3 control-label">

									Mail Driver

									
								</label>

								<div class="col-lg-6">

									<select class="form-control" name="driver" id="driver">
			<option value="mail">
			PHP mail()
		</option>
			<option value="smtp">
			SMTP
		</option>
			<option value="sendmail">
			Sendmail
		</option>
			<option value="mailgun">
			Mailgun
		</option>
			<option value="mandrill">
			Mandrill
		</option>
			<option value="log" selected="&quot;selected&quot;">
			Log
		</option>
	</select>

									<span class="help-block"></span>

								</div>

							</div>
														<div class="form-group">

								<label for="host" class="col-lg-3 control-label">

									Host Address

									
								</label>

								<div class="col-lg-6">

									<input class="form-control" type="text" name="host" id="host" value="smtp.mailgun.org">

									<span class="help-block"></span>

								</div>

							</div>
														<div class="form-group">

								<label for="port" class="col-lg-3 control-label">

									Host Port

									
								</label>

								<div class="col-lg-6">

									<input class="form-control" type="text" name="port" id="port" value="587">

									<span class="help-block"></span>

								</div>

							</div>
														<div class="form-group">

								<label for="encryption" class="col-lg-3 control-label">

									Encryption Protocol

									
								</label>

								<div class="col-lg-6">

									<select class="form-control" name="encryption" id="encryption">
			<option value="">
			Disabled
		</option>
			<option value="tls" selected="&quot;selected&quot;">
			TLS
		</option>
			<option value="ssl">
			SSL
		</option>
	</select>

									<span class="help-block"></span>

								</div>

							</div>
														<div class="form-group">

								<label for="from_address" class="col-lg-3 control-label">

									From Address

									
								</label>

								<div class="col-lg-6">

									<input class="form-control" type="text" name="from_address" id="from_address" value="">

									<span class="help-block"></span>

								</div>

							</div>
														<div class="form-group">

								<label for="from_name" class="col-lg-3 control-label">

									From Name

									
								</label>

								<div class="col-lg-6">

									<input class="form-control" type="text" name="from_name" id="from_name" value="">

									<span class="help-block"></span>

								</div>

							</div>
														<div class="form-group">

								<label for="username" class="col-lg-3 control-label">

									Server Username

									
								</label>

								<div class="col-lg-6">

									<input class="form-control" type="text" name="username" id="username" value="">

									<span class="help-block"></span>

								</div>

							</div>
														<div class="form-group">

								<label for="password" class="col-lg-3 control-label">

									Server Password

									
								</label>

								<div class="col-lg-6">

									<input class="form-control" type="text" name="password" id="password" value="">

									<span class="help-block"></span>

								</div>

							</div>
														<div class="form-group">

								<label for="sendmail" class="col-lg-3 control-label">

									Sendmail System Path

									
								</label>

								<div class="col-lg-6">

									<input class="form-control" type="text" name="sendmail" id="sendmail" value="/usr/sbin/sendmail -bs">

									<span class="help-block"></span>

								</div>

							</div>
														<div class="form-group">

								<label for="pretend" class="col-lg-3 control-label">

									Main "Pretend"

									
								</label>

								<div class="col-lg-6">

									<select class="form-control" name="pretend" id="pretend">
			<option value="1" selected="&quot;selected&quot;">
			Enabled
		</option>
			<option value="0">
			Disabled
		</option>
	</select>

									<span class="help-block"></span>

								</div>

							</div>
							
						
					</fieldset>
    </div>

    <button class="btn btn-primary">Save Changes</button>
  </div>

{!! Form::close() !!}

@endsection