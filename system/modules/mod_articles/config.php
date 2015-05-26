<?php
include_once($_SERVER['DOCUMENT_ROOT']."/system/modules/mod_articles/articles.php");

class config_articles{
	
	function init_config($urlArticle, $connexion){
		
		$urlArticle = str_replace("_", " ", $urlArticle);
		$configuration = $connexion->query("SELECT * FROM articles WHERE url='".$urlArticle."'");
		$config = $configuration->fetch_object();

		$idArticle = $config->id;

		$cl_articles = new AffArticle();
		$article = $cl_articles->affichage_article($idArticle, $connexion);
        
		return $article;

	}
	
}