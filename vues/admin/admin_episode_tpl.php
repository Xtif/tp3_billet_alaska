<h4 class="font-italic font-bold text-success text-center"><?php echo $message; ?></h4>
<h4 class="font-italic font-bold text-danger text-center"><?php echo $erreur; ?></h4>

<h1 class="col-lg-10 mx-auto">Créer/modifier un épisode</h1>

<form method="post" action="index.php?page=admin_episode&id=<?php echo $episode->get_id(); ?>" class="col-lg-10 mx-auto">

	<div class="row">

			<div class=col-lg-9>
				<label for="titre">Titre</label>
				<input class="form-control" type="text" name="titre_episode" value="<?php echo $episode->get_titre(); ?>" required/>
			</div>

			<div class="col-lg-3">
				<label for="numero_episode">Numéro de l'épisode</label>
				<input class="form-control" type="number"" name="numero_episode" min="1" value="<?php echo $episode->get_numero_episode(); ?>" required/>
			</div>
	
	</div> <!--End of row-->


<!--Fenetre info sur le coté-->
			<!-- <div class="col-lg-3">
				<div id="info-episode" role="tablist">
				  <div class="card">
				    <div class="card-header" role="tab" id="entete-info">
				      <h5 class="mb-0">
				        <a data-toggle="collapse" href="#info-episode-details" aria-expanded="true" aria-controls="info-episode-details">
				          Infos sur l'épisode
				        </a>
				      </h5>
				    </div>
				    <div id="info-episode-details" class="collapse" role="tabpanel" aria-labelledby="entete-info" data-parent="#info-episode">
				      <div class="card-body">
				        Infos sur l'épisode
				      </div>
				    </div>
				  </div>
				</div> 
			</div> -->

		<div class="row contenu-episode-row">
			<div class="col-lg-12">
				<label for="contenu">Contenu</label>
				<textarea id="contenu-episode" class="form-control contenu-episode" type="textarea" name="contenu" required><?php echo $episode->get_contenu(); ?></textarea>
			</div>
		</div>


		<div class="row bouton-episode">
			<div class="col-lg-12">
				<a class="btn btn-outline-primary" href="index.php?page=episode&id=<?php echo $episode->get_id(); ?>">Voir la page</a>
				<button class="btn btn-outline-success" type="submit" name="publier">Publier/mettre à jour</button>
				<?php if ($episode->get_etat() == "Brouillon") : ?>
					<button class="btn btn-outline-secondary" type="submit" name="sauvegarder">Sauvegarder</button>
				<?php endif; ?>
				<a class="btn btn-outline-danger" href="index.php?page=liste_episodes&id=<?php echo $episode->get_id(); ?>">Supprimer</a>
			</div>
		</div>

</form>


<!--COMMENTAIRES-->
<div class="col-lg-10 mx-auto mt-4">
	<h3>Commentaires</h3>
	<table class="table table-hover table-responsive">
		<thead class="thead-inverse">
			<tr class="bg-default">
				<th>Auteur</th>
				<th>Date</th>
				<th class="text-right">Commentaire</th>
				<th class="text-right">Nombre de signalements</th>
				<th class="text-right">Gérer</th>
			</tr>
		</thead>

		<tbody>
			<?php 
				
				foreach ($all_commentaires_episode as $commentaire) : 
			?>			
				<tr>
					<td><?php echo $commentaire->get_auteur(); ?></a></td>
					<td><?php echo $commentaire->get_date_publication(); ?></td>
					<td class="text-right"><?php echo $commentaire->get_contenu(); ?></td>
					<td class="text-right"><?php echo $commentaire->get_nbre_signalements(); ?></td>
					<td class="text-right">
						<a href="index.php?page=admin_episode&id=<?php echo $episode->get_id(); ?>&commentaire_id=<?php echo $commentaire->get_id(); ?>">Supprimer</a>
					</td>
				</tr>
				<?php endforeach; ?>
		</tbody>
	</table>
</div>





