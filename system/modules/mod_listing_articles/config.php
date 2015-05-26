<?php

include('./system/modules/mod_listing_articles/listing_articles.php');

class config_listing_articles{
	
	function init_config($idListingArticles, $connexion){
		$configuration = $connexion->query("SELECT * FROM mod_listing_articles WHERE id=".$idListingArticles."");
		$config = $configuration->fetch_object();

		$listing_articles = new articles();
		// $nbArticlesParPage, $pagination, $categorie, $orderType, $order
		$liste_articles = $listing_articles->listing_articles($config->nbArticlesParPage, $config->pagination, $config->categorie, $config->orderType, $order->order, $connexion);

		return $liste_articles;
	}
}