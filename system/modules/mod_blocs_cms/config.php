<?php

include_once('./system/modules/mod_blocs_cms/blocs_cms.php');

class config_blocs_cms{
	
	function init_config($idBlocCMS, $connexion){
		
		if(!empty($idBlocCMS)){
			$cms_blocs = new blocs_cms();
			$bloc_cms = $cms_blocs->affichage_bloc($idBlocCMS, $connexion);
			return $bloc_cms;
		}else{
			return "Identifiant du bloc manquant";
		}
	}
}