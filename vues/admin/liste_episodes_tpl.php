<?php include("../includes/header.php"); ?>

<?php include("../includes/navigation.php"); ?>

<h1>Liste des épisodes</h1>

<a class="btn btn-info" href="episode_tpl.php" role="button">Ajouter un épisode</a>

<table class="table table-hover table-responsive">
	<thead class="thead-inverse">
		<tr class="bg-default">
			<th>Episode</th>
			<th>Titre</th>
			<th>Etat</th>
			<th>Dernière modification</th>
			<th>Nombre de commentaires</th>
			<th>Nombre de commentaires abusifs</th>
			<th>Gérer</th>
		</tr>
	</thead>

	<tbody>
		<?php 
			$all_episodes = Episode_dao::find_all_episodes();
			foreach ($all_episodes as $episode) : 
		?>			
			<tr>
				<td><a href="../front/episode_tpl.php?numero_episode=<?php echo $episode['numero_episode']; ?>">Episode <?php echo $episode['numero_episode']; ?></a></td>
				<td><?php echo $episode['titre']; ?></td>
				<td><?php echo $episode['etat']; ?></td>
				<td class="text-right"><?php echo $episode['date_publication']; ?></td>
				<td class="text-right"><a href="commentaires_episode_tpl.php?id=<?php echo $episode['id']; ?>">Nombre</a></td>
				<td class="text-right"><a href="commentaires_episode_tpl.php?id=<?php echo $episode['id']; ?>">Nombre abusifs</a></td>
				<td>
					<a href="episode_tpl.php?id=<?php echo $episode['id']; ?>">Modifier</a>
					<a href="delete_episode.php">Supprimer</a>
				</td>
			</tr>
			<?php endforeach; ?>
	</tbody>
</table>


<?php include("../includes/footer.php"); ?>