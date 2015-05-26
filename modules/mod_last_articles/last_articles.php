<?php 
class last_articles{
	function aff_last_articles($active, $nb_articles, $nb_caracteres_ligne, $show_date, $connexion){
		if($active){
			$retour = "<h2>Mes derniers articles</h2>";
			$retour .= "<ul>";
				
				$sql = $connexion->query("SELECT * FROM articles ORDER BY id DESC LIMIT 0,".$nb_articles."");
				while($article = $sql->fetch_object()){
					
					if(!empty($nb_caracteres_ligne) && (strlen($nb_caracteres_ligne) > 0)){
						$article->titre = substr($article->titre, 0, $nb_caracteres_ligne);
						$article->titre .= "...";
					}
					
					$titreArt = str_replace(" ", "_", $article->url);
					$titreArt = str_replace(" ", "-", $titreArt);
					$retour .= "<li>";
						$retour .= "<a href='/articles/".$titreArt."'>".$article->titre."</a>";
						if($show_date){
							$retour .= " Le ".$article->date;
						}
					$retour .= "</li>";
					
				}
			$retour .= "</ul>";
			return $retour;
		}
	}
}