<?php 
// $logged_info = $this->session->userdata('logged_info');
// var_dump($ingr_cat_list);
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="author" content="Jonathan Ben-Ammi">
 	<title></title>
 	<meta name="description" content="">
 	<link rel="stylesheet" type="text/css" href="/assets/css/materialize.css">
 	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">

 </head>
 <body>
 	<div class="container">
		<nav>
			<div class="nav-wrapper teal">
			<a href="#" class="brand-logo light"><dfn>RECIPE BINDER</dfn></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="sass.html">Sass</a></li>
					<li><a href="badges.html">Components</a></li>
					<li><a href="collapsible.html">JavaScript</a></li>
				</ul>
			</div>
		</nav>
		<div class="row">
			<h4 class="teal-text">Add New Ingredient</h4>
			<form class="col s6" action="/add_new_ingr">
	        <div class="row">
				<div class="input-field col s12">
 					<?php echo form_error('name'); ?>
				<label for="ingr_name">Ingredient:</label>
				<input type="text" placeholder="Tomato Paste" name="ingr_name" id="input_text" length="75"/>
				</div>
			</div>
				<label for="ingr_category">Ingredient Category:</label>
				<select name="ingr_category">
				<option value="" disabled selected>Choose your option</option>
					<?php for ($arrayopt = 0; $arrayopt < count($ingr_cat_list); $arrayopt++){ ?>
					<option value="<?= $ingr_cat_list[$arrayopt]['ingr_cat_id']; ?>"><?= $ingr_cat_list[$arrayopt]['ingr_category']; ?></option>
				<?php	} ?>
				</select>
				<p class="label">Measurement By:</p>
				<input class="with-gap" name="measure_grp" type="radio" id="weight" value="1" />
				<label for="weight">Weight</label>
				<input class="with-gap" name="measure_grp" type="radio" id="volume" value="2" />
				<label for="volume">Volume</label>
				<input class="with-gap" name="measure_grp" type="radio" id="piece" value="3" />
				<label for="piece">Piece</label>
				<br>
				<br>

	        <div class="row">
				<div class="input-field col s12">
 					<?php echo form_error('usda'); ?>
				<label for="usda_num">USDA Database:</label>
				<input type="text" placeholder="11065" name="usda_num" length="6"/>
				</div>
			</div>

			</form>
			<div class="col s5 offset-s1 blue">
				sdfa
			</div>
		</div>




 	</div>
 	<!-- Scripts -->
 	<script src="/assets/js/jquery-2.2.3.js"></script>
 	<script src="/assets/js/materialize.js"></script>
 	<script type="text/javascript">
 	$(document).ready(function() {

    $('select').material_select();

    $('input#input_text, textarea#textarea1').characterCounter();


  });
	</script>
</body>
 </html>