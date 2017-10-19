<h4 class="font-italic font-bold text-success text-center"><?php echo Admin_episode_ctrl::get_message(); ?></h4>

<h1 class="col-lg-10 mx-auto">Créer/modifier un épisode</h1>

<form method="post" action="index.php?page=admin_episode&action=publier_maj_episode&id=<?php echo $episode->get_id(); ?>" class="col-lg-10 mx-auto" novalidate>

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


	<div class="row contenu-episode-row">
		<div class="col-lg-12">
			<label for="contenu">Contenu</label>
			<textarea id="contenu-episode" class="form-control contenu-episode" type="textarea" name="contenu" required><?php echo $episode->get_contenu(); ?></textarea>
		</div>
	</div>

	<div class="row bouton-episode">
		<div class="col-lg-12">
			<button class="btn btn-outline-success" type="submit" name="publier">Publier/mettre à jour</button>
			<?php if ($episode->get_etat() == "Brouillon") : ?>
				<button class="btn btn-outline-secondary" type="submit" name="sauvegarder">Sauvegarder</button>
			<?php endif; ?>
			<button class="confirmModalLien btn btn-outline-danger" href="index.php?page=liste_episodes&action=supprimer_episode&id=<?php echo $episode->get_id(); ?>" >Supprimer</button>
		</div>
	</div>

</form>


<!-- Fenetre modale -->
<div class="modal fade hide" id="modal_suppression" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <p>Vous êtes sur le point de supprimer définitivement un épisode, êtes-vous certain ?</p>
      </div>

      <div class="modal-footer">
        <a href="#" class="btn btn-secondary" id="confirmModalNon">Annuler</a>
        <a href="#" class="btn btn-danger" id="confirmModalOui">Supprimer</a>
      </div>

    </div>
  </div>
</div>



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
				<th class="text-right">État</th>
				<th class="text-right">Gérer</th>
			</tr>
		</thead>

		<tbody>
			<?php 
				
				foreach ($all_commentaires_episode as $commentaire) : 
			?>			
				<tr <?php 
							if (($commentaire->get_nbre_signalements() != 0) && ($commentaire->get_etat() == "En ligne")) {
								echo "class=row-signalements";
							} else if ($commentaire->get_etat() == "Supprimé") {
								echo "class=row-supprime";
							} 
						?>>
					<td><?php echo $commentaire->get_auteur(); ?></a></td>
					<td><?php echo $commentaire->get_date_publication(); ?></td>
					<td class="text-right"><?php echo $commentaire->get_contenu(); ?></td>
					<td class="text-right"><?php echo $commentaire->get_nbre_signalements(); ?></td>
					<td class="text-right"><?php echo $commentaire->get_etat(); ?></td>
					<td class="text-right">
						<?php if ($commentaire->get_etat() == "En ligne") : ?>
							<a href="index.php?page=admin_episode&action=supprimer_commentaire&id=<?php echo $episode->get_id(); ?>&commentaire_id=<?php echo $commentaire->get_id(); ?>">Supprimer</a>
					<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; ?>
		</tbody>
	</table>
</div>