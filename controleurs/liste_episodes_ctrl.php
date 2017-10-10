<?php

$message = "";

/******************SUPPRESSION EPISODE**********************/

if (!empty($_GET['id'])) { //Si un id d'épisode est renseigné
	if (Episode_dao::supprimer_episode($_GET['id'])) { //Si cet id correspond à un episode existant
		$message = "L'épisode a bien été supprimé !";
	} else {
		header("Location: index.php?page=liste_episodes");
	}
}

$all_episodes = Episode_dao::trouver_tout_les_episodes();


include("vues/admin/liste_episodes_tpl.php"); 


?>