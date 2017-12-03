<div class="parallax-container">
		<div class="parallax"><img src="<?php echo base_url('assets/images/sky.jpg')?>"></div>
</div>

<div class="section white">
		<h5 class='padding'><center>Edit Contract</center></h5>
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
				<form onsubmit="return confirm('Are you sure you want to save your changes?');" action ="<?php echo base_url('users/Contracts/edit'); ?>" method='POST'>
					<div class='section'>
				        <div class="input-field col s12">
				          	<input name="contractor_id" type="hidden" value='<?php echo $contractor_id; ?>'>
				          	<input name="office_id" type="hidden" value='<?php echo $office_id; ?>'>
				          	<input name="contractor_name" type="text" class="validate" value='<?php echo $contractor_name; ?>'>
				          	<label for="contractor_name">Contractor Name</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="region" type="text" class="validate" value='<?php echo $region; ?>'>
				          	<label for="region">Region</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="district" type="text" class="validate" value='<?php echo $district; ?>'>
				          	<label for="district">District</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="start_date" type="text" class="validate" value='<?php echo $start_date; ?>'>
				          	<label for="start_date">Start Date</label>
				        </div>

				    </div>
			        <div class='section'>
						<div class='col m4'>
							<button type='submit' class='waves-effect waves-light btn'>Save Changes</button>	
						</div>
					</div>
			    </form>	    
			</div>
		</div>
</div>