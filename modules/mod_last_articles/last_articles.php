<?php 
class last_articles{
	function aff_last_articles($active, $nb_articles, $nb_caracteres_ligne, $show_date, $connexion){
		if($active){	
			$i=0;			
			$sql = $connexion->query("SELECT * FROM articles ORDER BY id DESC LIMIT 0,".$nb_articles."");
			while($article = $sql->fetch_object()){
				$data[$i]['titre'] = $article->titre;
				if(!empty($nb_caracteres_ligne) && (strlen($nb_caracteres_ligne) > 0)){
					$data[$i]['titre'] = substr($article->titre, 0, $nb_caracteres_ligne)."...";
				}
				$data[$i]['url'] = str_replace(" ", "-", $data[$i]['titre']);
				if($show_date){
					$data[$i]['date'] = $article->date;
				}
				$i++;
			}
			return $data;
		}
	}
}