<?php
$infoNB = $connexion->query("SELECT * FROM informations where page='".$_GET['page']."' AND postit=1");
while($info = $infoNB->fetch_object()){
	echo "<div id='postit'>";
			echo "<h2>".$info->titre."</h2>";
				if(($_GET['page'] == 'accueil' || !isset($_GET['page'])) && !isset($presencePhoto)){
					$presencePhoto = 'oui';
					echo "<div id='emplacementImage'><img src='./images/photo.jpg' width='89' alt='Nicolas Broisin - Ingénieur Communications Unifiées - Expert Lync' Title='Nicolas Broisin - Ingénieur Communications Unifiées - Expert Lync'/></div>";
				}
				
				echo "<div class='emplacementTexte' >";
					echo $info->contenu;
				echo "</div>";
	echo "</div>";
}

$infoNB = $connexion->query("SELECT * FROM informations where page='".$_GET['page']."' AND postit=0");
while($info = $infoNB->fetch_object()){
	echo "<div class='fondDroite clear'>";
			echo "<h2>".$info->titre."</h2>";
				if(($_GET['page'] == 'accueil' || !isset($_GET['page'])) && !isset($presencePhoto)){
					$presencePhoto = 'oui';
					echo "<div id='emplacementImage'><img src='./images/photo.jpg' width='89' alt='Nicolas Broisin - Ingénieur Communications Unifiées - Expert Lync' Title='Nicolas Broisin - Ingénieur Communications Unifiées - Expert Lync'/></div>";
				}
				
				echo "<div class='emplacementTexte' >";
					echo $info->contenu;
				echo "</div>";
	echo "</div>";
}
?>