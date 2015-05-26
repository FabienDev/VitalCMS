<?php
	echo "<div class='fondGauche'>";
		if(!isset($_GET['article'])){
			
			echo "<h2>Créer un article</h2>";		
				$titreArticle = '';			
				$catArticle = '';		
				$contenuArticle = '';	
				$urlArticle = '';
				$tagsArticle = '';
				$descCourteArticle = '';
		}else{	
			echo "<h2>Modifier l'article</h2>";		
			$recupDonnees = $connexion->query("SELECT * FROM articles WHERE id=".$_GET['article']."");		
			while($article = $recupDonnees->fetch_object()){		
				$titreArticle = $article->titre;			
				$catArticle = $article->categorie;			
				$contenuArticle = $article->contenu;	
				$descCourteArticle = $article->descCourte;
				$tagsArticle = $article->tags;
			}					
		}						
		
		if(isset($_POST['btArticle'])){	
			
			if(isset($_POST['idArticle'])){		
				$titreArticle = $connexion->query("SELECT titre FROM articles WHERE id='".$_POST['idArticle']."'");
				$titreArticle = $titreArticle->fetch_object()->titre;
				$urlArticle = suppAccent("".$titreArticle."");
				$_POST['titreArticle'] = str_replace("'", "\'", $_POST['titreArticle']);		
				$_POST['descCourteArticle'] = str_replace("'", "\'", $_POST['descCourteArticle']);				
				$_POST['contenuArticle'] = str_replace("'", "\'", $_POST['contenuArticle']);	
				$connexion->query("UPDATE articles SET titre='".$_POST['titreArticle']."', url='".$urlArticle."', categorie='".$_POST['catArticle']."', contenu='".$_POST['contenuArticle']."', tags='".$_POST['tagsArticle']."', descCourte='".$_POST['descCourteArticle']."' WHERE id=".$_POST['idArticle']."");		
				
				echo "Article modifié !";		
			}else{					
				$_POST['titreArticle'] = str_replace("'", "\'", $_POST['titreArticle']);			
				$_POST['contenuArticle'] = str_replace("'", "\'", $_POST['contenuArticle']);		
				$_POST['descCourteArticle'] = str_replace("'", "\'", $_POST['descCourteArticle']);					
				$date = date("j/m/Y");
				$heure = " à ".date("G:i");
				$heure = str_replace(":", "h", $heure);
				$date = $date.$heure;
				$connexion->query("INSERT INTO articles VALUES (null, '".$_POST['titreArticle']."', '".$urlArticle."', '".$_POST['contenuArticle']."', ".$_POST['catArticle'].", '".$date."', '".$_POST['tagsArticle']."', '".$_POST['descCourteArticle']."')");			
				echo "Article créé !";					
			}		
		}		
		echo "<div style='text-align:center;margin:auto;'>";		
			echo "<form method='post' action='./administration.php?onglet=articles'>";		
			echo "<div style='float:left; width:325px; margin-left:10px; text-align:right;'>";
				echo "Titre : <input type='text' name='titreArticle' value='".$titreArticle."' size='20'/><br />";	
				echo "Description Courte : <input type='text' name='descCourteArticle' value='".$descCourteArticle."' size='20' maxlength='200'/><br />";
			echo "</div>";
			echo "<div style='float:right; width:310px; margin-right:28px; text-align:right;'>";
				echo "Tags : <input type='text' name='tagsArticle' value='".$tagsArticle."' size='25'/><br />";				
				echo "Catégorie : ";			
				echo "<select name='catArticle' style='margin-right:30px; width:183px'>";			
					if($catArticle != ''){				
						$nomCategorie = $connexion->query("SELECT nom FROM categories WHERE id=".$catArticle."");			
						$nomCategorie = $nomCategorie->fetch_object()->nom;				
						echo "<option value='".$catArticle."' style='background-color:grey;'>".$nomCategorie."</option>";	
					}						
					$listeCategorie = $connexion->query("SELECT * FROM categories ORDER BY nom");			
					while($categorie = $listeCategorie->fetch_object()){			
						echo "<option value='".$categorie->id."'>".$categorie->nom."</option>";			
					}				
				echo "</select>";	
			echo "</div>";
			echo "<br class='clear'/><br />Article :<br /><textarea name='contenuArticle' id='FormTiny' cols='82' rows='20'>".$contenuArticle."</textarea><br />";		
			echo "<input type='submit' value='Valider' name='btArticle' />";		
			if(isset($_GET['article'])){	
				echo "<input type='hidden' name='idArticle' value='".$_GET['article']."' />";			
			}	
			echo "</form>";	
		echo "</div>";		
	echo "</div>";
	echo "<div class='fondGauche'>";						
		echo "<h2>Articles déjà existant</h2>";		
		$lesArticles = $connexion->query("SELECT * FROM articles ORDER BY id DESC");		
		while($listeArticles = $lesArticles->fetch_object()){		
			$listeArticles->titre = str_replace(" ", "_", $listeArticles->titre);
			echo "<a href='/articles/".$listeArticles->titre."'>".$listeArticles->titre."</a> - <a href='./administration.php?onglet=articles&article=".$listeArticles->id."'>Modifier</a><br />";		
		}
	echo "</div>";
	?>