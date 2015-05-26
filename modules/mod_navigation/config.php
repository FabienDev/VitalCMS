<?php

include('./modules/mod_navigation/navigation.php');

class config_navigation{
	
	function init_config($idModuleNavigation, $connexion){
		$configuration = $connexion->query("SELECT * FROM mod_navigation WHERE id=".$idModuleNavigation."");
		$config = $configuration->fetch_object();

		$active = $config->active;
		$type = $config->type;
		$active_sc = $config->active_sc;
		$tri = $config->tri_colonne;
		$tri_order = $config->tri_ordre;

		$cl_navigation = new navigation();

		if($type == "categories"){
			$navigation = $cl_navigation->aff_categories($active, $active_sc, $tri, $tri_order, $connexion);
		}else{
			$navigation = $cl_navigation->aff_lasts_articles($active, $active_sc, $tri, $tri_order, $connexion);
		}
		return $navigation;
	}
}