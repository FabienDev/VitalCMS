<?php
include("./modules/mod_database/database.php");

// Connexion � la base de donn�e
$server = "";
$user = "";
$password = "";
$database = "";

$connexion = db_connect($server, $user, $password, $database);
?>
