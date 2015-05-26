<?php
class social{
	function share($twitter, $linkedIn, $viadeo, $googlePlus){
		
		$retour = "<div class='social_share'>";
		
		if($twitter == 1){
			$retour .= "<script src='http://platform.twitter.com/widgets.js' type='text/javascript'></script>
						<a href='http://twitter.com/share' class='twitter-share-button'>Tweeter</a>";
		}
		if($linkedIn == 1){
			$retour .= "<script src='//platform.linkedin.com/in.js' type='text/javascript'></script>
					<script type='IN/Share' data-counter='right'></script>
					<div class='g-plusone' data-size='medium'></div>";
		}

		if($viadeo == 1){
			$retour .= "<script type='text/javascript'>var viadeoWidgetsJsUrl = document.location.protocol+'//widgets.viadeo.com';(function(){var e = document.createElement('script'); e.type='text/javascript'; e.async = true;e.src = viadeoWidgetsJsUrl+'/js/viadeowidgets.js'; var s = document.getElementsByTagName('head')[0]; s.appendChild(e);})();</script>
						<div class='viadeo-share' data-display='btnlight' data-count='right' data-language='fr' data-partner-id='eOephsimlelmvOdsobwpkrvivw'></div>";
		}
		
		if($googlePlus == 1){
			$retour .= "<script type='text/javascript'>
					  window.___gcfg = {lang: 'fr'};

					  (function() {
						var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
						po.src = 'https://apis.google.com/js/plusone.js';
						var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
					  })();
					</script>";
		}

		$retour .= "</div>";
		$retour .= "<br class='clear' />";
		
		return $retour;
	}
}