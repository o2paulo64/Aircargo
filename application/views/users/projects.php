

	<div class="parallax-container" >
		<div class="parallax"><img src="<?php echo base_url('assets/images/p_proj.jpg')?>"></div>
	</div>

	<div class="section white">
		<h5 class='padding'><center>Government Projects</center></h5>
		<div class='container' id='table-container'>
			<table class='responsive-table bordered highlight centered blue-grey darken-1 white-text'>
		        <thead>
		          <tr>
		              <th>Region</th>
		              <th>District</th>
		              <th>Location</th>
		              <th>Description</th>
		              <th>Cost</th>
		          </tr>
		        </thead>

		        <tbody>

		        <?php

					foreach ($gov_proj->result_array() as $proj_row) {
						echo "
					<tr>
						<td>".$proj_row['region']."</td>
						<td>".$proj_row['district']."</td>
						<td>".$proj_row['location_name']."</td>
						<td>".$proj_row['description']."</td>
						<td>".$proj_row['cost']."</td>
				
					</tr>

		        		";
		        	}
		        ?>
		        </tbody>
      		</table>

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
	</div>

	<div class="parallax-container">
		<div class="parallax"><img src="<?php echo base_url('assets/images/p_proj2.jpg')?>"></div>
	</div>

	


