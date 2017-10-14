<h1 class="col-lg-8 p-0 mx-auto">Sommaire</h1>

<div id="accordion" role="tablist">
	<?php	foreach (Sommaire_ctrl::get_liste_episodes_publies() as $episode) : ?>	

		<div class="card col-lg-8 p-0 mx-auto">
		  <div class="card-header" role="tab" id="headingOne">
		    <h5 class="mb-0">
		      <a data-toggle="collapse" href="#collapseOne-<?php echo $episode->get_id(); ?>" aria-expanded="true" aria-controls="collapseOne">
		        <?php echo "Episode " . $episode->get_numero_episode(); ?>
		      </a>
		      <?php echo " - " . $episode->get_titre() . " - Publié le " . $episode->get_date_creation(); ?>
		    </h5>
		  </div>

		  <div id="collapseOne-<?php echo $episode->get_id(); ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
		    <div class="card-body">
		      <?php echo substr($episode->get_contenu(), 0, 250) . "..."; ?>
		      <a href="index.php?page=episode&id=<?php echo $episode->get_id(); ?>">Lire la suite</a>
		    </div>
		  </div>
		</div>

	<?php endforeach; ?>
</div> <!--End accordion-->