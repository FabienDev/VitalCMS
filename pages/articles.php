<?php
if(!isset($_SESSION['cap'])){
	$_SESSION['cap'] = rand(0, 500);
}?>
<div id='blocGauche'>
	<?php
	if(!isset($_GET['article']) && !isset($_GET['categorie']) && !isset($_GET['tag'])){

		// Module Page CMS
		$init->load_module("pages_cms",htmlspecialchars($_GET['page']), $connexion);	
		?>
		<div class='fondGauche'>
			<?php
			// Module Listing Articles
			$init->load_module("listing_articles",1, $connexion);	
			?>
		</div>
		<?php
	}else{
		if(isset($_GET['article'])){
			// Partie sécurité injections SQL
			/*$articleTiret = str_replace(" ", "_", $_GET['article']);
			$listeMots = explode(" ", $articleTiret);
				if(count($listeMots) > 1) { 
					$_GET['article'] = "Cloud_:_Presentation_et_interets";
				}else{
					$secuTitre = strtolower($_GET['article']);
					if(preg_match("delete", $secuTitre) || preg_match("select", $secuTitre) || preg_match("update", $secuTitre) || preg_match("insert", $secuTitre)){
						$_GET['article'] = "Cloud_:_Presentation_et_interets";
					}
				}*/
			
			// Module Social Share
			//$init->load_module("share_social", 1, $connexion);
			
			// Module Article
			$init->load_module("articles", $_GET['article'], $connexion);
		
			echo "<h2>Ajouter un Commentaire</h2>";
			
			// Les Commentaires
			/*if(isset($_POST['btCommentaire'])){
				if($_POST['sec'] == ""){
					if($_POST['prenom'] != "" && $_POST['email'] != "" && $_POST['message'] != ""){
						if(isset($_SESSION['time'])){
							if($_SESSION['time'] > time()){
								$messageCommentaire = "<span style='color:red'>Merci de patienter 15sec entre deux commentaires</span>";
							}else{
								unset($_SESSION['time']);
								}
						}
						
						if($_SESSION['cap'] == $_POST['sec2']){				
							unset($_SESSION['cap']);
						}
								
						if(!isset($_SESSION['time']) && !isset($_SESSION['cap'])){
						
							$idArt = $connexion->query("SELECT id FROM articles WHERE titre='".$_GET['article']."'");
							$idArt = $idArt->fetch_object()->id;
							$date = date("j/m/Y");
							$heure = " à ".date("G:i");
							$heure = str_replace(":", "h", $heure);
							$date = $date.$heure;
							
							
							$_POST['message'] = str_replace("'", "\'", $_POST['message']);
							$connexion->query("INSERT INTO commentaires VALUES (null, ".$idArt.", '".$_POST['prenom']."', '".$_POST['email']."', '".$_POST['message']."', '$date')");
							$messageCommentaire = "Commentaire ajouté !";
							
							$messageMail = "Salut, \n Un nouveau commentaire à été posté sur ton site. \n Tu peux le voir ici : http://nicolasbroisin.fr/articles/".$articleTiret."#zoneCommentaires \n A bientôt";
							mail('nicolas.broisin@gmail.com', 'Nouveau commentaire', $messageMail,  "From : nicolasbroisin.fr");
						
							$_SESSION['time'] = time()+15;
							$_SESSION['cap'] = rand(0, 500);
							
						}elseif(isset($_SESSION['cap']) && !isset($_SESSION['time'])){
							$messageCommentaire = "<span style='color:red'>Le code de sécurité est incorrect</span>";
						}
						
					}else{
						$messageCommentaire = "Merci de remplir tout les champs";
					}
				}
			}
			
			if(isset($messageCommentaire)) echo "<span style='color:red'>".$messageCommentaire."</span>";
			echo "<form method='post' action='/articles/".$_GET['article']."#zoneCommentaires'>";
				echo "<div style='text-align:center' id='zoneCommentaires' >Prénom : <input type='text' name='prenom' />";
				echo "E-mail (visible que par l'admin) : <input type='text' name='email' />";
				echo "<br />Message :<br /> <textarea cols='40' rows='5' name='message'></textarea><br />";
				echo "Recopiez : ".$_SESSION['cap']." : <input type='text' name='sec2' /><br />";
				echo "<br /><input type='hidden' name='sec' /><input type='submit' value='Poster le commentaire' name='btCommentaire' /></div>";
			echo "</form>";
			
			
			echo "<br /><h2>Les commentaires</h2>";
			$nbCommentaires = 0;
			$listeCommentaires = $connexion->query("SELECT * FROM commentaires WHERE idArt = ".$iArticle->id." ORDER BY id");
			while($commentaires = $listeCommentaires->fetch_object()){
				$nbCommentaires++;
				if($commentaires->prenom == "NICOLAS"){
					$bg='#F1F1F1';
				}else{
					$bg='#fff';
				}
				echo "<br /><fieldset style='border-radius:10px; background-color:".$bg."'><legend style='font-size:10px'><i>Commentaire posté par ".htmlspecialchars($commentaires->prenom)." le ".$commentaires->date."</i></legend>";
				if(isset($_SESSION['ip'])){
					echo "<span style='text-align:right'><i>(".htmlspecialchars($commentaires->email).")</i></span>";
				}
				$commentaires->message = eregi_replace("([[:alnum:]]+)://([^[:space:]]*)([[:alnum:]#?/&=])", "<a href=\"\\1://\\2\\3\" target=\"_blank\">\\1://\\2\\3</A>",$commentaires->message);
				echo "<br />".nl2br($commentaires->message)."<br />"; 
				echo "</fieldset><br />";
			}
			if($nbCommentaires == 0){
				echo "<span style='font-style:italic'>Aucun commentaire n'a été posté</span>";
			}
			echo "<br /><br />";
			// Fin des Commentaires
			*/
		}elseif(isset($_GET['categorie']) && $_GET['categorie'] != ''){
				echo "<div class='fondGauche'>";
					$_GET['categorie'] = str_replace("_", " ", $_GET['categorie']);
					echo "<h2>Categorie : \"".$_GET['categorie']."\"</h2>";
					$i = 0;
					$_GET['categorie'] = str_replace("_", " ", $_GET['categorie']);
					$Cat = $connexion->query("SELECT id FROM categories WHERE nom='".$_GET['categorie']."'");
					
					$idCat = $Cat->fetch_object()->id;

					$lesArticles = $connexion->query("SELECT * FROM articles WHERE categorie=".$idCat." ORDER BY id DESC");
					while($listeArt = $lesArticles->fetch_object()){
						$i++;
						$titreArt = str_replace(" ", "_", $listeArt->url);
						echo "<a href='/articles/".$titreArt."' class='listingArticles'>".$listeArt->titre."</a><div class='publications'>Publié le ".$listeArt->date." </div><hr style='opacity: 0.4;margin-top: 4px;margin-bottom: 4px;'/>";
					}
					
					if($i==0){
						echo "<i>Cette catégorie ne comprend actuellement aucun article</i>";
					}
				echo "</div>";
			}elseif(isset($_GET['tag'])){
				$secuTags = strtolower($_GET['tag']);
				if(preg_match("delete", $secuTags) || preg_match("select", $secuTags) || preg_match("update", $secuTags) || preg_match("insert", $secuTags)){
					$_GET['tag'] = "Cloud";
				}
				echo "<div class='fondGauche'>";
					echo "<h2>Articles ayant été tagués avec \"".$_GET['tag']."\"</h2>"; 
					$allArticles = $connexion->query("SELECT * FROM articles");
					while($article = $allArticles->fetch_object()){
						$listeTag = explode(", ", $article->tags);
						for($i=0; $i<count($listeTag); $i++){
							if($listeTag[$i] == $_GET['tag']){
								$article->contenu = strip_tags($article->contenu, "<li>");
								$article->contenu = str_replace("<p style='text-align: justify;'>", " ", $article->contenu);
								$article->contenu = str_replace("<iframe src=\"", "<a href='/", $article->contenu);
								$article->contenu = str_replace("\" width=\"680\" height=\"600\"></iframe>", "'><img src='/images/iconePDF.png' style='max-width:25px'/> Voir le document PDF</a>", $article->contenu);
								$article->contenu = str_replace("<p>", " ", $article->contenu);
								$article->contenu = str_replace("</p>", " ", $article->contenu);
								echo "<div style='width:400px; float:left;'><a href='/articles/".$article->url."'>".$article->titre."</a></div><br class='clear' /><div style='float:left;'>Tous ses tags : ".$article->tags."</div><br class='clear' /><br />";
								echo "<div style='margin-left:50px'>".substr(nl2br($article->contenu), 0, 500)."<a href='/articles/".$article->url."'>[...]</a></div><hr style='opacity:0.3'/>";
							}
						}
					}
				echo "</div>";
			
			}
			
	}?>
</div>
<div id='blocDroite'>
	<div class='fondDroite'>
		<h2>Navigation</h2>
		<div class='emplacementTexte'>
		<?php
		// Module Navigation
		$init->load_module("navigation", 1, $connexion);
		?>
		</div>
	</div>
	
	<div id='postit'>
		<?php
		// Module lasts Articles
		$init->load_module("last_articles", 2, $connexion);
		?>
	</div>
</div>
