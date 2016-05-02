<?php 
$login_error = $this->session->flashdata('login_error');
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="author" content="Jonathan Ben-Ammi">
 	<title>Recipe Binder</title>
 	<meta name="description" content="The cloud recipe storage solution for your restaurant">
 	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
 	<link rel="stylesheet" type="text/css" href="/assets/css/materialize.css">
 	<link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.css">
 	<link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.structure.css">
 	<link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.theme.css">
 </head>
 <body id="registerbody">
	<div class="container row">
		<nav>
			<div class="nav-wrapper blue-grey">
			<a href="#" class="brand-logo light"><dfn>RECIPE BINDER</dfn></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="/">Login</a></li>
				</ul>
			</div>
		</nav> 

 		<h3 class="light white-text">Register with <dfn>RECIPE BINDER!</dfn></h3>
		<?php if(isset($login_error)){ ?>
			<p class="warning"><?= $login_error; ?></p>
		<?php  } ?>
		<div class="col s6 offset-s6 blue-grey lighten-4">		
		<div id="Register" class="col s12 blue-grey lighten-4">
		<br>
 		<form action="/register" method="post">
 					<?php echo form_error('fname'); ?>
				<label for="fname">First Name: </label><input type="text" name="fname" />
 					<?php echo form_error('lname'); ?>
				<label for="lname">Last Name: </label><input type="text" name="lname" />
					<?php echo form_error('restaurant'); ?>
                <label for="restaurant">Restaurant: </label><input type="text" name="restaurant" />
 					<?php echo form_error('email'); ?>
                <label for="email">E-Mail: </label><input type="text" name="email" />
 					<?php echo form_error('password'); ?>
				<label for="password">Password: </label>
				<p class="label">*Password should be at least 8 characters</p>
				<input type="password" name="password" />
 					<?php echo form_error('confirmpass'); ?>
				<label class="b" for="confirmpass">Confirm PW: </label><input type="password" name="confirmpass" />
 

				<input class="btn waves-effect waves-light blue-grey" type="submit" value="Register" />
 		</form>
 		<br>
 		</div>
		</div>
 	</div>

 	<script src="/assets/js/jquery-2.2.3.js"></script>
	<script src="/assets/js/jquery-ui.js"></script>
 	<script src="/assets/js/materialize.js"></script>
 </body>
 </html>