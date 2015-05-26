<?php
include("./modules/mod_twitter/twitter.php");

class config_twitter{
	
	function init_config($idTweet, $connexion){
		$configuration = $connexion->query("SELECT active, id_twitter, widget_id FROM mod_twitter WHERE id='".$idTweet."'");
		$config = $configuration->fetch_object();
		$active = $config->active;
		$id_twitter = $config->id_twitter;
		$widget_id = $config->widget_id;
		
		$return = aff_twitter($active, $id_twitter, $widget_id);
		return $return;
	}
}
?>