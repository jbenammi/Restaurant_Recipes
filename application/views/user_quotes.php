<?php 

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="author" content="Jonathan Ben-Ammi">
 	<title></title>
 	<meta name="description" content="">
 	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">

 </head>
 <body>
 	<div id="container">
 		<div class="header_links">
 			<ul>
 				<li><a href="/dashboard">Dashboard</a></li>
 				<li> | </li>		
 				<li><a href="/logout">Logout</a></li>
 			</ul>
 		</div>
 		<h2>Posts by <?= $quote_list[0]['alias']; ?></h2>
 		<h3>Count <?php 
 				$count = 0;
 				for ($quote_array = 0; $quote_array < count($quote_list); $quote_array ++){
 					$count ++;
 				}
 				echo $count; ?></h3>

 		<?php 
 			for ($quote_array = 0; $quote_array < count($quote_list); $quote_array ++) { ?>
 			<div class="single_quote">
 				<p><span><?= $quote_list[$quote_array]['quoted_by']; ?>:</span> <?= $quote_list[$quote_array]['quote']; ?></p>
 			</div>
 		<?php	}	?>	

 	</div>
 </body>
 </html>