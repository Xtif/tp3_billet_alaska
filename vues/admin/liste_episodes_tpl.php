<h4 class="font-italic font-bold text-success text-center"><?php echo Liste_episodes_ctrl::get_message(); ?></h4>

<h1>Liste des épisodes</h1>

<a class="btn btn-info" href="index.php?page=admin_episode" role="button">Ajouter un épisode</a>

<table class="table table-hover table-responsive">
	<thead class="thead-inverse">
		<tr class="bg-default">
			<th class="align-middle">Episode</th>
			<th class="align-middle">Titre</th>
			<th class="text-right align-middle">Etat</th>
			<th class="text-right align-middle">Date de création</th>
			<th class="text-right align-middle">Dernière modification</th>
			<th style="width:10%;" class="text-right align-middle">Commentaires en ligne</th>
			<th style="width:10%;" class="text-right align-middle">Signalements en ligne</th>
			<th class="text-right align-middle">Gérer</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach (Liste_episodes_ctrl::get_liste_episodes() as $episode) : ?>			
			<tr>
				<td><a href="index.php?page=episode&id=<?php echo $episode->get_id(); ?>">Episode <?php echo $episode->get_numero_episode(); ?></a></td>
				<td><?php echo $episode->get_titre(); ?></td>
				<td class="text-right"><?php echo $episode->get_etat(); ?></td>
				<td class="text-right"><?php echo $episode->get_date_creation(); ?></td>
				<td class="text-right"><?php echo $episode->get_date_maj(); ?></td>
				<td class="text-right"><?php echo $episode->get_nbre_commentaires_en_ligne(); ?></td>
				<td class="text-right"><?php echo $episode->get_nbre_signalements_en_ligne(); ?></td>
				<td class="text-right">
					<a href="index.php?page=admin_episode&id=<?php echo $episode->get_id(); ?>">Modifier</a>
					<a class="confirmModalLien" href="index.php?page=liste_episodes&action=supprimer_episode&id=<?php echo $episode->get_id(); ?>">Supprimer</a>
				</td>
			</tr>

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

		<?php endforeach; ?>
	</tbody>
</table>