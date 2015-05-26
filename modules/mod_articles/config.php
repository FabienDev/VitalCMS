<?php
include('./modules/mod_articles/articles.php');

class config_articles{
	
	function init_config($urlArticle, $connexion){
		$urlArticle = str_replace("_", " ", $urlArticle);
		$configuration = $connexion->query("SELECT * FROM articles WHERE url='".$urlArticle."'");
		$config = $configuration->fetch_object();

		$idArticle = $config->id;

		$cl_articles = new articles();
		$article = $cl_articles->aff_article($idArticle, $connexion);

		return $article;
	}
}