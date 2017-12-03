<div class="parallax-container">
		<div class="parallax"><img src="<?php echo base_url('assets/images/sky.jpg')?>"></div>
</div>

<div class="section white">
		<h5 class='padding'><center>Edit Cargo</center></h5>
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
				<form onsubmit="return confirm('Are you sure you want to save your changes?');" action ="<?php echo base_url('users/Cargoes/edit'); ?>" method='POST'>
					<div class='section'>
				        <div class="input-field col s12">
				        	<input name="report_id" type="hidden" value='<?php echo $report_id; ?>'>
				        	<input name="project_id" type="hidden" value='<?php echo $project_id; ?>'>
				        	<input name="operator_id" type="hidden" value='<?php echo $operator_id; ?>'>
				        	<input name="airport_id" type="hidden" value='<?php echo $airport_id; ?>'>
				        	<input name="cargo_id" type="hidden" value='<?php echo $cargo_id; ?>'>
				        	<input name="aircraft_registration" type="hidden" value='<?php echo $aircraft_registration; ?>'>
				          	<input name="type_of_objects" type="text" class="validate" value='<?php echo $type_of_objects; ?>' >
				          	<label for="type_of_objects">Type of Objects</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="no_objects" type="text" class="validate" value='<?php echo $no_objects; ?>'>
				          	<label for="no_objects">Numer of Objects</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="overall_cost" type="text" class="validate" value='<?php echo $overall_cost; ?>'>
				          	<label for="overall_cost">Overall Cost</label>
				        </div>
				        <div class="input-field col s12">
				          	<input name="type" type="text" class="validate" value='<?php echo $type; ?>'>
				          	<label for="type">Aircraft Type</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="operation_name" type="text" class="validate" value='<?php echo $operation_name; ?>'>
				          	<label for="operation_name">Operation Name</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="airport_name" type="text" class="validate" value='<?php echo $airport_name; ?>'>
				          	<label for="airport_name">Airport Name</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="rnum" type="text" class="validate" value='<?php echo $rnum; ?>'>
				          	<label for="rnum">Rnum</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="location_name" type="text" class="validate" value='<?php echo $location_name; ?>'>
				          	<label for="location_name">Location Name</label>
				        </div>

				        <div class="input-field col s12">
				          	<textarea id='textarea1' name="description" class='materialize-textarea validate' type='text'><?php echo $description; ?></textarea>
				          	<label for="textarea1">Description</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="cost" type="text" class="validate" value='<?php echo $cost; ?>'>
				          	<label for="cost">Cost</label>
				        </div>

				        <div class="input-field col s12">
				          	<input name="shipping_date" type="text" class="validate" value='<?php echo $shipping_date; ?>'>
				          	<label for="shipping_date">Shipping Date</label>
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