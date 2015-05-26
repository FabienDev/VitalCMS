<?php
class page_cms{
	function search_page($page, $connexion){
		$searchPage = $connexion->query("SELECT * FROM pages WHERE nom='".htmlspecialchars($_GET['page'])."'");
		if($searchPage->fetch_object()->nom){
			$retour = $searchPage->fetch_object()->nom;
		}else{
			$retour = "404";
		}
	}
	
	function affichage_page($page, $connexion){
		$textePage = $connexion->query("SELECT titre, contenu FROM pages WHERE nom='".htmlspecialchars($_GET['page'])."'");
		while($texte = $textePage->fetch_object()){
			echo "<div class='fondGauche'>";
				echo "<h2>".$texte->titre."</h2>";	
				echo $texte->contenu;	
			echo "</div>";
		}
	}
}
