<section class="articles">
	<h2><?php echo $article['titre']; ?></h2>

	<div id='content'>
		<?php echo nl2br($article['contenu']); ?>
	</div>

	<div id='infosAnnexe'>
		Ecrit le <?php echo $article['date'];?> dans la catégorie <a href="/articles/categorie/<?php echo $article['url_categorie'];?>"><?php echo $article['categorie'];?></a>
	</div>
</section>