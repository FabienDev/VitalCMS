<?php

if(isset($_GET['nom'])){
	echo "<div class='fondGauche'>";
	if(isset($_POST['btUpdatePage'])){
		$_POST['titrePage'] = str_replace("'", "\'", $_POST['titrePage']);
		$_POST['contenuPage'] = str_replace("'", "\'", $_POST['contenuPage']);
		$connexion->query("UPDATE pages SET titre='".$_POST['titrePage']."', contenu='".$_POST['contenuPage']."' WHERE id='".$_POST['idPage']."'");
		$messageRetour = "Page modifié";
	}
	echo "<h2>Modification d'une page</h2>";
	
	if(isset($messageRetour)){
		echo "<div style='text-align:center; color:red'>".$messageRetour."</div>";
	}
	$infosPage = $connexion->query("SELECT * FROM pages WHERE nom='".$_GET['nom']."'");
	while($page = $infosPage->fetch_object()){
		echo "<div style='text-align:center'>";
			echo "Ce texte ce situe sur la page : ".$_GET['nom']."<br /><br />";
			echo "<form method='post' action='./administration.php?onglet=pages&nom=".$_GET['nom']."'>";
				echo "Titre du paragraphe : <input type='text' name='titrePage' value='".$page->titre."' size='50'/><br /><br />";
				echo "Contenu :<br >";
					echo "<textarea cols='82' rows='30' name='contenuPage' id='FormTiny'>".$page->contenu."</textarea><br />";
				echo "<input type='hidden' name='idPage' value='".$page->id."' />";
				echo "<input type='submit' value='Valider les modifications' name='btUpdatePage'/>";
			echo "</form>";
		echo "</div>";
	}
	echo "</div>";
}




echo "<div class='fondGauche'>";
	echo "<h2>Les pages</h2>";
		$listePages = $connexion->query("SELECT * FROM pages");
		while($pages = $listePages->fetch_object()){
			echo "<a href='./index.php?page=".$pages->nom."'>".$pages->nom."</a> - <a href='./administration.php?onglet=pages&nom=".$pages->nom."'>Modifier la page</a><br />";
		}
echo "</div>";
?>