

	<div class="parallax-container" >
		<div class="parallax"><img src="<?php echo base_url('assets/images/p_proj.jpg')?>"></div>
	</div>

	<div class="section white">
		<h5 class='padding'><center>Project Contractors</center></h5>
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
				<select class='input-field' onchange="javascript:handleSelect(this,'users/Contracts?sortBy=')">
					<option value="" disabled selected>Sort by...</option>
					<optgroup label="Ascending Order">
						<option value='contractor_name_ascending'>Contractor Name</option>
						<option value='region_ascending'>Region</option>
						<option value='district_ascending'>District</option>
						<option value='start_date_ascending'>Date of Contract</option>
					</optgroup>
					<optgroup label="Descending Order">
						<option value='contractor_name'>Contractor Name</option>
						<option value='region'>Region</option>
						<option value='district'>District</option>
						<option value='start_date'>Date of Contract</option>
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
		              <th>Contractor Name</th>
		              <th>Region</th>
		              <th>District</th>
		              <th>Date of Contract</th>
		          </tr>
		        </thead>

		        <tbody>

		        <?php

					foreach ($prj_contractors->result_array() as $contract_row) {
						echo "
					<tr>
						<td>".$contract_row['contractor_name']."</td>
						<td>".$contract_row['region']."</td>
						<td>".$contract_row['district']."</td>
						<td>".$contract_row['start_date']."</td>
				
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