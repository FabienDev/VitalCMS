<?php

$init = new setting($connexion);

class setting{
	
	function setting($connexion){
		// Modules systèmes
		include($_SERVER['DOCUMENT_ROOT']."/modules/mod_blocs_cms/config.php");
		include_once ($_SERVER['DOCUMENT_ROOT']."/modules/mod_listing_articles/config.php");
		//include($_SERVER['DOCUMENT_ROOT']."/system/modules/mod_logo/config.php");
		include_once ($_SERVER['DOCUMENT_ROOT']."/modules/mod_pages_cms/config.php");
		include_once ($_SERVER['DOCUMENT_ROOT']."/modules/mod_articles/config.php");
		
		// Modules ajoutés
		$configuration = $connexion->query("SELECT * FROM set_modules WHERE active='1'");
		while($config = $configuration->fetch_object()){
			include_once ($_SERVER['DOCUMENT_ROOT']."/modules/mod_".$config->module_name."/config.php");
		}
	}
	
	function load_module($moduleName, $idModule, $connexion){
		$configLoad = "config_".$moduleName;
		$module = new $configLoad();
		$load_module = $module->init_config($idModule, $connexion);
		echo $load_module;
	}
	
	function is_active($moduleName, $connexion){
		$isActive = $connexion->query("SELECT * FROM set_modules WHERE active='1'");
		return $status->fetch_object()->active;
	}
	
}

?>