<?php	
include('./includes/header.php');

if(isset($_SESSION['ip'])){	
	if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
		session_destroy();
		header('Location: administration.php');
	}		
	
	echo "<div id='blocGauche'>";	
	if(isset($_GET['onglet'])){
		include("./pagesAdmin/".$_GET['onglet'].".php");
	}else{
		echo "<div class='fondGauche'>";
			echo "<h2>Panneau d'administration !</h2>";				
			echo "Bienvenu dans ton panneau d'administration, tu peux y gérer tout ton site via le menu sur ta droite !";
		echo "</div>";
	}
	echo "</div>";	
	echo "<div id='blocDroite'>";		
		echo "<div class='fondDroite'>";
			echo "<h2>Administration</h2>";		
			echo "<div class='emplacementTexte'>";	
				echo "<a href='./administration.php?onglet=articles'>Gestion des articles</a><br />";		
				echo "<a href='./administration.php?onglet=categories'>Gestion des catégories</a><br />";		
				echo "<a href='./administration.php?onglet=pages'>Gestion des pages</a><br />";			
				echo "<a href='./administration.php?onglet=stats'>Statistiques</a><br />";		
				echo "<br /><a href='./administration.php?action=deconnexion'>Se deconnecter</a><br />";	
			echo "</div>";	
		echo "</div>";
	echo "</div>";
	echo "<br style='clear:both;' />";	
}else{	
	if(isset($_POST['btConnexion'])){		
		if($_POST['login'] != "" && $_POST['password'] != ""){		
			if($_POST['login'] == 'nico' && sha1($_POST['password']) == '6eec45449b412460cf4f1aa3278a0aa1ab01266d'){		
				$messageRetour = "Connexion réussie !";			
				$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];			
				$connexion->query("INSERT INTO connexions values (null, now(), '".$_SERVER['REMOTE_ADDR']."')");		
				?><meta http-equiv="refresh" content="2;URL=./administration.php"><?php		
			}else{			
				$messageRetour = "Mauvais pseudo et/ou mot de passe";		
			}	
		}else{		
		$messageRetour = "Merci de renseigner un login et un mot de passe";		
	}	
}
	echo "<div style='background-color:white; padding:10px;'>";
	echo "<h2>Accès à l'administration</h2>";	
			echo "<div style='text-align:center;'>";
				if(isset($messageRetour)){ echo "<span style='color:red'>".$messageRetour."</span><br />"; };
			echo "<i>Pour accéder à l'administration de ce site, merci de vous identifier</i><br />";		
			echo "<form action='./administration.php' method='post'>";			
				echo "Login : <input type='text' name='login' />";	
				echo "Mot de passe : <input type='password' name='password' /><br />";	
				echo "<input type='submit' value='Se connecter' name='btConnexion' />";	
				echo "</form>";	
			echo "</div>";
	echo "</div>";
}	echo "</div>";	

include('./includes/footer.php');?>