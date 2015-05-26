<?php
function aff_twitter($active, $id_twitter, $widget_id){
	if($active == 1){
		if(!empty($id_twitter) && !empty($widget_id)){
			$return = "<div id='twitter'>
						<h2>Mes tweets favoris</h2>
						<a class='twitter-timeline' href='https://twitter.com/".$id_twitter."/favorites' data-widget-id='".$widget_id."'>Tweets favoris de @".$id_twitter."</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script>
					</div>";
			
		}else{
			$return = "Identifiant Twitter ou widget id invalide";
		}

		return $return;
	}
}