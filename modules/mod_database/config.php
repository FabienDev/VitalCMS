<?php
include("./modules/mod_database/database.php");

// Connexion à la base de donnée
$server = "";
$user = "";
$password = "";
$database = "";

$connexion = db_connect($server, $user, $password, $database);
?>
