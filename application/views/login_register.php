<?php 
$login_error = $this->session->flashdata('login_error');
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="author" content="Jonathan Ben-Ammi">
 	<title>Favorie Quotes</title>
 	<meta name="description" content="">
 	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
 </head>
 <body>
 	 	<div id="container">
 		<h3>Welcome to Recipe Binder!</h3>
		<?php if(isset($login_error)){ ?>
			<p class="warning"><?= $login_error; ?></p>
		<?php  } ?>
		<fieldset class="login">
			<legend>Register</legend> 
 		<form id="Register" action="/register" method="post">
 					<?php echo form_error('name'); ?>
				<label for="name">Name: </label><input type="text" placeholder="John Smith" name="name" />
 					<?php echo form_error('alias'); ?>
                <label for="username">Alias: </label><input type="text" placeholder="Johnny" name="alias" />
 					<?php echo form_error('email'); ?>
                <label for="email">E-Mail: </label><input type="text" placeholder="something@something.com" name="email" />
 					<?php echo form_error('password'); ?>
				<label for="password">Password: </label><input type="password" placeholder="********" name="password" />
				<p class="warning">*Password should be at least 8 characters</p>
 					<?php echo form_error('confirmpass'); ?>
				<label for="confirmpass">Confirm PW: </label><input type="password" placeholder="********" name="confirmpass" />
 					<?php echo form_error('birthdate'); ?>
				<label for="birthdate">Birthdate: </label><input type="date" placeholder="12/27/1978" name="birthdate" />

				<input class="button2" type="submit" value="Register" />
 		</form>
		</fieldset>
		<fieldset class="login">
			<legend>Login</legend>
 		<form id="login" action="/signin" method="post">
 					<?php echo form_error('email2'); ?>
                <label for="email">E-Mail: </label><input type="text" placeholder="something@something.com" name="email2" />
 					<?php echo form_error('password2'); ?>
                <label for="password">Password: </label><input type="password" placeholder="********" name="password2" />
                <input class="button2"type="submit" name="action" value="Login" />
                </form>
 		</form>
		</fieldset>
 	</div>
 </body>
 </html>