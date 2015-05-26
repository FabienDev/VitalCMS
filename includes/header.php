<!doctype html>
<?php session_start (); ?>
<html>
	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 

		<?php 
		ini_set('display_errors', 1);

		include('./includes/fonctions.php');

		//Connexion base de donnees
		include('./modules/mod_database/config.php');

		// Amélioration du title et meta description pour le referencement
		if((isset($_GET['page']) && $_GET['page'] == 'articles') && isset($_GET['article'])){
			$_GET['article'] = str_replace("_", " ", $_GET['article']);
			$desc = $connexion->query("SELECT * FROM articles WHERE url='".$_GET['article']."'");
			while($balisesArt = $desc->fetch_object()){
				echo "<title>".$balisesArt->titre." - Nicolas BROISIN</title>";
				echo "<meta name='description' content='".$balisesArt->descCourte."'/>";	
			}
		}else{
			echo "<title>Nicolas BROISIN - Ingénieur Communications Unifiées</title>";
			/*$desc = $connexion->query("SELECT contenu FROM informations WHERE idInfo=1");
			$balisesDesc = $desc->fetch_object()->contenu;
			$balisesDesc = str_replace("'", "&apos;", $balisesDesc);
			$balisesDesc = preg_replace('#<[^>]+>#', '', $balisesDesc);
			echo "<meta name='description' content='".$balisesDesc."'/>";*/
		}?>
			
		<meta name="viewport" content="initial-scale=1.0">

		<link rel="shortcut icon" href="/templates/nico/img/favicon.jpg" />

		<link href="/templates/nico/css/style.css" rel="stylesheet" type="text/css" />
		<link href="/templates/nico/css/lightbox.css" rel="stylesheet" type="text/css" />
		<link href="/templates/nico/css/jquery-ui.css" rel="stylesheet" type="text/css" />	

		<script src="/templates/nico/js/jquery-min.js"></script>
		<script src="/templates/nico/js/jq.js"></script>
		<script src="/templates/nico/js/lightbox.js"></script>	
		<script src="/templates/nico/js/jquery-ui.js"></script>	

		<!-- TinyMCE -->

		<script type="text/javascript" src="./jscripts/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
			tinyMCE.init({
				// General options
				mode : "exact",  
				elements : "FormTiny",
				theme : "advanced",
				skin : "o2k7",
				plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

				// Theme options
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,|,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",

				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : true,



				// Drop lists for link/image/media/template dialogs
				template_external_list_url : "lists/template_list.js",
				external_link_list_url : "lists/link_list.js",
				external_image_list_url : "lists/image_list.js",
				media_external_list_url : "lists/media_list.js",

				// Replace values for the template plugin
				template_replace_values : {
					username : "Some User",
					staffid : "991234"
				}
			});

		</script>


		<!-- /TinyMCE -->
		
		
			<?php	
			if(!isset($_GET['article']) && !isset($_GET['tag'])){// Protection contre injections SQL
				foreach ($_GET as $nomchamp => $valeurchamp) 
				{  
					if (isset($valeurchamp)) 
					{
						$listeMots = explode(" ", $valeurchamp);
						if(count($listeMots) > 1) { 
							$_GET[$nomchamp] = "accueil";
						}
					}
				}
			}
			
			// Protection faille includes
			$pageExistante = false; // On initialise à False
			$dirname = "./pages/"; // Nom de votre dossier (dans l'exemple il s'appelera lesPages
			$dir = opendir($dirname); // On ouvre le dossier
			while($file = readdir($dir)) { // Temps qu'il y a des fichiers...
				if($file != '.' && $file != '..' && !is_dir($dirname.$file)){ // Si ce n'est pas le dossier courant (.) ni le dossier mère (..) et que ce n'est pas un dossier alors...
					if($_GET['page'].".php" == $file){
						$pageExistante = true; // La page existe
					}
				}
			}
			?>
		<!-- Tracking Analytics -->
		<script type="text/javascript">


		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-33823728-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
		
		<?php 
			include_once("./system/setting.php");
		?>
	</head>

	<body>
		<div id='background'></div>
		<header>
			<div id='zoneHeader'>
				<a href='/'><div id='titre'><span id='nom'>Nicolas BROISIN</span><p id='metier'>Ingénieur Communications Unifiées</p></div></a>
			
				<?php 
					// Module CMS Blocs
					$init->load_module("blocs_cms", 13, $connexion);
				?>

			</div>
		</header>

		<nav>
			<div id='openMenu'><img src='/images/open_menu.png' id='imgOpenMenu'/><span id='txtMenu'>Ouvrir le menu</span></div>
			<ul>
				<li id='home'><a href="/" ><?php echo ((isset($_GET['page'])) ? "".(($_GET['page'] == 'accueil') ? "<img src='/images/home_hover.png' title='Accueil' alt='Accueil de Nicolas Broisin' />" : "<img src='/images/home.jpg' title='Accueil' alt='Accueil de Nicolas Broisin' />")."" : "<img src='/images/home.jpg' title='Accueil' alt='Accueil de Nicolas Broisin' />") ?></a></li>
				<li id='home_rs'><a href="/" <?php echo ((isset($_GET['page'])) ? "".(($_GET['page'] == 'accueil') ? "class='actif'" : "")."" : "") ?>><span>Accueil</span></a></li>
				
				<li><a href="/parcours" <?php echo ((isset($_GET['page'])) ? "".(($_GET['page'] == 'parcours') ? "class='actif'" : "")."" : "") ?>><span>Mon parcours</span></a></li>
				<li><a href="/articles" <?php echo ((isset($_GET['page'])) ? "".(($_GET['page'] == 'articles') ? "class='actif'" : "")."" : "") ?>><span>Mes articles</span></a></li>
				<li id='last'><a href="/veille"<?php echo ((isset($_GET['page'])) ? "".(($_GET['page'] == 'veille') ? "class='actif'" : "")."" : "") ?> ><span>Ma veille technologique</span></a></li>
			</ul> 

			<!--<form name='fm_search' id='fm_search' method='GET' action='/index.php?page=search'>
				<input type='hidden' name='page' value='search' />
				<input type='text' id='search' name='keywords' />
				<input type='submit' id='bt_search' value=''/>
			</form>-->
		</nav>      

		<div id="conteneur">