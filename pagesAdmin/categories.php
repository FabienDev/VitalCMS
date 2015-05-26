<?php
echo "<div class='fondGauche'>";
	if(!isset($_GET['id'])){
		echo "<h2>Création d'une catégorie</h2>";
		$nomCat = "";
		if(isset($_POST['btAddCat'])){
			$connexion->query("INSERT INTO categories VALUES (null, '".$_POST['nomCat']."')");
			$messageRetour = "Catégorie ajoutée !";
		}elseif(isset($_POST['btUpdateCat'])){
			$connexion->query("UPDATE categories SET nom='".$_POST['nomCat']."' WHERE id='".$_POST['idCat']."'");
			$messageRetour = "Catégorie modifiée !";
		}
	}else{
		echo "<h2>Modification d'une catégorie</h2>";
		$nomCat = $connexion->query("SELECT nom FROM categories WHERE id='".$_GET['id']."'");
		$nomCat = $nomCat->fetch_object()->nom;
		
	}

	if(isset($messageRetour)){
		echo "<div style='text-align:center; color:red'>".$messageRetour."</div>";
	}

		echo "<form method='post' action='./administration.php?onglet=categories'>";
			echo "Nom de la catégorie : <input type='text' name='nomCat' value='".$nomCat."'/>";
			if(isset($_GET['id'])){
				echo "<input type='hidden' name='idCat' value='".$_GET['id']."' />";
				echo "<input type='submit' value='Modifier la catégorie' name='btUpdateCat' />";
			}else{
				echo "<input type='submit' value='Ajouter la catégorie' name='btAddCat' />";
			}
		echo "</form><br />";
echo "</div>";

echo "<div class='fondGauche'>";
	echo "<h2>Catégories existantes</h2>";
		$listeCategories = $connexion->query("SELECT * FROM categories");
		while($categories = $listeCategories->fetch_object()){
			echo "<div style='width:350px; float:left;'>";
				echo "<a href='./index.php?page=articles&categorie=".$categories->nom."'>".$categories->nom."</a>";
			echo "</div>";
			echo "<div style='float:left; width:200px'>";
				echo "<a href='./administration.php?onglet=categories&id=".$categories->id."'>Modifier la catégorie</a>";
			echo "</div><br class='clear' />";
		}
echo "</div>";
?>