<?php define("menu_main","dashboard");
	  define("menu_sub","");
require_once("../includes/top.php");
class Admin_Dashboard extends DataBase
{
	function All_Admin_Dashboard()
	{
		$common_top = new Common_Top();
		$common_top->ALL_Common_Top();
?> 
<div class="pageContent extended">
			<div class="container">
				<h1 class="pageTitle">
					<a href="#" title="#">Forms</a>
				</h1>
				<ol class="breadcrumb">
					<li><a href="dashboard.html">Sharpen</a></li>
					<li class="active">Forms</li>
				</ol>
				
				<div class="box rte">
					<h2 class="boxHeadline">Input Fields</h2>
					<h3 class="boxHeadlineSub">Subtitle of the input fields goes here</h3>
					
					<form>
						<div class="row">
							<div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label for="basicInput">Basic Input</label>
									<input type="text" class="form-control" id="basicInput" placeholder="Placeholder">
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label for="basicInputActive">Basic Input active</label>
									<input type="text" class="form-control" id="basicInputActive" placeholder="Placeholder">
								</div>
							</div>
							<div class="col-xs-12 col-sm-4">
								<div class="form-group">
									<label for="basicInputValidate">Basic Input validate</label>
									<input type="text" class="form-control error" id="basicInputValidate" placeholder="Placeholder">
									<div class="input-error-msg">Wrong format</div>
								</div>
							</div>
						</div>

						<!-- Custom select -->
						<div class="row customSelectWrap">
							<div class="col-xs-12 col-sm-4 i">
								<div class="form-group">
									<label>Country</label>
									<select class="js-select">
										<option disabled selected>- Select country -</option>
										<option>Slovakia</option>
										<option>Czech Republic</option>
										<option>Russia</option>
										<option>United Kingdom</option>
										<option>Spain</option>
										<option>France</option>
										<option>Austria</option>
										<option>Germany</option>
										<option>Italy</option>
										<option>USA</option>
										<option>Norway</option>
										<option>Denmark</option>
										<option>Iceland</option>
										<option>Croatia</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 i">
								<div class="form-group">
									<label>Country</label>
									<select class="js-select">
										<option disabled selected>- Select country -</option>
										<option>Slovakia</option>
										<option>Czech Republic</option>
										<option>Russia</option>
										<option>United Kingdom</option>
										<option>Spain</option>
										<option>France</option>
										<option>Austria</option>
										<option>Germany</option>
										<option>Italy</option>
										<option>USA</option>
										<option>Norway</option>
										<option>Denmark</option>
										<option>Iceland</option>
										<option>Croatia</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-sm-4 i">
								<div class="form-group">
									<label>Country</label>
									<select class="error js-select">
										<option disabled selected>- Select country -</option>
										<option>Slovakia</option>
										<option>Czech Republic</option>
										<option>Russia</option>
										<option>United Kingdom</option>
										<option>Spain</option>
										<option>France</option>
										<option>Austria</option>
										<option>Germany</option>
										<option>Italy</option>
										<option>USA</option>
										<option>Norway</option>
										<option>Denmark</option>
										<option>Iceland</option>
										<option>Croatia</option>
									</select>
									<div class="input-error-msg">Choose option</div>
								</div>
							</div>
						</div>

						<!-- Textarea -->
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="textarea1">Message</label>
									<textarea id="textarea1" class="form-control" rows="8">Lorem ipsum dolor sit amet, cu pro omittam adipisci, stet platonem theophrastus qui in. No fugit nobis accusamus nec. Semper explicari ei mei, cu simul omnes definiebas vis. Ne duo debitis similique expetendis, ne vis aliquando complectitur. Eu malorum persius liberavisse has, discere petentium assueverit sea at. Ad illum dictas persequeris sit.</textarea>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group">
									<label for="textarea2">Message</label>
									<textarea id="textarea2" class="form-control error" rows="8"></textarea>
								</div>
							</div>
						</div>

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
				
				<div class="box rte">
					<h2 class="boxHeadline">Inline Form</h2>
					<h3 class="boxHeadlineSub">Subtitle of the inline form goes here</h3>
					
					<form role="form" class="form-inline">
						<div class="form-group">
							<label for="inputEmail1" class="sr-only">Email address</label>
							<input type="email" placeholder="Enter email" id="inputEmail1" class="form-control">
						</div>
						<div class="form-group">
							<label for="passwordInput1" class="sr-only">Password</label>
							<input type="password" placeholder="Password" id="passwordInput1" class="form-control">
						</div>
						<div class="form-group checkboxes">
							<label>
								<input type="checkbox">
								<span>Remember me</span>
							</label>
						</div>
						
						<button class="btn btn-primary btn-lg" type="submit">Sign in</button>						
					</form>
				</div>

				<div class="box rte">
					<h2 class="boxHeadline">Datepickers</h2>
					<h3 class="boxHeadlineSub">Subtitle of the datepickers goes here</h3>
					
					<form>
						<div class="row">
							<!-- Datepickers -->
							<div class="col-xs-12 col-sm-3">
								<label for="datepicker-1">Simple date picker</label>
								<input id="datepicker-1" class="form-control datepicker" placeholder="Select date" type="text">
							</div>
							<div class="col-xs-12 col-sm-3">
								<label for="datepicker-2-input">Simple date picker with an icon</label>
								<div id="datepicker-2" class="input-group date">
									<input id="datepicker-2-input" class="form-control" placeholder="Select date" type="text"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div id="datepicker-3" class="input-daterange row">
									<div class="col-xs-6">
										<label for="datepicker-3-input">Date range - from</label>
										<input id="datepicker-3-input" type="text" class="form-control" placeholder="Select start date">
									</div>
									<div class="col-xs-6">
										<label for="datepicker-4-input">Date range - to</label>
										<input id="datepicker-4-input" type="text" class="form-control" placeholder="Select end date">
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<!-- Datetimepickers -->
								<div class="form-group">
									<label for="datetimepicker-1-input">Simple date & time picker</label>
									<div id="datetimepicker-1" class="input-group date">
										<input id="datetimepicker-1-input" type="text" class="form-control" placeholder="Select date & time">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>

							<div class="col-xs-12 col-sm-6">
								<!-- Datetimepickers -->
								<div class="form-group">
									<label for="datetimepicker-1-input">Date & time picker with simple picker wizard</label>
									<div id="datetimepicker-2" class="input-group date">
										<input type="text" class="form-control" placeholder="Select with multiple steps">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
						</div>

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
				

				<div class="box rte">
					<h2 class="boxHeadline">Upload File</h2>
					<h3 class="boxHeadlineSub">Subtitle of the upload file goes here</h3>

					<form>
						<div class="row">
							<div class="col-xs-12 col-md-6">
								<div class="fileUploadWrap">
									<input type="file" class="form-control">
									<div class="btn btn-green">Upload Document</div>
									<div class="info">Doc., Docx., Xls., Xlsx.</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="alert alert-dismissible alert-file-upload" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>lorem-isumtamus-tarcius.docx</strong>
								</div>
							</div>
						</div>
					
						<button type="submit" class="btn btn-primary bg-green">Submit</button>
					</form>
				</div>

				<div class="box rte">
					<h2 class="boxHeadline">Checkboxes</h2>
					<h3 class="boxHeadlineSub">Subtitle goes here</h3>

					<form>
						<!-- Checkboxes -->
						<div class="row checkboxes">
							<div class="col-xs-12 col-sm-4 i">
								<label>
									<input type="checkbox">
									<span>Checkbox option</span>
								</label>
							</div>
							<div class="col-xs-12 col-sm-4 i">
								<label>
									<input type="checkbox" class="error">
									<span>Checkbox option</span>
								</label>
							</div>
							<div class="col-xs-12 col-sm-4 i">
								<label>
									<input type="checkbox">
									<span>Checkbox option</span>
								</label>
							</div>
						</div>
						<div class="row checkboxes">
							<div class="col-xs-12 col-sm-4 i">
								<label>
									<input type="checkbox" disabled>
									<span>Checkbox option disabled</span>
								</label>
							</div>
							<div class="col-xs-12 col-sm-4 i">
								<label>
									<input type="checkbox" class="error">
									<span>Checkbox option</span>
								</label>
							</div>
							<div class="col-xs-12 col-sm-4 i">
								<label>
									<input type="checkbox" checked>
									<span>Checkbox option</span>
								</label>
							</div>
						</div>
						<div class="row checkboxes">
							<div class="col-xs-12 col-sm-4 col-sm-offset-4 i">
								<label>
									<input type="checkbox" disabled>
									<span>Checkbox option disabled</span>
								</label>
							</div>
							<div class="col-xs-12 col-sm-4 i">
								<label>
									<input type="checkbox" disabled>
									<span>Checkbox option disabled</span>
								</label>
							</div>
						</div>

						<!-- Break -->
						<hr />

						<!-- Radio Buttons -->
						<h2 class="boxHeadline">Radio Buttons</h2>
						<h3 class="boxHeadlineSub">Subtitle goes here</h3>

						<div class="radiobuttons">
							<label>
								<input type="radio" name="radio">
								<span>Radio option</span>
							</label>
							<label>
								<input type="radio" name="radio" checked>
								<span>Radio option</span>
							</label>
							<label>
								<input type="radio" name="radio">
								<span>Radio option</span>
							</label>
							<label>
								<input type="radio" name="radio" disabled>
								<span>Radio option</span>
							</label>
						</div>
						
						<div class="text-right">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>

				<!-- Input slider -->
				<div class="box rte">
					<h2 class="boxHeadline">Input slider</h2>
					<h3 class="boxHeadlineSub">Subtitle goes here</h3>

					<form>
						<div class="form-group inputSliders">
							<label for="amount">
								Max. Range Value:
								<input type="text" id="amount" class="max-range-value" readonly style="border:0; color:#363f45;">
							</label>
							<div class="sliderWrap">
								<div id="slider-range-max"></div>
							</div>
						</div>

						<div class="form-group inputSliders">
							<div class="row">
								<div class="col-xs-6">
									<label for="amount-1">
										Min Range Value:
										<input type="text" id="amount-1" readonly style="border:0; color:#363f45;">
									</label>
								</div>
								<div class="col-xs-6 text-right">
									<label for="amount-2">
										Max. Range Value:
										<input type="text" id="amount-2" readonly style="border:0; color:#363f45;">
									</label>
									
								</div>
							</div>
							<div class="sliderWrap">
								<div id="slider-range"></div>
							</div>
						</div>

						<!-- Break -->
						<hr />

						<h2 class="boxHeadline">Toggle options</h2>
						<h3 class="boxHeadlineSub">Subtitle goes here</h3>

						<div class="row checkboxToggler">
							<div class="col-xs-4 col-sm-3 col-md-2 i">
								Toggle Off
								<label>
									<input type="checkbox">
									<span></span>
								</label>
							</div>
							<div class="col-xs-4 col-sm-3 col-md-2 i">
								Toggle On
								<label>
									<input type="checkbox" checked>
									<span></span>
								</label>
							</div>
							<div class="col-xs-4 col-sm-3 col-md-2 i">
								Toggle Disabled
								<label>
									<input type="checkbox" disabled checked>
									<span></span>
								</label>
							</div>
						</div>

						<br />

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>

				<!-- Masked Inputs & Textarea features -->
				<div class="row">
					<div class="col-xs-12">
						<div class="box rte">
							<h2 class="boxHeadline">Masked inputs</h2>
							<h3 class="boxHeadlineSub">Subtitle goes here</h3>

							<form>
								<div class="form-group">
									<label for="inputMask1">Phone (+421 999 999 999)</label>
									<input id="inputMask1" class="form-control" data-mask="+999 999 999 999" placeholder="+999 999 999 999" type="text">
								</div>

								<div class="form-group">
									<label for="inputMask2">Product key (a*-999-a999)</label>
									<input id="inputMask2" class="form-control" data-mask="a*-999-a999" placeholder="a*-999-a999" type="text">
								</div>

								<div class="form-group">
									<label for="inputMask3">Date of birth (99/99/9999)</label>
									<input id="inputMask3" class="form-control" data-mask="99/99/9999" placeholder="99/99/9999" type="text">
								</div>

								<div class="form-group">
									<label for="inputMask3">IP address (099.099.099.099)</label>
									<input id="inputMask3" class="form-control" data-mask="099.099.099.099" placeholder="099.099.099.099" type="text">
								</div>
							</form>
						</div>
					</div>
					<div class="col-xs-12">
						<div class="box rte">
							<h2 class="boxHeadline">Useful textarea features</h2>
							<h3 class="boxHeadlineSub">Subtitle goes here</h3>

							<form>
								<div class="form-group char-counter">
									<label for="char-counter">Char counter</label>
									<textarea id="char-counter" class="form-control js-char-counter" data-char-allowed="20" data-char-warning="10" rows="2"></textarea>
								</div>

								<div class="form-group">
									<label for="max-length">Max length</label>
									<textarea id="max-length" class="js-max-length form-control" maxlength="10" placeholder="This field has limit of 10 chars" rows="2"></textarea>
								</div>

								<div class="form-group">
									<label for="textarea-autosize">Textarea autosize</label>
									<textarea id="textarea-autosize" class="js-autogrow form-control" placeholder="Please start typing and press few times 'enter'..." rows="2"></textarea>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6">
						<div class="box rte">
							<h2 class="boxHeadline">Password strength</h2>

							<form>
								<div class="form-group pwstrength">
									<label for="max-length">Password</label>
									<input class="js-pwstrength form-control m-b-10" placeholder="Your top secret password" type="password">
								</div>
							</form>
						</div>

						<div class="box rte">
							<h2 class="boxHeadline">Mention</h2>

							<form>
								<div class="form-group pwstrength">
									<label for="max-length">Mention (GitHub style)</label>
									<input class='form-control js-mention' placeholder='Try typing @john' type='text'>
								</div>
							</form>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="box rte">
							<h2 class="boxHeadline">Color pickers</h2>
							<h3 class="boxHeadlineSub">Subtitle goes here</h3>

							<form>
								<div class="form-group pwstrength">
									<label for="color-picker-hex">Color picker - HEX</label>
									<input id="color-picker-hex" class='js-colorpicker-hex form-control' placeholder='Pick a color' type='text'>
								</div>

								<div class="form-group pwstrength">
									<label for="color-picker-rgb">Color picker - RGB</label>
									<input id="color-picker-rgb" class='js-colorpicker-rgb form-control' placeholder='Pick a color' type='text'>
								</div>

								<div class="js-colorpicker-box">
									<label for="color-picker-box">Color picker with box preview</label>
									<div class="input-group date">
										<input id="color-picker-box" class="form-control" placeholder="Click on gray box" type="text">
										<span class="input-group-addon"><i></i></span>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12">
						<div class="box rte">
							<h2 class="boxHeadline">Select2</h2>

							<form>
								<div class="form-group">
									<label for="classic-select">Classic select</label>
									<select id="classic-select" class="select2 js-select2 form-control">
										<optgroup label="Alaskan/Hawaiian Time Zone">
											<option value="AK">Alaska</option>
											<option value="HI">Hawaii</option>
										</optgroup>
										<optgroup label="Pacific Time Zone">
											<option value="CA">California</option>
											<option value="NV">Nevada</option>
											<option value="OR">Oregon</option>
											<option value="WA">Washington</option>
										</optgroup>
										<optgroup label="Mountain Time Zone">
											<option value="AZ">Arizona</option>
											<option value="CO">Colorado</option>
											<option value="ID">Idaho</option>
											<option value="MT">Montana</option>
											<option value="NE">Nebraska</option>
											<option value="NM">New Mexico</option>
											<option value="ND">North Dakota</option>
											<option value="UT">Utah</option>
											<option value="WY">Wyoming</option>
										</optgroup>
										<optgroup label="Central Time Zone">
											<option value="AL">Alabama</option>
											<option value="AR">Arkansas</option>
											<option value="IL">Illinois</option>
											<option value="IA">Iowa</option>
											<option value="KS">Kansas</option>
											<option value="KY">Kentucky</option>
											<option value="LA">Louisiana</option>
											<option value="MN">Minnesota</option>
											<option value="MS">Mississippi</option>
											<option value="MO">Missouri</option>
											<option value="OK">Oklahoma</option>
											<option value="SD">South Dakota</option>
											<option value="TX">Texas</option>
											<option value="TN">Tennessee</option>
											<option value="WI">Wisconsin</option>
										</optgroup>
										<optgroup label="Eastern Time Zone">
											<option value="CT">Connecticut</option>
											<option value="DE">Delaware</option>
											<option value="FL">Florida</option>
											<option value="GA">Georgia</option>
											<option value="IN">Indiana</option>
											<option value="ME">Maine</option>
											<option value="MD">Maryland</option>
											<option value="MA">Massachusetts</option>
											<option value="MI">Michigan</option>
											<option value="NH">New Hampshire</option>
											<option value="NJ">New Jersey</option>
											<option value="NY">New York</option>
											<option value="NC">North Carolina</option>
											<option value="OH">Ohio</option>
											<option value="PA">Pennsylvania</option>
											<option value="RI">Rhode Island</option>
											<option value="SC">South Carolina</option>
											<option value="VT">Vermont</option>
											<option value="VA">Virginia</option>
											<option value="WV">West Virginia</option>
										</optgroup>
									</select>
								</div>

								<div class="form-group multiple-select">
									<label for="classic-select">Multiple select / tags</label>
									<select class="select2 js-select2 form-control" multiple placeholder="Try typing some USA country name">
										<optgroup label="Alaskan/Hawaiian Time Zone">
											<option value="AK">Alaska</option>
											<option value="HI">Hawaii</option>
										</optgroup>
										<optgroup label="Pacific Time Zone">
											<option value="CA">California</option>
											<option value="NV">Nevada</option>
											<option value="OR">Oregon</option>
											<option value="WA">Washington</option>
										</optgroup>
										<optgroup label="Mountain Time Zone">
											<option value="AZ">Arizona</option>
											<option value="CO">Colorado</option>
											<option value="ID">Idaho</option>
											<option value="MT">Montana</option>
											<option value="NE">Nebraska</option>
											<option value="NM">New Mexico</option>
											<option value="ND">North Dakota</option>
											<option value="UT">Utah</option>
											<option value="WY">Wyoming</option>
										</optgroup>
										<optgroup label="Central Time Zone">
											<option value="AL">Alabama</option>
											<option value="AR">Arkansas</option>
											<option value="IL">Illinois</option>
											<option value="IA">Iowa</option>
											<option value="KS">Kansas</option>
											<option value="KY">Kentucky</option>
											<option value="LA">Louisiana</option>
											<option value="MN">Minnesota</option>
											<option value="MS">Mississippi</option>
											<option value="MO">Missouri</option>
											<option value="OK">Oklahoma</option>
											<option value="SD">South Dakota</option>
											<option value="TX">Texas</option>
											<option value="TN">Tennessee</option>
											<option value="WI">Wisconsin</option>
										</optgroup>
										<optgroup label="Eastern Time Zone">
											<option value="CT">Connecticut</option>
											<option value="DE">Delaware</option>
											<option value="FL">Florida</option>
											<option value="GA">Georgia</option>
											<option value="IN">Indiana</option>
											<option value="ME">Maine</option>
											<option value="MD">Maryland</option>
											<option value="MA">Massachusetts</option>
											<option value="MI">Michigan</option>
											<option value="NH">New Hampshire</option>
											<option value="NJ">New Jersey</option>
											<option value="NY">New York</option>
											<option value="NC">North Carolina</option>
											<option value="OH">Ohio</option>
											<option value="PA">Pennsylvania</option>
											<option value="RI">Rhode Island</option>
											<option value="SC">South Carolina</option>
											<option value="VT">Vermont</option>
											<option value="VA">Virginia</option>
											<option value="WV">West Virginia</option>
										</optgroup>
									</select>
								</div>
							</form>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-12">
						<div class="box rte">
							<h2 class="boxHeadline">Advanced WYSIWYG (CKEditor)</h2>

							<form>
								<textarea class="form-control ckeditor" id="wysiwyg1" rows="10">
									<h1>In computing,</h1> a WYSIWYG editor is a system in which content (text and graphics) displayed onscreen during editing appears in a form closely corresponding to its appearance when printed or displayed as a finished product,[1] which might be a printed document, web page, or slide presentation. WYSIWYG (pron.: /ˈwɪziwɪɡ/ wiz-ee-wig)[2] is an acronym for "what you see is what you get".
								</textarea>
							</form>
						</div>
					</div>

					<div class="col-xs-12">
						<div class="box rte">
							<h2 class="boxHeadline">Simple WYSIWYG (wysihtml)</h2>

							<form>
								<div id="toolbar">
									<a data-wysihtml5-command="bold">bold</a>
									<a data-wysihtml5-command="italic">italic</a>
									<a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1">H1</a>
									<a data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="p">P</a>
								</div>

								<!-- element to edit -->
								<div id="wysiwyg2" data-placeholder="Go on, start editing..."></div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div> 
 
 <?php $common_bottom = new Common_Bottom();
		 $common_bottom->ALL_Common_Bottom();
	 }
}
$admin_dashboard = new Admin_Dashboard();	
$admin_dashboard->All_Admin_Dashboard();
?>