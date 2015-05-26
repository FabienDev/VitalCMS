
<div id='blocGauche'>
	<?php 
	// Module Page CMS
	$init->load_module("pages_cms","accueil", $connexion);	
	?>
</div>
<div id='blocDroite'>
<?php 
	// Module CMS Blocs
	$init->load_module("blocs_cms", 1, $connexion);

	// Module CMS Blocs
	$init->load_module("blocs_cms", 5, $connexion);			
?>
</div>
<br class='clear' />



<div class='bloc_50'>
	<?php 
	// Module Twitter
	$init->load_module("twitter", 1, $connexion);
	?>
</div>
<div class='bloc_50'>
	<?php 
	// Module lasts Articles
	$init->load_module("last_articles", 1, $connexion);
	?>
</div>
<br class='clear' />