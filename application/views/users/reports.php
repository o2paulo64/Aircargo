

	<div class="parallax-container" >
		<div class="parallax"><img src="<?php echo base_url('assets/images/inci.jpg')?>"></div>
	</div>

	<div class="section white">
		<h5 class='padding'><center>Accident / Incident Reports</center></h5>
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
				<form id='search-bar-css' action=<?php echo base_url('users/Reports?search='); ?> method="GET">
			        <div class="input-field col s6">
			          <input name="search" type="text" class="validate">
			          <label for="search">Search</label>

			        </div>


			    </form>
			        
			    
			</div>
			<div class="col m3"  id='sortby'>
				<?php 
					if($advanceSearchExist)
						$string='users/Reports/index?asearch%5B%5D='.$search['operation_name'].'&asearch%5B%5D='.$search['airport_name'].'&asearch%5B%5D='.$search['type'].'&asearch%5B%5D='.$search['classification'].'&asearch%5B%5D='.$search['description'].'';
					else
						$string='users/Reports?search='.$searchString.'';
				?>
				<select class='input-field' onchange="javascript:handleSelect(this,'<?php echo $string;?>&sortBy=')">
					<option value="" disabled selected>Sort by...</option>
					<option value="default">Default</option>
					<optgroup label="Ascending Order">
						<option value='operation_name_ascending'>Operation Name</option'>
						<option value='airport_name_ascending'>Airport Name</option'>
						<option value='aircraft_type_ascending'>Aircraft Type</option'>
						<option value='classification_ascending'>Classification</option'>
						<option value='description_ascending'>Description</option'>
					</optgroup>
					<optgroup label="Descending Order">
						<option value='operation_name'>Operation Name</option'>
						<option value='airport_name'>Airport Name</option'>
						<option value='aircraft_type'>Aircraft Type</option'>
						<option value='classification'>Classification</option'>
						<option value='description'>Description</option'>
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
							<form id='search-bar-css' action=<?php echo base_url('users/Reports?'); ?> method="GET">
							    <div clas='section'>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="operation_name">Operation Name</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="airport_name">Airport Name</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="aircraft_type">Aircraft Type</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="classification">Classification</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="description">Description</label>
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
		              <th>Operation Name</th>
		              <th>Airport Name</th>
		              <th>Aircraft Type</th>
		              <th>Classification</th>
		              <th>Description</th>
		              <th></th>
		              <?php 
		              	if($authority==1){
		              		echo"
						<td>
							<form onsubmit='return confirm(\"Are you sure you want to create new project? \")' role='form' action ='";
				
				echo base_url('users/Reports/createReport');
				echo "' method='POST'>
							<center>
							<button type='submit' id='iconButton'><i class='material-icons' title='Create new report'>fiber_new</i></button></center>
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
						<td>".$proj_row['operation_name']."</td>
						<td>".$proj_row['airport_name']."</td>
						<td>".$proj_row['type']."</td>
						<td>".$proj_row['classification']."</td>
						<td>".$proj_row['description']."</td>
						";
						if($authority==1){
							echo "
						<td>
							<form onsubmit='return confirm(\"Are you sure you want to update this project? \")' role='form' action ='";
				
				echo base_url('users/Reports/editReport');
				echo "' method='POST'>
							<center>
							<input type='hidden' name='proj[]' value='".$proj_row['report_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['airport_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['operator_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['typeno']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['operation_name']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['airport_name']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['aircraft_registration']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['classification']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['description']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['type']."'>
							<button type='submit' id='iconButton'><i class='material-icons' title='edit'>edit</i></button></center>
							</form>
						</td>

						<td>
							<form onsubmit='return confirm(\"Are you sure you want to delete this project? \")' role='form' action ='";
				
				echo base_url('users/Reports/deleteReport');
				echo "' method='POST'>
							<center>
							<input type='hidden' name='proj[]' value='".$proj_row['report_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['airport_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['operator_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['typeno']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['aircraft_registration']."'>
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
		<div class="parallax"><img src="<?php echo base_url('assets/images/inci2.jpg')?>"></div>
	</div>

<script type="text/javascript">

function handleSelect(elm,url)
{	
	window.location.href = <?php echo json_encode(base_url()); ?>+url+elm.value;
}
</script>