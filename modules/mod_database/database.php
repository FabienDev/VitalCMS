<?php

function db_connect($server, $user, $password, $database){
	
	$connexion = new mysqli($server, $user, $password, $database) or die ('Erreur lors de la connexion � la base de donn�es');
	$connexion->query("SET NAMES 'utf8'");
	
	return $connexion;
}
?>