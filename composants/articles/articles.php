<?php
// Model

class com_articles {
	
	public function show_article($id_articles, $connexion){		

		$searchArticle = $connexion->query("SELECT * FROM articles WHERE id='".$idArticle."'");
		$dataArticle = $searchArticle->fetch_object();
		$article['titre'] = $dataArticle->titre;
		$article['contenu'] = $dataArticle->contenu;
		$article['date'] = $dataArticle->date;

		$Cat = $connexion->query("SELECT * FROM categories WHERE id=".$dataArticle->categorie."");
		$article['categorie'] = $Cat->fetch_object()->nom;

		$article['url_categorie'] = str_replace(" ", "_", $article['categorie'] );

		//if(is_active("tags", $connexion)){
			//$retourArticle .= $cl_articles->tags($dataArticle->id, $connexion);
		//}
		
		return $article;
	}

	function lasts_articles(){

	}

	function listing_articles(){


	}

}
