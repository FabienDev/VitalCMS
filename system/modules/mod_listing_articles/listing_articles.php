<?php 
class articles{
	
	function listing_articles($nbArticlesParPage, $pagination = 1, $categorie = null, $orderType = null, $order = null, $connexion){
		$nbArticles = 0;
		if(empty($_GET['p']) || $_GET['p'] == 1 || $_GET['p'] < 1 || !is_numeric($_GET['p'])){
			$debut = 0;
			$fin = $nbArticlesParPage;
			$_GET['p'] = 1;
		}else{
			$debut = $nbArticlesParPage * ($_GET['p']-1) ; // page2 debut : 15 / page 3 debut 30...
			$fin = $debut + $nbArticlesParPage;
		}
		
		$nbArticles = $connexion->query("SELECT count(*) as nbArt FROM articles ");
		$nbArticles = $nbArticles->fetch_object()->nbArt;
		
		$msg_listing = "<h2>Les articles</h2>";
		if($fin > ($_GET['p']-1)* $nbArticlesParPage){
			if($categorie != 0){
				$listeArticles = $connexion->query("SELECT * FROM articles WHERE categorie = ".$categorie." ORDER BY ".$orderType." ".$order." LIMIT $debut, $fin");
			}else{
				$listeArticles = $connexion->query("SELECT * FROM articles ORDER BY ".$orderType." ".$order." LIMIT $debut, $fin");
			}
			
			while($articles = $listeArticles->fetch_object()){
				$titreArt = str_replace(" ", "_", $articles->url);
				$msg_listing .= "<a href='/articles/".$titreArt."' class='listingArticles'>".$articles->titre."</a><div class='publications'>Publié le ".$articles->date." </div><hr style='opacity: 0.4;margin-top: 4px;margin-bottom: 4px;'/>";
			}
		}else{
			$msg_listing .= "Il n'y pas d'autres articles... pour le moment";
		}
		$msg_listing .= "<div id='pagination'>";
			if($pagination == 1){
				if(is_numeric($_GET['p']) && $_GET['p']>1){ 
					if($_GET['p'] > 2){
						$msg_listing .= "<br /><a href='/articles/page/1'>Première page</a>&nbsp;&nbsp;&nbsp;";
					}
					$msg_listing .= "<a href='/articles/page/".($_GET['p']-1)."'>Page précedente</a>";
				}
				if($nbArticles>$fin && is_numeric($_GET['p'])){ 
					$msg_listing .= "<a href='/articles/page/".($_GET['p']+1)."'>Page suivante</a>"; 
				}
			}
			
		$msg_listing .= "</div>";
		return $msg_listing;
	}
}