<?php

class navigation{

	function aff_navigation(){
		
	}

	function aff_categories($active, $active_sc, $tri, $tri_order, $connexion){
		
		$categories = "<ul class='navigation'>";
		$lesCategories = $connexion->query("SELECT * FROM categories ORDER BY ".$tri." ".$tri_order."");
		
		while($listeCategories = $lesCategories->fetch_object()){ 
			// On affiche les categories
			$nomCat = str_replace(" ", "_", $listeCategories->nom); 
			$nomCat = str_replace(" ", "-", $listeCategories->nom); 

			$categories .= "<li class='toggleSubMenu'><span>".$listeCategories->nom."</span> ";
			
			if($active_sc){
				// On affiche les sous catégories
				$categories .= "<ul class='subMenu'>";
					$categories .= "<li><a href='/articles/categorie/".$nomCat."'><i>Tous les articles</i></a></li>";
					$lesArticles = $connexion->query("SELECT * FROM articles WHERE categorie=".$listeCategories->id." ORDER BY titre");
					while($listeArticles = $lesArticles->fetch_object()){ 
						// On affiche chaques articles des catégories
						$titreArt = str_replace(" ", "_", $listeArticles->url);
		
						$categories .= "<li style='text-align: left;'><a href='/articles/".$titreArt."'>".$listeArticles->titre."</a></li>";
					}
				$categories .= "</ul>";
			}
			$categories .= "</li>";
			
		}
		$categories .= "</ul>";
		
		return $categories;
	}
}
