<h2>Mes articles</h2>
<div id="listing_articles">
	<?php foreach($articles['article'] as $article){ ?>
		<a href="/articles/<?php echo $article['url']; ?>" class="link_article">
			<?php echo $article['titre']; ?>
		</a>
		<div class='publications'>
			Publié le <?php echo $article['date']; ?>
		</div>
	<?php } ?> 
</div>

<div id='pagination'>
	<?php if(!empty($articles['pagePrecedente'])){ ?>
		<a href="/articles/page/<?php echo $articles['pagePrecedente'];?>"><?php echo $articles['pagePrecedente'];?></a>
	<?php }
	
	if(!empty($artciles['pageSuivante'])){ ?>
		<a href="/articles/page/<?php echo $articles['pageSuivante'];?>"><?php echo $articles['pageSuivante'];?></a>
	<?php } ?>
</div>