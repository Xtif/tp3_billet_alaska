<?php 

$message = "";

//Signalement des commentaires
if (!empty($_GET['commentaire_id'])) { //Si un id de commentaire est renseigné (signalé abusif)
	if (Commentaire_dao::trouver_commentaire($_GET['commentaire_id'])) { //Si cet id correspond à un commentaire existant
		Commentaire_dao::signaler_commentaire($_GET['commentaire_id'], $_GET['id']);
		$message = "Le commentaire a bien été signalé !";
	} else {
		header("Location: index.php?page=episode&id=" . $_GET['id']);
	} 
}

//Publication d'un commentaire
if (isset($_POST['auteur']) && (isset($_POST['commentaire_contenu']))) { //Si un commentaire a été posté
	Commentaire_dao::ajouter_commentaire($_GET['id'], $_POST['auteur'], $_POST['commentaire_contenu']);
	$message = "Votre commentaire a bien été ajouté !";
}


//Accès à la page
if (empty($_GET['id'])) { //Si l'id de l'episode n'est pas renseigné
	echo "<h3 class=text-center >Cet épisode n'existe pas !</h3>";
} else {
	$episode = Episode_dao::trouver_episode_par_id($_GET['id']);

	if (!$episode) { //Si l'id renseigné ne correspond à aucun épisode
		echo "<h3 class=text-center >Cet épisode n'existe pas !</h3>";
	} else {
		$numero_dernier_episode = Episode_dao::numero_dernier_episode();
		$commentaires = Commentaire_dao::trouver_commentaires_publies_episode_ordre_publication($_GET['id']);

		include("vues/front/episode_tpl.php");
	}

}


?>

