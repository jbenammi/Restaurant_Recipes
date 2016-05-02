<?php 
// var_dump($ingr_list);
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
			<h4 class="teal-text">Ingredient List</h4>
			<div class="row">
				<table>
					<thead>
						<th class="col s4">Ingredient</th>
						<th class="col s2">USDA Number</th>
						<th class="col s2">UOM Type</th>
						<th class="col s2">Storage Category</th>
						<th class="col s2">USDA Info</th>
					</thead>
				</table>
			</div>
			<div id="ingrTable" class="row v-scroll">	
				<table>	
					<tbody>
			<?php 
				for ($variable = 0; $variable < count($ingr_list); $variable ++) { ?>
					<tr>
						<td><?= $ingr_list[$variable]['name']; ?></td>
						<td><?= $ingr_list[$variable]['usda_number']; ?></td>
						<td><?= $ingr_list[$variable]['uom_type']; ?></td>
						<td><?= $ingr_list[$variable]['ingr_category']; ?></td>
						<td><button  class="btn-floating-sml waves-effect waves-light blue-grey" type="submit" name="action" value="<?= $ingr_list[$variable]['usda_number']; ?>"><i class="material-icons">view_list</i></button></td>
					</tr>
			<?php	}

			?>		</tbody>
				</TABLE>
			</div>
		</div>
		<div class="row col s6">
			<h4 class="teal-text">USDA Nutritional Information</h4>
			<p class="label">(per 100 grams)</p>
	
			<div class="row col s12">
				<div id="usda_header">
				</div>
				<div id="usda_info">
				</div>
			</div>
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


	$('button').click(function() {
        var result = $(this).val();
        var new_url = " http://api.nal.usda.gov/ndb/reports/?ndbno=";
        new_url += result;
        new_url += "&type=b&format=json&api_key=cy5UKYS7bNXlwzTdEZSESbNs4jmXQsGDPI8Ebjzi";
        console.log(new_url);
        $.get(new_url, function(res) {
        	console.log(res.report.food.nutrients);
            var variable = res.report.food;
            var nutrients = res.report.food.nutrients;
            var list = "";
            var hlist = "";
            hlist += "<h6><b>" + variable['ndbno'] + " " + variable['name'] + "</b></h6>";
            hlist += "<TABLE><thead><th>Nutrient</th><th>Value</th><th>Unit</th></thead></TABLE>";
            list += "<TABLE class='striped'>";
            for (var x = 0; x < nutrients.length; x ++) {
            	list += "<tr><td>" + nutrients[x]['name'] + "</td><td>" + nutrients[x]['value'] + "</td><td>" + nutrients[x]['unit'] + "</td></tr>"
            }
            list += "</TABLE>"
            $("#usda_header").html(hlist);
            $("#usda_info").html(list);

            console.log(list);

        }, 'json');
        // don't forget to return false so the page doesn't refresh
        return false;
    });


  });
	</script>
 </body>
 </html>