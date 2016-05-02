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
 	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- 	<link rel="stylesheet" href="/assets/css/materialize_icons.css">
 -->

 </head>
 <body id="backgroundbody">
		<nav>
			<div class="nav-wrapper blue-grey">
			<a href="#" class="brand-logo light"><dfn>RecipeNimbus</dfn></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
					<li><a href="/get_recipe_lists">Recipe List</a></li>
					<li><a href="/new_ingredient">New Ingredient</a></li>
					<li><a href="/view_ingredients">View Ingredients</a></li>
					<li><a href="/add_recipe">Add Recipe</a></li>
					<li><a href="/logout">Logout</a></li>
				</ul>
			</div>
		</nav>
 	<div class="container row white">
		<div class="row col s6">
			<h4 class="teal-text">Add New Ingredient</h4>
			<div class="row">
			<form id="add_ingredient" class="col s12" action="/add_new_ingr" method="post">
	        <div class="row">
				<div class="input-field col s12">
 					<?php echo form_error('name'); ?>
				<label for="ingr_name">Ingredient:</label>
				<input type="text" placeholder="Tomato Paste" name="ingr_name" id="input_text" length="75"/>
				</div>
			</div>
				<label for="ingr_category">Ingredient Category:</label>
				<select name="ingr_category">
				<option value="" disabled selected>Select a category</option>
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
				<button class="btn waves-effect waves-light blue-grey" type="submit" name="action">Add<i class="material-icons right">note_add</i></button>
			</form>
			</div>
		</div>
		<div class="row col s6">
			<h4 class="blue-grey-text">Search USDA Database</h4>
			<div>
				<form id="search_usda" action="" method="post">
					<label for="ingr_search">Ingredient:</label>
					<input type="text" placeholder="butter" id="ingr_search" />
					<button class="btn waves-effect waves-light blue-grey" type="submit" name="action">Search<i class="material-icons right">input</i></button>
				</form>
 			</div>		
			<div id="usda_list">
			
			</div>
		</div>
	</div>

 	<!-- Scripts -->
 	<script src="/assets/js/jquery-2.2.3.js"></script>
 	<script src="/assets/js/materialize.js"></script>
 	<script type="text/javascript">
 	$(document).ready(function() {

    // $('select').material_select();

    $('input#input_text, textarea#textarea1').characterCounter();


	$('#search_usda').submit(function() {
        var result = $('#ingr_search').val();
        var new_url = "http://api.nal.usda.gov/ndb/search/?format=json&q=";
        new_url += result;
        new_url += "&sort=n&offset=0&api_key=cy5UKYS7bNXlwzTdEZSESbNs4jmXQsGDPI8Ebjzi";
        console.log(new_url);
        $.get(new_url, function(res) {
        	console.log(res.list.item.length);
            var something = res.list.item;
            var list = "";
            list += "<ul>";
            for(var i = 0; i < something.length; i++){
            	list += "<li>" + something[i].ndbno + " " + something[i].name + "</li>"
            }
            list += "</ul>"
            $("#usda_list").html(list);
            console.log(list);

        }, 'json');
        // don't forget to return false so the page doesn't refresh
        return false;
    });


  });
	</script>
</body>
 </html>