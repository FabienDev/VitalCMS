<?php
/* Fonctions PHP */

// Suppression des accents
function suppAccent($motAModifier){
	$motModifie = str_replace("é", "e", $motAModifier);
	$motModifie = str_replace("è", "e", $motModifie);
	$motModifie = str_replace("à", "a", $motModifie);
	$motModifie = str_replace("ù", "u", $motModifie);
	$motModifie = str_replace("û", "u", $motModifie);
	$motModifie = str_replace("ê", "e", $motModifie);
	return $motModifie;
}

function VerifierAdresseMail($adresse) { 
   $Syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#'; 
   if(preg_match($Syntaxe,$adresse)) 
      return true; 
   else 
     return false; 
}
?>