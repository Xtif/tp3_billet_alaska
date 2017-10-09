<?php 

$message = "";

if (!empty($_GET['commentaire_id'])) { //Si un id de commentaire est renseigné
	if (Commentaire_dao::supprimer_commentaire($_GET['commentaire_id'], $_GET['id'])) { //Si cet id correspond à un commentaire existant
		$message = "Le commentaire a bien été supprimé !";
	} else {
		header("Location: index.php?page=admin_episode&id=" . $_GET['id']);
	}
}

if (!empty($_GET['id'])) {
	$episode = Episode_dao::trouver_episode_par_id($_GET['id']);
	$all_commentaires_episode = Commentaire_dao::trouver_commentaires_episode($_GET['id']);
} else {
	$episode = new Episode(array("", "", "", "", "", ""));
	$all_commentaires_episode = new Commentaire(array("", "", "", "", "", ""));
}

include("vues/admin/admin_episode_tpl.php");

?>