

	<div class="parallax-container" >
		<div class="parallax"><img src="<?php echo base_url('assets/images/p_proj.jpg')?>"></div>
	</div>

	<div class="section white">
		<h5 class='padding'><center>Government Projects</center></h5>
		<div class='row'>
			<div class='col m4'></div>
			<div class='col m4'>
				<?php
					if($this->session->flashdata('editProjSuccess')==1) echo('<div class="green white-text"><center><strong>Project successfully Updated</strong></center></div>');
					else if($this->session->flashdata('deleteProjSuccess')==1) echo('<div class="green white-text"><center><strong>Project successfully Deleted</strong></center></div>');
					else if($this->session->flashdata('createProjSuccess')==1) echo('<div class="green white-text"><center><strong>Project successfully created</strong></center></div>');
				?>
			</div>
		</div>
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
				<?php 
					if($advanceSearchExist)
						$string='users/Projects/index?asearch%5B%5D='.$search['region'].'&asearch%5B%5D='.$search['district'].'&asearch%5B%5D='.$search['location_name'].'&asearch%5B%5D='.$search['description'].'&asearch%5B%5D='.$search['cost'].'&asearch%5B%5D='.$search['fundsource_type'].'';
					else
						$string='users/Projects?search='.$searchString.'';
				?>
				<select class='input-field' onchange="javascript:handleSelect(this,'<?php echo $string;?>&sortBy=')">
					<option value="" disabled selected>Sort by...</option>
					<option value="default">Default</option>
					<optgroup label="Ascending Order">
						<option value='region_ascending'>Region</option'>
						<option value='district_ascending'>District</option'>
						<option value='location_ascending'>Location</option'>
						<option value='description_ascending'>Description</option'>
						<option value='cost_ascending'>Cost</option'>
						<option value='fundsource_type_ascending'>Funding</option'>
					</optgroup>
					<optgroup label="Descending Order">
						<option value='region'>Region</option'>
						<option value='district'>District</option'>
						<option value='location'>Location</option'>
						<option value='description'>description</option'>
						<option value='cost'>Cost</option'>
						<option value='fundsource_type'>Funding</option'>
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
							<form id='search-bar-css' action=<?php echo base_url('users/Projects?'); ?> method="GET">
							    <div clas='section'>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="region">Region</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="district">District</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="location_name">Location</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="description">Description</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="cost">Cost</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="fundsource_type">Funding</label>
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
		              <th>Region</th>
		              <th>District</th>
		              <th>Location</th>
		              <th>Description</th>
		              <th>Cost</th>
		              <th>Funding</th>
		              <th></th>
		              <?php 
		              	if($authority==1){
		              		echo"
						<td>
							<form onsubmit='return confirm(\"Are you sure you want to create new project? \")' role='form' action ='";
				
				echo base_url('users/Projects/createProject');
				echo "' method='POST'>
							<center>
							<button type='submit' id='iconButton'><i class='material-icons' title='Create new project'>fiber_new</i></button></center>
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
						<td>".$proj_row['region']."</td>
						<td>".$proj_row['district']."</td>
						<td>".$proj_row['location_name']."</td>
						<td>".$proj_row['description']."</td>
						<td>".$proj_row['cost']."</td>
						<td>".$proj_row['fundsource_type']."</td>
						";
						if($authority==1){
							echo "
						<td>
							<form onsubmit='return confirm(\"Are you sure you want to update this project? \")' role='form' action ='";
				
				echo base_url('users/Projects/editProject');
				echo "' method='POST'>
							<center>
							<input type='hidden' name='proj[]' value='".$proj_row['project_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['office_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['region']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['district']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['location_name']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['description']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['cost']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['fundsource_type']."'>
							<button type='submit' id='iconButton'><i class='material-icons' title='edit'>edit</i></button></center>
							</form>
						</td>

						<td>
							<form onsubmit='return confirm(\"Are you sure you want to delete this project? \")' role='form' action ='";
				
				echo base_url('users/Projects/deleteProject');
				echo "' method='POST'>
							<center>
							<input type='hidden' name='proj[]' value='".$proj_row['project_id']."'>
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
		<div class="parallax"><img src="<?php echo base_url('assets/images/p_proj2.jpg')?>"></div>
	</div>

<script type="text/javascript">

function handleSelect(elm,url)
{	
	window.location.href = <?php echo json_encode(base_url()); ?>+url+elm.value;
}
</script>