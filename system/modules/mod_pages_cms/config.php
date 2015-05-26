<?php

include('./system/modules/mod_pages_cms/pages_cms.php');

class config_pages_cms{
	function init_config($nomPageCMS, $connexion){
		if(!empty($nomPageCMS)){
			$page_cms = new page_cms();
			
			$search_page = $page_cms->search_page(htmlspecialchars($nomPageCMS), $connexion);
			if($search_page != "404"){
				$page_cms = $page_cms->affichage_page(htmlspecialchars($nomPageCMS), $connexion);
			}else{
				$page_cms = $page_cms->affichage_page("404", $connexion);
			}
		}else{
			$page_cms = $page_cms->affichage_page("accueil", $connexion);
		}

		return $page_cms;
	}
}