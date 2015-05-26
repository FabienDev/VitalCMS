<div id='blocGauche'>
	<?php
	// Module Page CMS
	$init->load_module("pages_cms",htmlspecialchars($_GET['page']), $connexion);	
	?>
</div>
<div id='blocDroite'>
	<div class='fondDroite'>
		<?php 
		// Module Twitter
		$init->load_module("twitter", 2, $connexion);	
		?>
	</div>
	<?php
	// Module CMS Blocs
	$init->load_module("blocs_cms", 9, $connexion);	
	?>
</div>