<h2>Nos derniers articles</h2>
<ul>
	<?php foreach($listing as $myArticle){ ?>
	<li>
		<a href="/articles/<?php echo $myArticle['url'];?>">
			<?php echo $myArticle['titre'];
			if(!empty($myArticle['date'])){
				echo "Le ".$myArticle['date']; 
			}?>
		</a>
	</li>
	<?php } ?>
</ul>
