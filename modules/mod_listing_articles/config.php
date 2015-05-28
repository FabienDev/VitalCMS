<?php

include_once('./composants/com_articles/articles.php');

class config_listing_articles{
	
	function init_config($idListingArticles, $connexion){
		$configuration = $connexion->query("SELECT * FROM mod_listing_articles WHERE id=".$idListingArticles."");
		$config = $configuration->fetch_object();

		$listing_articles = new com_articles();
		$articles = $listing_articles->listing_articles($config->nbArticlesParPage, $config->pagination, $config->categorie, $config->orderType, $order->order, $connexion);

		include_once("./modules/mod_listing_articles/views/default.php");
	}
	
}