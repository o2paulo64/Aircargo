

	<div class="parallax-container" >
		<div class="parallax"><img src="<?php echo base_url('assets/images/p_proj.jpg')?>"></div>
	</div>

	<div class="section white">
		<h5 class='padding'><center>Cargo Deliveries</center></h5>
		<div class='row'>
			<div class='col m1'></div>
			<div class='col m7'>
				<form id='search-bar-css'>
			        <div class="input-field col s6">
			          <input id="search" type="text" class="validate">
			          <label for="search">Search</label>
			        </div>
			    </form>
			</div>
			<div class="col m3"  id='sortby'>
				<select class='input-field' onchange="javascript:handleSelect(this,'users/Cargoes?sortBy=')">
					<option value="" disabled selected>Sort by...</option>
					<optgroup label="Ascending Order">
						<option value='report_id_ascending'>Report ID</option>
						<option value='aircraft_registration_ascending'>Aircraft Registration</option>
						<option value='project_id_ascending'>Project ID</option>
						<option value='location_name_ascending'>Location</option>
						<option value='shipping_date_ascending'>Shipping Date</option>
						<option value='type_of_objects_ascending'>Object Type</option>
						<option value='no_objects_ascending'># of Objects</option>
						<option value='overall_cost_ascending'>Cost</option>
					</optgroup>
					<optgroup label="Descending Order">
						<option value='report_id'>Report ID</option>
						<option value='aircraft_registration'>Aircraft Registration</option>
						<option value='project_id'>Project ID</option>
						<option value='location_name'>Location</option>
						<option value='shipping_date'>Shipping Date</option>
						<option value='type_of_objects'>Object Type</option>
						<option value='no_objects'># of Objects</option>
						<option value='overall_cost'>Cost</option>
					</optgroup>
				</select>	
				<div class='row' style='margin-top: -20px;'>
				<label>Sorted by <?php echo $sort?></label>
				</div>
			</div>

		</div>
		<div class='container' id='table-container'>
			<table class='responsive-table bordered highlight centered blue-grey darken-1 white-text'>
		        <thead>
		          <tr>
		              <th>Report ID</th>
		              <th>Aircraft Registration</th>
		              <th>Project ID</th>
		              <th>Location</th>
		              <th>Shipping Date</th>
		              <th>Object Type</th>
		              <th># of Objects</th>
		              <th>Cost</th>
		          </tr>
		        </thead>

		        <tbody>

		        <?php

					foreach ($crg_deliveries->result_array() as $cargo_row) {
						echo "
					<tr>
						<td>".$cargo_row['report_id']."</td>
						<td>".$cargo_row['aircraft_registration']."</td>
						<td>".$cargo_row['project_id']."</td>
						<td>".$cargo_row['location_name']."</td>
						<td>".$cargo_row['shipping_date']."</td>
						<td>".$cargo_row['type_of_objects']."</td>
						<td>".$cargo_row['no_objects']."</td>
						<td>".$cargo_row['overall_cost']."</td>
				
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

<script type="text/javascript">

function handleSelect(elm,url)
{	
	window.location.href = <?php echo json_encode(base_url()); ?>+url+elm.value;
}
</script>