

	<div class="parallax-container" >
		<div class="parallax"><img src="<?php echo base_url('assets/images/contra.jpg')?>"></div>
	</div>

	<div class="section white">
		<h5 class='padding'><center>Government Contracts</center></h5>
		<div class='row'>
			<div class='col m4'></div>
			<div class='col m4'>
				<?php
					if($this->session->flashdata('editProjSuccess')==1) echo('<div class="green white-text"><center><strong>Contract successfully Updated</strong></center></div>');
					else if($this->session->flashdata('deleteProjSuccess')==1) echo('<div class="green white-text"><center><strong>Contract successfully Deleted</strong></center></div>');
					else if($this->session->flashdata('createProjSuccess')==1) echo('<div class="green white-text"><center><strong>Contract successfully created</strong></center></div>');
				?>
			</div>
		</div>
		<div class='row'>
			<div class='col m1'></div>
			<div class='col m7'>
				<form id='search-bar-css' action=<?php echo base_url('users/Contracts?search='); ?> method="GET">
			        <div class="input-field col s6">
			          <input name="search" type="text" class="validate">
			          <label for="search">Search</label>

			        </div>


			    </form>
			        
			    
			</div>
			<div class="col m3"  id='sortby'>
				<select class='input-field' onchange="javascript:handleSelect(this,'users/Contracts?search=<?php echo $searchString; ?>&sortBy=')">
					<option value="" disabled selected>Sort by...</option>
					<option value="default">Default</option>
					<optgroup label="Ascending Order">
						<option value='contractor_name_ascending'>Contractor Name</option'>
						<option value='region_ascending'>Region</option'>
						<option value='district_ascending'>District</option'>
						<option value='start_date_ascending'>Start Date</option'>
					</optgroup>
					<optgroup label="Descending Order">
						<option value='contractor_name'>Contractor Name</option'>
						<option value='region'>Region</option'>
						<option value='district'>District</option'>
						<option value='start_date'>Start Date</option'>
					</optgroup>
				</select>	
			</div>

		</div>
		<div id="modal1" class="modal">
			<div class="modal-content">
				<h5>Advance Search</h5>
				<div class='container'>
					<div class='section'></div>
					<div class='row'></div>
					<div class='row'>
							<form id='search-bar-css' action=<?php echo base_url('users/Contracts'); ?> method="POST">
							    <div clas='section'>
							        <div class="input-field col s12">
							          <input name="contractor_name" type="text" class="validate">
							          <label for="contractor_name">Search Constructor Name</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="region" type="text" class="validate">
							          <label for="region">Search Region</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="district" type="text" class="validate">
							          <label for="district">Search District</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="start_date" type="text" class="validate">
							          <label for="start_date">Search Start Date</label>
							        </div>
							    </div>
						        <div class='section'>
									<div class='col m4'>
										<button type='submit' class='waves-effect waves-light btn'>Search</button>	
									</div>
								</div>
						    </form>   
					</div>
				</div>
			</div>
		</div>
		<div class='container' id='table-container'>
			<a class='modal-trigger' style='font-size: 11px; padding-bottom: 20px;' href="#modal1"> Advance Search</a><br>
			<label style='float: left;'><?php echo $searchResult;?></label>
			<label style='float: right;'>Sorted by <?php echo $sort;?></label>
			<table class='responsive-table bordered highlight centered blue-grey darken-1 white-text'>
		        <thead>
		          <tr>
		              <th>Contractor Name</th>
		              <th>Region</th>
		              <th>District</th>
		              <th>Start Date</th>
		              <th></th>
		              <?php 
		              	if($authority==1){
		              		echo"
						<td>
							<form onsubmit='return confirm(\"Are you sure you want to create new Contract? \")' role='form' action ='";
				
				echo base_url('users/Contracts/createContract');
				echo "' method='POST'>
							<center>
							<button type='submit' id='iconButton'><i class='material-icons' title='Create new Contract'>fiber_new</i></button></center>
							</form>
						</td>
		              		";
		              	}
		              ?>

		          </tr>
		        </thead>

		        <tbody>

		        <?php
					foreach ($gov_proj->result_array() as $proj_row) {
						echo "
					<tr>
						<td>".$proj_row['contractor_name']."</td>
						<td>".$proj_row['region']."</td>
						<td>".$proj_row['district']."</td>
						<td>".$proj_row['start_date']."</td>
						";
						if($authority==1){
							echo "
						<td>
							<form onsubmit='return confirm(\"Are you sure you want to update this Contract? \")' role='form' action ='";
				
				echo base_url('users/Contracts/editContract');
				echo "' method='POST'>
							<center>
							<input type='hidden' name='proj[]' value='".$proj_row['contractor_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['office_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['contractor_name']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['region']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['district']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['start_date']."'>
							<button type='submit' id='iconButton'><i class='material-icons' title='edit'>edit</i></button></center>
							</form>
						</td>

						<td>
							<form onsubmit='return confirm(\"Are you sure you want to delete this Contract? \")' role='form' action ='";
				
				echo base_url('users/Contracts/deleteContract');
				echo "' method='POST'>
							<center>
							<input type='hidden' name='proj[]' value='".$proj_row['contractor_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['office_id']."'>
							<button type='submit' id='iconButton'><i class='material-icons' title='delete'>delete</i></button></center>
							</form>
						</td>
						
					
		        			";
						}
					echo "
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
		<div class="parallax"><img src="<?php echo base_url('assets/images/contra2.jpg')?>"></div>
	</div>

<script type="text/javascript">

function handleSelect(elm,url)
{	
	window.location.href = <?php echo json_encode(base_url()); ?>+url+elm.value;
}
</script>