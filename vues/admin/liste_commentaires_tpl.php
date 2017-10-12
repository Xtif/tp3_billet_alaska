<h4 class="font-italic font-bold text-success text-center"><?php echo $message; ?></h4>

<h1>Liste des commentaires</h1>

<table class="table table-hover table-responsive">
	<thead class="thead-inverse">
		<tr class="bg-default">
			<th class="colonne-commentaire">Commentaires</th>
			<th>Auteur</th>
			<th class="text-right">Date</th>
			<th class="text-right">Episode associé</th>
			<th class="text-right">Nombre de signalements</th>
			<th class="text-right">Gérer</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($all_commentaires as $commentaire) : ?>			
			<tr <?php if ($commentaire->get_nbre_signalements() != 0) {echo "class=row-signalements";} ?>>
				<td><?php echo $commentaire->get_contenu(); ?></td>
				<td><?php echo $commentaire->get_auteur(); ?></td>
				<td class="text-right"><?php echo $commentaire->get_date_publication(); ?></td>
				<td class="text-right">
					<a href="index.php?page=admin_episode&id=<?php echo $commentaire->get_episode_id(); ?>">
						Episode <?php echo $commentaire->get_episode_id(); ?>
					</a>
				</td>
				<td class="text-right"><?php echo $commentaire->get_nbre_signalements(); ?></td>
				<td class="text-right">
					<a href="index.php?page=liste_commentaires&commentaire_id=<?php echo $commentaire->get_id(); ?>">Supprimer</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

