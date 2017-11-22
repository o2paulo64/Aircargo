<!doctype html>
<html lang="en">

<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login to Events</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
		<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/logo.png')?>">
		
		<?php echo link_tag('assets/css/bootstrap.min.css')?>
		<?php echo link_tag('assets/css/style.css')?>
		<?php echo link_tag('assets/css/login.css')?>
	</head>

	<body>
		<div class='container'>
			<div class="loginmodal-container" style="margin-top: 20px;">
				<h1>Ayala Events Registration</h1><br>
				<?php
					if(validation_errors() != ""){
						echo('<div class="alert alert-danger"><strong>'.validation_errors().'</strong></div>');
					}
				?>
				<form action ="<?php echo base_url('login/verifyLogin'); ?>" method='POST' id='timezones'>
					<input type='text' name='username' placeholder='Username'>
					<input type="hidden" name="timezone" id="timezone">
					<input type='password' name='password' placeholder='Password' style='text-decoration: none;'>
					<input type='submit' name='login' class='login loginmodal-submit' value='Login'>
				</form>
			</div>
		</div>
	</body>
</html>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>

<script>
$(document).ready(function(){
    var tz = jstz.determine(); // Determines the time zone of the browser client
    var timezone = tz.name(); //'Asia/Kolhata' for Indian Time.
	document.getElementById('timezone').value = timezone;
  	document.getElementById('timezones');

    
  });
</script>
