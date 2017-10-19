<h4 class="font-italic font-bold text-success text-center"><?php echo Liste_commentaires_ctrl::get_message(); ?></h4>

<h1>Liste des commentaires</h1>

<table class="table table-hover table-responsive">
	<thead class="thead-inverse">
		<tr class="bg-default">
			<th class="colonne-commentaire">Commentaires</th>
			<th>Auteur</th>
			<th class="text-right">Date</th>
			<th style="width:10%;" class="text-right">Episode associé</th>
			<th class="text-right">Nombre de signalements</th>
			<th class="text-right">État</th>
			<th class="text-right">Gérer</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach (Liste_commentaires_ctrl::get_liste_commentaires() as $commentaire) : ?>			
			<tr <?php 
						if (($commentaire->get_nbre_signalements() != 0) && ($commentaire->get_etat() == "En ligne")) {
							echo "class=row-signalements";
						} else if ($commentaire->get_etat() == "Supprimé") {
							echo "class=row-supprime";
						} 
					?>>
				<td><?php echo $commentaire->get_contenu(); ?></td>
				<td><?php echo $commentaire->get_auteur(); ?></td>
				<td class="text-right"><?php echo $commentaire->get_date_publication(); ?></td>
				<td class="text-right">
					<a href="index.php?page=admin_episode&id=<?php echo $commentaire->get_episode_id(); ?>">
						Episode <?php echo $commentaire->get_numero_episode_associe(); ?>
					</a>
				</td>
				<td class="text-right"><?php echo $commentaire->get_nbre_signalements(); ?></td>
				<td class="text-right"><?php echo $commentaire->get_etat(); ?></td>
				<td class="text-right">
					<?php if ($commentaire->get_etat() == "En ligne") : ?>
						<a href="index.php?page=liste_commentaires&action=supprimer_commentaire&commentaire_id=<?php echo $commentaire->get_id(); ?>">Supprimer</a>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>