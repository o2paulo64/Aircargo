

	<div class="parallax-container" >
		<div class="parallax"><img src="<?php echo base_url('assets/images/p_proj.jpg')?>"></div>
	</div>

	<div class="section white">
		<h5 class='padding'><center>Government Projects</center></h5>
		<div class='row'>
			<div class='col m1'></div>
			<div class='col m7'>
				<form id='search-bar-css' action=<?php echo base_url('users/Projects?search='); ?> method="GET">
			        <div class="input-field col s6">
			          <input name="search" type="text" class="validate">
			          <label for="search">Search</label>

			        </div>


			    </form>
			        
			    
			</div>
			<div class="col m3"  id='sortby'>
				<select class='input-field' onchange="javascript:handleSelect(this,'users/Projects?search=<?php echo $searchString; ?>&sortBy=')">
					<option value="" disabled selected>Sort by...</option>
					<optgroup label="Ascending Order">
						<option value='region_ascending'>Region</option>
						<option value='district_ascending'>District</option>
						<option value='location_ascending'>Location</option>
						<option value='cost_ascending'>Cost</option>
					</optgroup>
					<optgroup label="Descending Order">
						<option value='region'>Region</option>
						<option value='district'>District</option>
						<option value='location'>Location</option>
						<option value='cost'>Cost</option>
					</optgroup>
				</select>	
			</div>

		</div>
		<div class='container' id='table-container'>
			<label style='float: left;'><?php echo $searchResult;?></label>
			<label style='float: right;'>Sorted by <?php echo $sort;?></label>
			<table class='responsive-table bordered highlight centered blue-grey darken-1 white-text'>
		        <thead>
		          <tr>
		              <th>Region</th>
		              <th>District</th>
		              <th>Location</th>
		              <th>Description</th>
		              <th>Cost</th>
		              <th>Funding</th>
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
						<td>".$proj_row['fundsource_type']."</td>
				
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