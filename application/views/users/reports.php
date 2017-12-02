

	<div class="parallax-container" >
		<div class="parallax"><img src="<?php echo base_url('assets/images/p_proj.jpg')?>"></div>
	</div>

	<div class="section white">
		<h5 class='padding'><center>Accident/Incident Reports</center></h5>
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
				<select class='input-field' onchange="javascript:handleSelect(this,'users/Reports?sortBy=')">
					<option value="" disabled selected>Sort by...</option>
					<optgroup label="Ascending Order">
						<option value='report_id_ascending'>Report ID</option>
						<option value='shipping_date_ascending'>Date</option>
						<option value='operation_name_ascending'>Operator</option>
						<option value='airport_name_ascending'>Airport</option>
						<option value='aircraft_registration_ascending'>Aircraft Registration</option>
						<option value='cargo_id_ascending'>Cargo ID</option>
					</optgroup>
					<optgroup label="Descending Order">
						<option value='report_id'>Report ID</option>
						<option value='shipping_date'>Date</option>
						<option value='operation_name'>Operator</option>
						<option value='airport_name'>Airport</option>
						<option value='aircraft_registration'>Aircraft Registration</option>
						<option value='cargo_id'>Cargo ID</option>
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
		              <th>Date</th>
		              <th>Operator</th>
		              <th>Airport</th>
		              <th>Aircraft Registration</th>
		              <th>Classification</th>
		              <th>Description</th>
		              <th>Cargo ID</th>
		          </tr>
		        </thead>

		        <tbody>

		        <?php

					foreach ($ai_report->result_array() as $report_row) {
						echo "
					<tr>
						<td>".$report_row['report_id']."</td>
						<td>".$report_row['shipping_date']."</td>
						<td>".$report_row['operation_name']."</td>
						<td>".$report_row['airport_name']."</td>
						<td>".$report_row['aircraft_registration']."</td>
						<td>".$report_row['classification']."</td>
						<td>".$report_row['description']."</td>
						<td>".$report_row['cargo_id']."</td>
				
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