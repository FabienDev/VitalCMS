<?php
echo "<div id='blocGauche'>";
	// Module Page CMS
	$init->load_module("pages_cms",htmlspecialchars($_GET['page']), $connexion);	
echo "</div>";
echo "<div id='blocDroite'>";
	// Module CMS Blocs
	$init->load_module("blocs_cms", 12, $connexion);	
echo "</div>";
?>