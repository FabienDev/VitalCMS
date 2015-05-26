<?php
class blocs_cms{
	
	function affichage_bloc($id_bloc, $connexion){
		$affichage = $connexion->query("SELECT titre, contenu, class FROM mod_blocs_cms WHERE id=".$id_bloc."");
		$aff = $affichage->fetch_object();
		if(!empty($aff->class)) { 
			$message = "<div class='".$aff->class."'>";
		}else{
			$message = "<div>";
		}
		
		if(!empty($aff->titre)){
			$message .= "<h2>".$aff->titre."</h2>";
		}
		$message .= "<div class='content_cms_bloc'>".$aff->contenu."</div></div>";
		
		return $message;
	}
}