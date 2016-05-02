<?php 
$logged_info = $this->session->userdata('logged_info');
// var_dump($logged_info);
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="author" content="Jonathan Ben-Ammi">
 	<title>Recipe Binder-New Recipe</title>
 	<meta name="description" content="">
 	<link rel="stylesheet" type="text/css" href="/assets/css/materialize.css">
 	<link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.css">
 	<link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.structure.css">
 	<link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.theme.css">
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
	<form action="/create_recipe" method="post">
		<div class="col s12">
			<h4 class="blue-grey-text col s6">Add Recipe</h4>
		</div>
		<div class="col s12">
			<div class="col s4">
				<label for="recipe_name">Recipe Name:</label>	
				<input type="text" placeholder="Tomato Soup" name="recipe_name" length="150"/>
			</div>
			<div class="col s1">
				<label for="servings">Servings:</label>	
				<input type="text" placeholder="24" name="servings" length="4" />
			</div>
			<div class="col s3">
				<label for="recipeCat">Recipe Category:</label>	
				<select name="rec_cat"> 
				<?php for ($i =0; $i < count($rec_cat_list); $i++) { ?>
					<option value="<?= $rec_cat_list[$i]['id']; ?>"><?= $rec_cat_list[$i]['category']; ?></option>
			<?php	} ?>
				</select>
			</div>			
			<div class="col s2 offset-s5">
			</div>			
		</div>
		<div class="row col s12">
			<div class="col s6">	
				<div class="row ingr_title">
					<p id= "ingtitle" class="col s5">Ingredient:</p><p class="col s2 offset-s2">Amount:</p><p class="col s2">Measurement:</p>
				</div>
				<div class="row" id='TextBoxesGroup'>
				</div>
				<div class="col s12">
				<button  id="addButton" class="btn-floating-sml btn-small waves-effect waves-light blue-grey" type="button" value="Add ingredient"><i class="large material-icons">add</i></button>
				</div>
			</div>
			<div class="col s6">
				<div class="row ingr_title">
					<p class="col s12">Directions:</p>
				</div>
				<div class="row" id='directionBoxesGroup'>
				<textarea class="col s12" rows="50" name="directions" length="500"></textarea>
				</div>
				<button  id="recipeButton" class="btn waves-effect valign waves-light blue-grey" type="submit">Add<i class="material-icons right">note_add</i></button>
			</div>
		</div>
	</form>
 	</div>
 	<!-- Scripts -->
 	<script src="/assets/js/jquery-2.2.3.js"></script>
	<script src="/assets/js/jquery-ui.js"></script>
 	<script src="/assets/js/materialize.js"></script>
 	<script type="text/javascript">
 	$(document).ready(function() {

    // $('select').material_select();

    $('input#input_text, textarea#textarea1').characterCounter();

// This section of code regulates the adding of new ingredients to the recipe
    var counter = 1;
		
    $("#addButton").click(function () {
				
	if(counter>20){
            alert("Only 20 ingredients allowed");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr({
	     	id: 'IngredientBoxDiv' + counter,
	     	class: 'ingr_div row'
	     })
    
    var list = '';
    var ingr_list = <?= json_encode($ingr_list);?>;
    var unit_list = <?= json_encode($unit_list);?>;
    list += '<div class="col 1"><button class="btn-floating-sml waves-effect waves-light red removeButton" type="button" value="Remove last ingredient"><i class="mini material-icons">close</i></button></div>'
    list += '<div class="ingr col s6"><select class="ingredient" name="ingr_' + counter + '" ><option value="" disabled selected>Select Ingredient</option>';
		for (var x = 0; x < ingr_list.length; x++){ 
			list += '<option value="' + ingr_list[x]['ingr_id'] + '">' + ingr_list[x]['name'] + '</option>';
		}
	list += '</select></div>';
	list += '<div class="amt col s2" id="amt_' + counter + '"><input type="text" name="amt_' + counter + '" length="4"/></div>';
	list += '<div class="unit col s3" id="unit_' + counter + '"></div>'
		
	newTextBoxDiv.after().html(list);

	newTextBoxDiv.appendTo("#TextBoxesGroup");
				
    $('input#input_text, textarea#textarea1').characterCounter();
     });
    $(document).on('change', ".ingredient", function(){
    	var ingr_list = <?= json_encode($ingr_list);?>;
	    var unit_list = <?= json_encode($unit_list);?>;
	    var uom_id = "";
	    var list = "";
	   	console.log(unit_list);
	    list += '<select class="unit" name="unit_' + counter + '" ><option value="" disabled selected>Select Units</option>';
	    console.log(list);
    	for (var m = 0; m < ingr_list.length; m++){
    		if (ingr_list[m]['ingr_id'] == $(this).val()) {
    			uom_id = ingr_list[m]['uom_type_id'];
    		}
    	}
    	console.log(uom_id);
    	for (var i = 0; i < unit_list.length; i++) {
    		if(uom_id == unit_list[i]['uom_categories_id']){
				list += '<option value="' + unit_list[i]['id'] + '">' + unit_list[i]['unit'] +"/" + unit_list[i]['abrev'] + '</option>';
			}
    	}
    	console.log(list);
		list += '</select></div></div>'

		$("#unit_" + counter).html(list);


	counter++;
    });

    $(document).on('click', ".removeButton", function(){

			
        $(this).parents('div.ingr_div').remove();
			
     });
     // END Recipe Ingredient code

 });
</script>
</body>
 </html>