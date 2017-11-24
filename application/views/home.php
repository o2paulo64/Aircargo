<div class='container-fluid'>
	<div class='row'>
		<div class='col-md-4'></div>
		<div class='col-md-4'>
			<?php
				if($this->session->flashdata('accountUpdateSuccess')==1) echo('<div class="alert alert-success"><center><strong>Account information updated</strong></center></div>');
			?>
		</div>
	</div>

	
  </ul>
	<?php

		foreach ($aircraft->result_array() as $aircraft_row) {

			echo "
			<div class='container' style='margin-top: 20px;'>
	<div class=row>
		<div class=col-md-1></div>
		<div class=col-md-10>
		<div class='card blue-grey darken-1'>
            <div class='card-content white-text'>
              <span class='card-title'>".$aircraft_row['location_name']."</span>
              <p>".$aircraft_row['description']."</p>
            </div>
   		</div>
		</div>
	</div>
	</div>
			";
		}

	?>
	<div class='container'>
	<div class=row>
		<center>
			<?php if (isset($links)) { ?>
		                <?php echo $links ?>
		            <?php } ?>

		</center>
	</div>
</div>


		
		
</div>


