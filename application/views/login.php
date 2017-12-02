<div class="parallax-container">
	<div class="parallax"><img src="<?php echo base_url('assets/images/sky.jpg')?>"></div>
</div>


	<center>
  	<div class="section"></div>
  	<div class="container">
		<div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 58px 0px 58px; border: 1px solid #EEE;">
			<h5 class="black-text">Login as Administrator</h5>
			<?php
				if(validation_errors() != ""){
					echo('<div class="red-text"><strong>'.validation_errors().'</strong></div>');
				}
			?>
			<form class="col s12" action ="<?php echo base_url('login/verifyLogin'); ?>" method="post">
				<div class='row'>
					<div class='col s12'></div>
				</div>

				<div class='row'>
					<div class='input-field col s12'>
						<input class='validate' type='text' name='username' id='username' />
						<label for='username'>Username</label>
					</div>
				</div>

				<div class='row'>
					<div class='input-field col s12'>
						<input class='validate' type='password' name='password' id='password' />
						<label for='password'>Password</label>
					</div>
				</div>
				<center>
					<div class='row'>
						<button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect yellow darken-3'>Login</button>
					</div>
				</center>
			</form>
		</div>
	</div>
    </center>

<div class="parallax-container">
	<div class="parallax"><img src="<?php echo base_url('assets/images/sky2.jpg')?>"></div>
</div>

