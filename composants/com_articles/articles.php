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

	function listing_articles($nbArticlesParPage, $pagination = 1, $categorie = null, $orderType = null, $order = null, $connexion){
		$nbArticles = 0;
		$i = 0;

		if(empty($_GET['p']) || $_GET['p'] == 1 || $_GET['p'] < 1 || !is_numeric($_GET['p'])){
			$liste['debut'] = 0;
			$liste['fin'] = $nbArticlesParPage;
			$_GET['p'] = 1;
		}else{
			$liste['debut'] = $nbArticlesParPage * ($_GET['p']-1) ; // page2 debut : 15 / page 3 debut 30...
			$liste['fin']  = $debut + $nbArticlesParPage;
		}
		
		$nbArticles = $connexion->query("SELECT count(*) as nbArt FROM articles ");
		$nbArticles = $nbArticles->fetch_object()->nbArt;

		if($liste['fin'] > ($_GET['p']-1)* $nbArticlesParPage){
			if($categorie != 0){
				$listeArticles = $connexion->query("SELECT * FROM articles WHERE categorie = ".$categorie." ORDER BY ".$orderType." ".$order." LIMIT $debut, $fin");
			}else{
				$listeArticles = $connexion->query("SELECT * FROM articles ORDER BY ".$orderType." ".$order." LIMIT $debut, $fin");
			}
			
			while($articles = $listeArticles->fetch_object()){
				$liste['article'][$i]['url'] = $articles->url;
				$liste['article'][$i]['titre'] = $articles->titre;
				$liste['article'][$i]['date'] = $articles->date;
				$i++;
			}
		}
		
		if($pagination == 1){
			if(is_numeric($_GET['p']) && $_GET['p']>1){ 
				$liste['pagePrecedente'] = $_GET['p'] - 1;
			}
			if($nbArticles > $fin && is_numeric($_GET['p'])){ 
				$liste['pageSuivante'] = $_GET['p'] + 1;
			}
		}

		return $liste;
	}

}
