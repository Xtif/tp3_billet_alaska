<!--Episode-->
<h4 class="font-italic font-bold text-success text-center"><?php echo $message; ?></h4>

<div class="col-lg-10 mx-auto">
	<h1 class="text-center">Episode <?php echo $episode->get_numero_episode(); ?></h1>
	<h2 class="text-center"><?php echo $episode->get_titre(); ?></h2>
	<p class="font-italic text-center">Publié le <?php echo $episode->get_date_creation(); ?></p>
	<p class="text-justify"><?php echo $episode->get_contenu(); ?></p>
</div>


<!--Pagination-->
<nav class="col-lg-10 mx-auto">
	<ul class="pagination <?php if ($episode->get_numero_episode() == 1) {echo "justify-content-end";} else {echo "justify-content-between";} ?>">
		<?php if ($episode->get_numero_episode() != 1) : ?>
			<li class="page-item precedent">
				<a class="bg-dark page-link" href="index.php?page=episode&id=<?php echo $episode->episode_precedent($episode->get_id()); ?>">
					<span aria-hidden="true">&laquo;</span>
					Épisode précédent
				</a>
			</li>
		<?php endif; ?>

		<?php if ($episode->get_numero_episode() != $numero_dernier_episode) : ?>
			<li class="page-item suivant">
				<a class="bg-dark page-link" href="index.php?page=episode&id=<?php echo $episode->episode_suivant($episode->get_id()); ?>">
					Épisode suivant
					<span aria-hidden="true">&raquo;</span>
				</a>
			</li>
		<?php endif; ?>
	</ul>
</nav>



<!--Commentaire form-->
<h4 class="col-lg-8 mx-auto">Laissez un commentaire</h4>
<form method="post" action="index.php?page=episode&id=<?php echo $episode->get_id(); ?>" class="form-control col-lg-8 mx-auto">
	<div class="form-group">
		<label for="auteur">Votre pseudonyme</label>
		<input type="text" class="form-control" name="auteur" required />	
	</div>
	<div class="form-group">
		<label for="commentaire_contenu">Votre commentaire</label>
		<textarea class="form-control commentaire-contenu" name="commentaire_contenu" required/></textarea>	
	</div>
	<button type="submit" class="btn btn-info">Poster un commentaire</button>
</form>


<!--Commentaires-->
<h4 class="font-bold mt-4 col-lg-8 mx-auto">
	Commentaires
</h4>

<div class="row">
	<div class="col-lg-8 mx-auto">
		<?php foreach ($commentaires as $commentaire) : ?>
			<div class="commentaire-episode card mb-2 p-2">
				<div cass="row">
					<h5 class="mb-1 float-left"><?php echo $commentaire->get_auteur(); ?></h5>
					<a class="float-right" href="index.php?page=episode&id=<?php echo $episode->get_id(); ?>&commentaire_id=<?php echo $commentaire->get_id(); ?>">Signaler comme abusif</a>
				</div>
				<h6 class="font-italic small"><?php echo "Publié le " . $commentaire->get_date_publication(); ?></h6>
				<p class="mb-0"><?php echo $commentaire->get_contenu(); ?></p>
		</div>
		<?php endforeach; ?>
	</div>
</div>







