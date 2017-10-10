<?php 

$message = "";

echo "test <br/>";
/*********************CREATION EPISODE*****************************/
if (!empty($_POST['publier'])) { //Si l'episode est créé/mis à jour
	echo "test 1<br/>";
	EPISODE_dao::creer_episode($_POST['numero_episode'], $_POST['titre_episode'], 1, $_POST['contenu']);
	$dernier_episode_id = Episode_dao::id_dernier_episode();
	header("Location: index.php?page=admin_episode&id=" . $dernier_episode_id);
}

/******************SUPPRESSION COMMENTAIRE**********************/

if (!empty($_GET['commentaire_id'])) { //Si un id de commentaire est renseigné
	if (Commentaire_dao::supprimer_commentaire($_GET['commentaire_id'])) { //Si cet id correspond à un commentaire existant
		$message = "Le commentaire a bien été supprimé !";
	} else {
		header("Location: index.php?page=admin_episode&id=" . $_GET['id']);
	}
}


/********************RECUPERATION EPISODE ET COMMENTAIRES***********************/

if (!empty($_GET['id'])) {
	echo "test 2 <br/>";
	$episode = Episode_dao::trouver_episode_par_id($_GET['id']);
	$all_commentaires_episode = Commentaire_dao::trouver_commentaires_episode_ordre_signalements($_GET['id']);
} else {
	echo "test 3<br/>";
	$episode = new Episode(array("", "", "", "", "", "", "", ""));
	$all_commentaires_episode = new Commentaire(array("", "", "", "", "", ""));
}

include("vues/admin/admin_episode_tpl.php");

?>