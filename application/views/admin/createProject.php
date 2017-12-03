<div class="parallax-container">
		<div class="parallax"><img src="<?php echo base_url('assets/images/sky.jpg')?>"></div>
</div>

<div class="section white">
		<h5 class='padding'><center>Create New Project</center></h5>
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
				<form onsubmit="return confirm('Are you sure you want to save your changes?');" action ="<?php echo base_url('users/Projects/create'); ?>" method='POST'>
					<div class='section'>
				        <div class="input-field col s12">
				          	<input name="project_id" type="hidden">
				          	<input name="office_id" type="hidden">
				          	<input name="region" type="text" class="validate">
				          	<label for="region">Region</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="district" type="text" class="validate">
				          	<label for="district">District</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="location_name" type="text" class="validate">
				          	<label for="location_name">Location</label>
				        </div>

				        <div class="input-field col s12">
				          	<textarea id='textarea1' name="description" class='materialize-textarea validate' type='text'></textarea>
				          	<label for="textarea1">Description</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="cost" type="text" class="validate">
				          	<label for="cost">Cost</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="fundsource_type" type="text" class="validate">
				          	<label for="fundsource_type">Funding</label>
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