<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

	<title><?php echo $browserTitle; ?></title>

	<!-- CSS  -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<?php echo link_tag('assets/css/materialize.css')?>
	<?php echo link_tag('assets/css/style.css')?>

	<link rel="icon" type="image/png" href="<?php echo base_url('assets/images/favicon.png')?>">
</head>

<body>
		<nav class='white' role="navigation">
			<div class="nav-wrapper container"><a id="logo-container" href="<?php echo base_url();?>home" class="brand-logo black-text center">AirCargo</a>
				<ul class="right hide-on-med-and-down black-text">
					<li><a class="black-text" href="<?php echo base_url();?>login" >Login<i class="material-icons right">account_circle</i></a></li>
					
				</ul>

				<ul id="nav-mobile" class="side-nav">
					<li><a href="#">Navbar Link</a></li>
				</ul>

				<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
			</div>

		</nav>
