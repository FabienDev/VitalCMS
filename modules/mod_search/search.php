<?php

class search{
	
	function search($search, $tables, $nbResults){
		echo "<div id='blocGauche'>";
			echo "<h2>Articles correspondants à votre recherche</h2>";
			$search = htmlspecialchars($_GET['keywords']);
			$i=0;
			$sql = $connexion->query("SELECT * FROM articles WHERE titre Like '%".$search."%' OR descCourte like '%".$search."%'");
			while($article = $sql->fetch_object()){
				$article->contenu = strip_tags($article->contenu, "<p><strong><b><u><span><div><ul><li>");
				$article->contenu = str_replace("<p style='text-align: justify;'>", " ", $article->contenu);
				$article->contenu = str_replace("<iframe src=\"", "<a href='/", $article->contenu);
				$article->contenu = str_replace("\" width=\"680\" height=\"600\"></iframe>", "'><img src='/images/iconePDF.png' style='max-width:25px'/> Voir le document PDF</a>", $article->contenu);
				$article->contenu = str_replace("<p>", " ", $article->contenu);
				$article->contenu = str_replace("</p>", " ", $article->contenu);
				$article->url = str_replace(" ", "_", $article->url);
				echo "<div style='width:400px; float:left;'><a href='/articles/".$article->url."'>".$article->titre."</a></div><br class='clear' /><div style='float:left;'>Tous ses tags : ".$article->tags."</div><br class='clear' /><br />";
				echo "<div style='margin-left:50px'>".substr(nl2br($article->contenu), 0, 500)."<a href='/articles/".$article->url."'>[...]</a></div><hr style='opacity:0.3'/>";
				$i++;				
			}

			if($i==0){
				echo "Aucun article ne correspond à votre recherche :(";
			}
		echo "</div>";
				include('./includes/messagesDroite.inc.php');
			echo "<br class='clear' />";
	}
}
?>