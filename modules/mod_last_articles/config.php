<?php
include('./modules/mod_last_articles/last_articles.php');

class config_last_articles{
	
	function init_config($idModuleLastsArticles, $connexion){
		$configuration = $connexion->query("SELECT * FROM mod_last_articles WHERE id=".$idModuleLastsArticles."");
		$config = $configuration->fetch_object();

		$active = $config->active;
		$nb_articles = $config->nb_articles;
		$nb_caracteres_ligne = $config->nb_caracteres_ligne;
		$show_date = $config->aff_date;

		$cl_last_articles = new last_articles();
		$listing = $cl_last_articles->aff_last_articles($active, $nb_articles, $nb_caracteres_ligne, $show_date, $connexion);

		return $listing;
	}
}