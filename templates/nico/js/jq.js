$(document).ready( function () {
    // On cache les sous-menus :
    $(".navigation ul.subMenu").hide();
    // On s�lectionne tous les items de liste portant la classe "toggleSubMenu"

    // et on remplace l'�l�ment span qu'ils contiennent par un lien :
    $(".navigation li.toggleSubMenu span").each( function () {
        // On stocke le contenu du span :
        var TexteSpan = $(this).text();
        $(this).replaceWith('<a href="" title="Afficher le sous-menu">' + TexteSpan + '<\/a>') ;
    } ) ;

    // On modifie l'�v�nement "click" sur les liens dans les items de liste
    // qui portent la classe "toggleSubMenu" :
    $(".navigation li.toggleSubMenu > a").click( function () {
        // Si le sous-menu �tait d�j� ouvert, on le referme :
        if ($(this).next("ul.subMenu:visible").length != 0) {
            $(this).next("ul.subMenu").slideUp("normal");
        }
        // Si le sous-menu est cach�, on ferme les autres et on l'affiche :
        else {
            $(".navigation ul.subMenu").slideUp("normal");
            $(this).next("ul.subMenu").slideDown("normal");
        }
        // On emp�che le navigateur de suivre le lien :
        return false;
    });    

	
	$("#openMenu").click(function(){
		if($("nav ul").css("display") == "none"){
			$("nav ul").slideDown("slow");
			$("#txtMenu").text("Fermer le menu");
		}else{
			$("nav ul").slideUp("slow");
			$("#txtMenu").text("Ouvrir le menu");
		}
	});

	$(function() {
		$(".tooltip").tooltip();
	 }); 
});

