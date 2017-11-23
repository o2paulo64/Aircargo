<div class='container-fluid'>
	<div class='row'>
		<div class='col-md-4'></div>
		<div class='col-md-4'>
			<?php
				if($this->session->flashdata('accountUpdateSuccess')==1) echo('<div class="alert alert-success"><center><strong>Account information updated</strong></center></div>');
			?>
		</div>
	</div>

	<?php
		foreach ($aircraft->result_array() as $aircraft_row) {
			echo "
			<div class='container' style='margin-top: 20px;'>
	<div class=row>
		<div class=col-md-1></div>
		<div class=col-md-10 id='cardPaddingStack'>
   			<h4 class='card-header white black-text' style='border-bottom-left-radius: 3px; border-bottom-right-radius: 3px; height: 2em; margin-top: 15px;'>".$aircraft_row['type']."
			</h4>
		</div>
	</div>
	</div>
			";
		}

	?>

	


		
		
</div>


