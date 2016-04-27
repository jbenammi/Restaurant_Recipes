<?php 
$logged_info = $this->session->userdata('logged_info');

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
 				<li><a href="/logout">Logout</a></li>
 			</ul>
 		</div>
 		<h2>Welcome <?= $logged_info['alias']; ?>!</h2>

 		<fieldset class="dash_field">
 			<legend>Quotable Quotes</legend>
 		<div id="quotes_left">
 			<?php 
 			for($quote_array = 0; $quote_array < count($quotelist); $quote_array ++){ ?>
	 			<div class="quote">
	 				<p class="message"><span><?= $quotelist[$quote_array]['quoted_by'];?>:</span> <?= $quotelist[$quote_array]['quote'];?></p>
	 				<p class="posted_by">posted by <a href="/view_quotes/<?= $quotelist[$quote_array]['posted_by_id'];?> "><?= $quotelist[$quote_array]['alias'];?></a></p>
	 				<a href="/add_to_favorites/<?= $logged_info['id'];?>/<?= $quotelist[$quote_array]['quotes_id'];?>"><button class="button">Add to My List</button></a>
	 			</div>

 		<?php	} ?>
 		</div>
 		</fieldset>
		<fieldset class="dash_field">
			<legend>Your Favorites</legend>
 		<div id="quotes_right">
 			<?php 
 			for($quote_array = 0; $quote_array < count($favorites); $quote_array ++){ ?>
	 			<div class="quote">
	 				<p class="message"><span><?= $favorites[$quote_array]['quoted_by'];?>:</span> <?= $favorites[$quote_array]['quote'];?></p>
	 				<p class="posted_by">posted by <a href="/view_quotes/<?= $favorites[$quote_array]['posted_by_id'];?> "><?= $favorites[$quote_array]['alias'];?></a></p>
	 				<a href="/remove_from_favorites/<?= $logged_info['id'];?>/<?= $favorites[$quote_array]['quotes_id'];?>"><button class="button">Remove from My List</button></a>
	 			</div>

 		<?php	} ?>
 		</div>
		</fieldset>
 		<div id="new_quote">
 		<h3>Contribute a Quote:</h3>
 			<form action="/new_quote" method="post">
 					<?php echo form_error('quoted_by'); ?>
 				<label for="quoted_by">Quoted By : </label><input type="type" placeholder="William Shakespear" name="quoted_by" />
 					<?php echo form_error('quote'); ?>
  				<label for="quote">Message : </label><textarea placeholder="To be or not to be, that is the question." name="quote" rows="4" cols="25"></textarea>
  				<input type="hidden" value="<?= $logged_info['id'];?>" name="posted_by_id"/>
  				<input class="button2" type="submit" value="Submit" />
			</form>
 		</div>

 	</div>
 </body>
 </html>