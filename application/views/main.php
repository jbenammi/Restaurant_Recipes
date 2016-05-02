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
 	<link rel="stylesheet" type="text/css" href="/assets/css/materialize.css">
 	<link rel="stylesheet" href="/assets/css/materialize_icons.css">
 	<link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.css">
 	<link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.structure.css">
 	<link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.theme.css">
 	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
 </head>
 <body id="loginbody">
		<nav>
			<div class="nav-wrapper blue-grey">
			<a href="#" class="brand-logo light"><dfn>RecipeNimbus</dfn></a>

			</div>
		</nav> 
	<div id="containerMain" class="container row">

 		<!-- <h3 class="light">Welcome to <dfn>RECIPE BINDER!</dfn></h3> -->
		<?php if(isset($login_error)){ ?>
			<div class="col s8 offset-s4">
			<p class="white red-text"><?= $login_error; ?></p>
			</div>
		<?php  } ?>

		<div class="col s8 offset-s4">
			<div id="backdiv" class="col s12 blue-grey lighten-4">
				<ul class="tabs blue-grey-text ">
					<li class="tab col s6 blue-grey-text"><a href="#login">Login</a></li>
					<li class="tab col s6"><a href="#register">Register</a></li>
				</ul>
				<div id="login" class="col s6 push blue-grey lighten-4">
			 		<form action="/signin" method="post">
		 					<?php echo form_error('email2'); ?>
		                <label for="email2">E-Mail: </label>
		                <input type="text" name="email2" />
							<?php echo form_error('restaurant2'); ?>
		                <label for="restaurant2">Restaurant: </label>
		                <input type="text" name="restaurant2" />
		                <?php echo form_error('password2'); ?>
		                <label for="password2">Password: </label>
		                <input type="password" name="password2" />
		                <input class="btn waves-effect waves-light blue-grey" type="submit" name="action" value="Login" /> 
	                </form>
	            </div>
				<div id="register" class="col s12 blue-grey lighten-4">
			 		<form action="/register" method="post">
			 			<div class="row">
		 				<div class="col s6">
		 					<?php echo form_error('fname'); ?>
							<label for="fname">First Name: </label>
							<input type="text" name="fname" />
						</div>
						<div class="col s6">
			 				<?php echo form_error('lname'); ?>
							<label for="lname">Last Name: </label>
							<input type="text" name="lname" />
						</div>
						<div class="col s6">
							<?php echo form_error('restaurant'); ?>
			                <label for="restaurant">Restaurant Name: </label>
			                <input type="text" name="restaurant" />
						</div>
						<div class="col s6">
			 					<?php echo form_error('email'); ?>
			                <label for="email">E-Mail: </label>
			                <input type="text" name="email" />
						</div>
						<div class="col s6">
							<?php echo form_error('address'); ?>
			                <label for="address">Restaurant Address: </label>
			                <input type="text" name="address" />
						</div>
						<div class="col s6">
			 					<?php echo form_error('city'); ?>
			                <label for="city">City: </label>
			                <input type="text" name="city" />
						</div>
						<div class="col s2">
							<?php echo form_error('state'); ?>
			                <label for="state">State: </label>
			                <select class="blue-grey lighten-4" name="state">
			                	<option selected disabled value="">Select</option>
			                	<option value="AL">AL</option>
								<option value="AK">AK</option>
								<option value="AZ">AZ</option>
								<option value="AR">AR</option>
								<option value="CA">CA</option>
								<option value="CO">CO</option>
								<option value="CT">CT</option>
								<option value="DE">DE</option>
								<option value="FL">FL</option>
								<option value="GA">GA</option>
								<option value="HI">HI</option>
								<option value="ID">ID</option>
								<option value="IL">IL</option>
								<option value="IN">IN</option>
								<option value="IA">IA</option>
								<option value="KS">KS</option>
								<option value="KY">KY</option>
								<option value="LA">LA</option>
								<option value="ME">ME</option>
								<option value="MD">MD</option>
								<option value="MA">MA</option>
								<option value="MI">MI</option>
								<option value="MN">MN</option>
								<option value="MS">MS</option>
								<option value="MO">MO</option>
								<option value="MT">MT</option>
								<option value="NE">NE</option>
								<option value="NV">NV</option>
								<option value="NH">NH</option>
								<option value="NJ">NJ</option>
								<option value="NM">NM</option>
								<option value="NY">NY</option>
								<option value="NC">NC</option>
								<option value="ND">ND</option>
								<option value="OH">OH</option>
								<option value="OK">OK</option>
								<option value="OR">OR</option>
								<option value="PA">PA</option>
								<option value="RI">RI</option>
								<option value="SC">SC</option>
								<option value="SD">SD</option>
								<option value="TN">TN</option>
								<option value="TX">TX</option>
								<option value="UT">UT</option>
								<option value="VT">VT</option>
								<option value="VA">VA</option>
								<option value="WA">WA</option>
								<option value="WV">WV</option>
								<option value="WI">WI</option>
								<option value="WY">WY</option>
			                </select>
						</div>
						<div class="col s4">
			 					<?php echo form_error('zip'); ?>
			                <label for="zip">Zip Code: </label>
			                <input type="text" name="zip" />
						</div>
						<div class="col s6">
			 					<?php echo form_error('phone'); ?>
			                <label for="phone">Phone: </label>
			                <input type="text" name="phone" />
						</div>						<p class="label col s12">*Password should be at least 8 characters</p>
						<div class="col s6">
			 					<?php echo form_error('password'); ?>
							<label for="password">Password: </label>
							<input type="password" name="password" />
						</div>
						<div class="col s6">
			 					<?php echo form_error('confirmpass'); ?>
							<label for="confirmpass">Confirm PW: </label>
							<input type="password" name="confirmpass" />
						</div>
						<div class="col s12">
		 				<input class="btn disabled waves-effect waves-light blue-grey" type="submit" value="Register" />
		 				</div>
		 				</div>
			 		</form>				
	            </div>
            </div>  
        </div>
	</div>
 	<script src="/assets/js/jquery-2.2.3.js"></script>
	<script src="/assets/js/jquery-ui.js"></script>
 	<script src="/assets/js/materialize.js"></script>

	<script>
	$(document).ready(function(){

		$(function() {
		$( "#tabs" ).tabs();
		});


	});
	</script>
 </body>
 </html>