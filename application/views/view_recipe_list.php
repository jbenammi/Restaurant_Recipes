<?php 
// var_dump($recipelist);
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="author" content="Jonathan Ben-Ammi">
 	<title></title>
 	<meta name="description" content="">
 	<link rel="stylesheet" type="text/css" href="/assets/css/materialize.css">
 	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link rel="stylesheet" href="/assets/css/materialize_icons.css">
 </head>
 <body id="backgroundbody">
		<nav>
			<div class="nav-wrapper blue-grey">
			<a href="#" class="brand-logo light"><dfn>RecipeNimbus</dfn></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="/new_ingredient">New Ingredient</a></li>
					<li><a href="/view_ingredients">View Ingredients</a></li>
					<li><a href="/add_recipe">Add Recipe</a></li>
					<li><a href="/logout">Logout</a></li>
				</ul>
			</div>
		</nav>	
  	<div class="container row white">
		<div class="row col s6">
			<h4 class="teal-text">Recipes:</h4>
			<div class="row">
				<table>
					<thead>
						<th class="col s6">Name:</th>
						<th class="col s3">Servings</th>
						<th class="col s3">Category</th>
					</thead>
				</table>
			</div>
			<div id="recTable" class="row v-scroll">	
				<table>	
					<tbody>
			<?php 
				for ($variable = 0; $variable < count($recipelist); $variable ++) { ?>
					<tr>
						<td class="col s6"><a href="/view_recipe/<?= $recipelist[$variable]['recipe_id']; ?>"><?= $recipelist[$variable]['name']; ?></a></td>
						<td class="col s3"><?= $recipelist[$variable]['servings']; ?></td>
						<td class="col s3"><?= $recipelist[$variable]['category']; ?></td>
					</tr>
			<?php	}

			?>		</tbody>
				</TABLE>
			</div>
		</div>
		<div class="row col s6">
			
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