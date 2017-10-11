<h4 class="font-italic font-bold text-success text-center"><?php echo $message; ?></h4>

<h1>Liste des épisodes</h1>

<a class="btn btn-info" href="index.php?page=admin_episode" role="button">Ajouter un épisode</a>

<table class="table table-hover table-responsive">
	<thead class="thead-inverse">
		<tr class="bg-default">
			<th>Episode</th>
			<th>Titre</th>
			<th class="text-right">Etat</th>
			<th class="text-right">Dernière modification</th>
			<th style="width:10%;" class="text-right">Nombre de commentaires</th>
			<th class="text-right">Nombre de signalements</th>
			<th class="text-right">Gérer</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($all_episodes as $episode) : ?>			
			<tr>
				<td><a href="index.php?page=episode&id=<?php echo $episode->get_id(); ?>">Episode <?php echo $episode->get_numero_episode(); ?></a></td>
				<td><?php echo $episode->get_titre(); ?></td>
				<td class="text-right"><?php echo $episode->get_etat(); ?></td>
				<td class="text-right"><?php echo $episode->get_date_publication(); ?></td>
				<td class="text-right"><?php echo $episode->get_nbre_commentaires(); ?></td>
				<td class="text-right"><?php echo $episode->get_nbre_signalements(); ?></td>
				<td class="text-right">
					<a href="index.php?page=admin_episode&id=<?php echo $episode->get_id(); ?>">Modifier</a>
					<a href="index.php?page=liste_episodes&id=<?php echo $episode->get_id(); ?>">Supprimer</a>
				</td>
			</tr>
			<?php endforeach; ?>
	</tbody>
</table>

