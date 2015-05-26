<?php 
include('./includes/header.php');
	
	if(!isset($_GET['page'])){
		//header("Location: ./index.php?page=accueil");
	}else{
		if($pageExistante == true){
			include('./pages/'.$_GET['page'].'.php');
		}else{
			echo "<div style='width:500px; color:red; text-align:center; margin:auto'><br />La page demandée n'existe pas ou plus<br /><br /></div>";
			include('./pages/accueil.php');
		}
	}			
	echo "<br style='clear:both' />";

	echo "</div>";
	include('./includes/footer.php');
?>
