<?php
// controler

include('./composants/articles/com_articles.php');

class config_articles{
	
	function init_config($urlArticle, $connexion){
		$urlArticle = str_replace("_", " ", $urlArticle);
		$configuration = $connexion->query("SELECT * FROM articles WHERE url='".$urlArticle."'");
		$config = $configuration->fetch_object();

		$idArticle = $config->id;

		$cl_articles = new articles();
		$article = $cl_articles->show_article($idArticle, $connexion);

		include_once("./modules/mod_articles/views/default.php");
	}
}