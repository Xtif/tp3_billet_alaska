<?php 

$message = "";
$erreur = "";

/*********************CREATION/MISE A JOUR EPISODE*****************************/

if (isset($_POST['publier'])) { //Si l'episode est créé/mis à jour
	if (empty($_GET['id'])) { // Si l'id n'est pas renseigné, l'episode est créé 
		if (Episode_dao::numero_existe($_POST['numero_episode'])) {
			$erreur = "Ce numéro correspond déjà à un autre épisode !";
		} else {
			Episode_dao::creer_episode($_POST['numero_episode'], $_POST['titre_episode'], 1, $_POST['contenu']);
			$message = "L'épisode a bien été publié !";
			$_GET['id'] = Episode_dao::id_dernier_episode();
			//Abonne_dao::envoie_email(); //Envoie du mail aux abonnés de la newsletter
		}
	} else if (!empty($_GET['id'])) { // Sinon l'épisode est mis à jour
		Episode_dao::mise_a_jour_episode($_GET['id'], $_POST['numero_episode'], $_POST['titre_episode'], 1, $_POST['contenu']);
		$message = "L'épisode a bien été publié !";
		//Abonne_dao::envoie_email(); //Envoie du mail aux abonnés de la newsletter
	}

	
	
} else if (isset($_POST['sauvegarder'])) {
	if (empty($_GET['id'])) { // Si l'id n'est pas renseigné, l'episode est créé 
		Episode_dao::creer_episode($_POST['numero_episode'], $_POST['titre_episode'], 0, $_POST['contenu']);
		$_GET['id'] = Episode_dao::id_dernier_episode();
	} else if (!empty($_GET['id'])) { // Sinon l'épisode est mis à jour
		Episode_dao::mise_a_jour_episode($_GET['id'], $_POST['numero_episode'], $_POST['titre_episode'], 0, $_POST['contenu']);
	}
	$message = "L'épisode a bien été sauvegardé !";
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
	$episode = Episode_dao::trouver_episode_par_id($_GET['id']);
	$all_commentaires_episode = Commentaire_dao::trouver_commentaires_episode_ordre_signalements($_GET['id']);
} else {
	$episode = new Episode(array(
		'id'								=> "",
		'numero_episode'		=> "",
		'titre'							=> "",
		'etat'							=> "",
		'date_creation'			=> "",
		'date_maj'					=> "",
		'contenu'						=> "",
		'nbre_commentaires'	=> "",
		'nbre_signalements'	=> ""
	));

	$all_commentaires_episode = new Commentaire(array(
		'id' 								=> "",
		'episode_id' 				=> "",
		'auteur'						=> "",
		'date_publication'	=> "",
		'contenu'						=> "",
		'nbre_signalements'	=> ""
	));
}

include("vues/admin/admin_episode_tpl.php");

?>