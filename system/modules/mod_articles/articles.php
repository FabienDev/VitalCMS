<?php
class AffArticle {
	
	function tags($id, $connexion){		
		/* Gestion des tags */
		$returnTags = "";
		$listeTags = $connexion->query("SELECT tags FROM articles WHERE id='".$id."'");
		while($tags = $listeTags->fetch_object()){
			$lesTags = explode(", ", $tags->tags);
			for($i=0; $i<count($lesTags); $i++){
				if($i == count($lesTags)-1){
					$returnTags .= "<a href='/articles/tag/".$lesTags[$i]."'>".$lesTags[$i]."</a>";
				}else{
					$returnTags .= "<a href='/articles/tag/".$lesTags[$i]."'>".$lesTags[$i]."</a>, ";
				}
			}
		}
		return $returnTags;
	}
	
	function affichage_article($idArticle, $connexion){
		
		$searchArticle = $connexion->query("SELECT * FROM articles WHERE id='".$idArticle."'");
		$dataArticle = $searchArticle->fetch_object();
		
		$dataArticle->contenu = str_replace("<iframe src=\"", "<iframe src=\"/", $dataArticle->contenu);	
		$dataArticle->contenu = str_replace("\'", "'", $dataArticle->contenu);
		$dataArticle->contenu = str_replace("<p>", "", $dataArticle->contenu);
		$dataArticle->contenu = str_replace("</p>", "", $dataArticle->contenu);
		$dataArticle->contenu = str_replace("src=\"images", "src=\"/images", $dataArticle->contenu);
		$dataArticle->contenu = str_replace("href=\"fichiers/", "href=\"../fichiers/", $dataArticle->contenu);
		$dataArticle->titre = str_replace("-", "'", $dataArticle->titre);
		$dataArticle->titre = str_replace("_", " ", $dataArticle->titre);
		
		$Cat = $connexion->query("SELECT * FROM categories WHERE id=".$dataArticle->categorie."");
		$nomCat = $Cat->fetch_object()->nom;

		$nomCat2 = str_replace(" ", "_", $nomCat);
		
		$retourArticle = "<section clas='article'>";			
		$retourArticle .= "<h2>".$dataArticle->titre."</h2>";
		$retourArticle .= "<p>".nl2br($dataArticle->contenu)."</p>";
		$retourArticle .= "<div id='infosAnnexe'>Ecrit le ".$dataArticle->date." dans la catégorie \"<a href='/articles/categorie/".$nomCat2."'>".$nomCat."</a>\".</div>";
		
		//if(is_active("tags", $connexion)){
			//$retourArticle .= $cl_articles->tags($dataArticle->id, $connexion);
		//}
		
		$retourArticle .= "</section>";
		return $retourArticle;
	}
	
	
}