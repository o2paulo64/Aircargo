<div class="parallax-container">
		<div class="parallax"><img src="<?php echo base_url('assets/images/sky.jpg')?>"></div>
</div>

<div class="section white">
		<h5 class='padding'><center>Create New Report</center></h5>
		<div class='row'>
			<div class='col m4'></div>
			<div class='col m4'>
				<?php
					if(validation_errors() != "")
					{
						echo('<div class="red white-text"><center><strong>'.validation_errors().'</strong></center></div>');
					}
				?>
			</div>
		</div>

		<div class='row'>
			<div class='col m3'></div>
			<div class='col m6'>
				<form onsubmit="return confirm('Are you sure you want to save your changes?');" action ="<?php echo base_url('users/Reports/create'); ?>" method='POST'>
					<div class='section'>

				        <div class="input-field col s12">
				          	<input name="cargo_id" type="hidden" class="validate" value='<?php echo $cargo_id; ?>'>
				          	<input name="operation_name" type="text" class="validate"'>
				          	<label for="operation_name">Operation Name</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="airport_name" type="text" class="validate">
				          	<label for="airport_name">Airport Name</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="aircraft_registration" type="text" class="validate">
				          	<label for="aircraft_registration">Aircraft Registration</label>
				        </div>
				        <div class="input-field col s12">
				          	<input name="type" type="text" class="validate">
				          	<label for="type">Aircraft Type</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="classification" type="text" class="validate">
				          	<label for="classification">Classification</label>
				        </div>

				        <div class="input-field col s12">
				          	<textarea id='textarea1' name="description" class='materialize-textarea validate' type='text'></textarea>
				          	<label for="textarea1">Description</label>
				        </div>
				    </div>
			        <div class='section'>
						<div class='col m4'>
							<button type='submit' class='waves-effect waves-light btn'>Create Project</button>	
						</div>
					</div>
			    </form>	    
			</div>
		</div>
</div>