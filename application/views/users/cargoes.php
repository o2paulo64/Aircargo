

	<div class="parallax-container" >
		<div class="parallax"><img src="<?php echo base_url('assets/images/cargo2.jpg')?>"></div>
	</div>

	<div class="section white">
		<h5 class='padding'><center>Government Cargoes</center></h5>
		<div class='row'>
			<div class='col m4'></div>
			<div class='col m4'>
				<?php
					if($this->session->flashdata('editProjSuccess')==1) echo('<div class="green white-text"><center><strong>Cargo successfully Updated</strong></center></div>');
					else if($this->session->flashdata('deleteProjSuccess')==1) echo('<div class="green white-text"><center><strong>Cargo successfully Deleted</strong></center></div>');
					else if($this->session->flashdata('createProjSuccess')==1) echo('<div class="green white-text"><center><strong>Cargo successfully created</strong></center></div>');
				?>
			</div>
		</div>
		<div class='row'>
			<div class='col m1'></div>
			<div class='col m7'>
				<form id='search-bar-css' action=<?php echo base_url('users/Cargoes?search='); ?> method="GET">
			        <div class="input-field col s6">
			          <input name="search" type="text" class="validate">
			          <label for="search">Search</label>

			        </div>


			    </form>
			        
			    
			</div>
			<div class="col m3"  id='sortby'>
				<?php 
					if($advanceSearchExist)
						$string='users/Cargoes/index?asearch%5B%5D='.$search['type_of_objects'].'&asearch%5B%5D='.$search['no_objects'].'&asearch%5B%5D='.$search['overall_cost'].'&asearch%5B%5D='.$search['type'].'&asearch%5B%5D='.$search['operation_name'].'&asearch%5B%5D='.$search['airport_name'].'&asearch%5B%5D='.$search['rnum'].'&asearch%5B%5D='.$search['location_name'].'&asearch%5B%5D='.$search['description'].'&asearch%5B%5D='.$search['cost'].'&asearch%5B%5D='.$search['shipping_date'].'';
					else
						$string='users/Cargoes?search='.$searchString.'';
				?>
				<select class='input-field' onchange="javascript:handleSelect(this,'<?php echo $string;?>&sortBy=')">
					<option value="" disabled selected>Sort by...</option>
					<option value="default">Default</option>
					<optgroup label="Ascending Order">
						<option value='type_of_objects_ascending'>Type of Object</option'>
						<option value='no_objects_ascending'>Number of Objects</option'>
						<option value='overall_cost_ascending'>Overall Cost</option'>
						<option value='type_ascending'>Type</option'>
						<option value='operation_name_ascending'>Operation Name</option'>
						<option value='airport_name_ascending'>Airport Name</option'>
						<option value='rnum_ascending'>rnum</option'>
						<option value='location_name_ascending'>Location Name</option'>
						<option value='description_ascending'>Description</option'>
						<option value='cost_ascending'>Cost</option'>
						<option value='shipping_date_ascending'>Shipping Date</option'>
					</optgroup>
					<optgroup label="Descending Order">
						<option value='type_of_objects'>Type of Object</option'>
						<option value='no_objects'>Number of Objects</option'>
						<option value='overall_cost'>Overall Cost</option'>
						<option value='type'>Type</option'>
						<option value='operation_name'>Operation Name</option'>
						<option value='airport_name'>Airport Name</option'>
						<option value='rnum'>rnum</option'>
						<option value='location_name'>Location Name</option'>
						<option value='description'>Description</option'>
						<option value='cost'>Cost</option'>
						<option value='shipping_date'>Shipping Date</option'>
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
							<form id='search-bar-css' action=<?php echo base_url('users/Cargoes?'); ?> method="GET">
							    <div clas='section'>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="type_of_objects">Type of Object</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="Numberofone">Number of Objects</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="overall_cost">Overall Cost</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="start_date">Aircraft</label>
							        </div>
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
							          <label for="region">Region</label>
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
							          <label for="b">Cost</label>
							        </div>
							        <div class="input-field col s12">
							          <input name="asearch[]" type="text" class="validate">
							          <label for="av">Shipping Date</label>
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
		              <th>Type of Object</th>
		              <th>Number of Objects</th>
		              <th>Overall cost</th>
		              <th>Aircraft</th>
		              <th>Operation Name</th>
		              <th>Airport Name</th>
		              <th>Region</th>
		              <th>Location</th>
		              <th>Description</th>
		              <th>Cost</th>
		              <th>Shipping Date</th>
		              <th></th>
		              <?php 
		              	if($authority==1){
		              		echo"
						<td>
							<form onsubmit='return confirm(\"Are you sure you want to create new Cargo? \")' role='form' action ='";
				
				echo base_url('users/Cargoes/createCargo');
				echo "' method='POST'>
							<center>
							<button type='submit' id='iconButton'><i class='material-icons' title='Create new Cargo'>fiber_new</i></button></center>
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
						<td>".$proj_row['type_of_objects']."</td>
						<td>".$proj_row['no_objects']."</td>
						<td>".$proj_row['overall_cost']."</td>
						<td>".$proj_row['type']."</td>
						<td>".$proj_row['operation_name']."</td>
						<td>".$proj_row['airport_name']."</td>
						<td>".$proj_row['rnum']."</td>
						<td>".$proj_row['location_name']."</td>
						<td>".$proj_row['description']."</td>
						<td>".$proj_row['cost']."</td>
						<td>".$proj_row['shipping_date']."</td>
						";
						if($authority==1){
							echo "
						<td>
							<form onsubmit='return confirm(\"Are you sure you want to update this Cargo? \")' role='form' action ='";
				
				echo base_url('users/Cargoes/editCargo');
				echo "' method='POST'>
							<center>
							<input type='hidden' name='proj[]' value='".$proj_row['report_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['project_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['operator_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['airport_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['cargo_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['aircraft_registration']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['type_of_objects']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['no_objects']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['overall_cost']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['type']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['operation_name']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['airport_name']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['rnum']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['location_name']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['description']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['cost']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['shipping_date']."'>
							<button type='submit' id='iconButton'><i class='material-icons' title='edit'>edit</i></button></center>
							</form>
						</td>

						<td>
							<form onsubmit='return confirm(\"Are you sure you want to delete this Cargo? \")' role='form' action ='";
				
				echo base_url('users/Cargoes/deleteCargo');
				echo "' method='POST'>
							<center>
							<input type='hidden' name='proj[]' value='".$proj_row['report_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['project_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['operator_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['airport_id']."'>
							<input type='hidden' name='proj[]' value='".$proj_row['cargo_id']."'>
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
		<div class="parallax"><img src="<?php echo base_url('assets/images/cargo1.jpeg')?>"></div>
	</div>

<script type="text/javascript">

function handleSelect(elm,url)
{	
	window.location.href = <?php echo json_encode(base_url()); ?>+url+elm.value;
}
</script>