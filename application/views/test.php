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
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
<!-- 	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css"> -->
	<script type="text/javascript" src="/assets/js/jquery-2.2.3.js"></script>
	<script type="text/javascript" src=""></script>



 

</head>

<body>

<h1>jQuery add / remove textbox example</h1>

<script type="text/javascript">

$(document).ready(function(){

    var counter = 1;
		
    $("#addButton").click(function () {
				
	if(counter>20){
            alert("Only 20 ingredients allowed");
            return false;
	}   
		
	var newTextBoxDiv = $(document.createElement('div'))
	     .attr({
	     	id: 'IngredientBoxDiv' + counter,
	     	class: 'ingr_div'
	     })
    
    var list = '';
    var ingr_list = <?= json_encode($ingr_list);?>;
    var unit_list = <?= json_encode($unit_list);?>;
    list += '<div class="ingr"><select class="ingredient" name="ingr_' + counter + '" ><option value="" disabled selected>Select Ingredient</option>';
		for (var x = 0; x < ingr_list.length; x++){ 
			list += '<option value="' + ingr_list[x]['ingr_id'] + '">' + ingr_list[x]['name'] + '</option>';
		}
	list += '</select></div>';
	list += '<div class="amt" id="amt_' + counter + '"><input type="text" name="amt_' + counter + '" /></div>';
	list += '<div class="unit" id="unit_' + counter + '"></div>'
		
	newTextBoxDiv.after().html(list);

	newTextBoxDiv.appendTo("#TextBoxesGroup");
				
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
		list += '</select></div>'

		$("#unit_" + counter).html(list);
	counter++;
    });
     $("#removeButton").click(function () {
	if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
	counter--;
			
        $("#IngredientBoxDiv" + counter).remove();
			
     });

 
  });
</script>
</head><body>
<form action="#" method="post">
<div id='TextBoxesGroup'>

</div>
<input type='button' value='Add ingredient' id='addButton'>
<input type='button' value='Remove last ingredient' id='removeButton'>
<input type="submit" value="Create Recipe" />
</form>
</body>
</html>