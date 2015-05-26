<?php

include('./modules/mod_share_social/share_social.php');

class config_share_social{
	
	function init_config($idModuleShare, $connexion){
		$configuration = $connexion->query("SELECT * FROM mod_social_share WHERE id=".$idModuleShare."");
		$config = $configuration->fetch_object();
		if($config->active == 1){
			$social = new social();
			$share = $social->share($config->twitter, $config->linkedIn, $config->viadeo, $config->googlePlus);
			return $share;
		}
	}
}