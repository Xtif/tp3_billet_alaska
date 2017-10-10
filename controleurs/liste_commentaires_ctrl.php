<?php

$message = "";

/******************SUPPRESSION COMMENTAIRE**********************/

if (!empty($_GET['commentaire_id'])) { //Si un id de commentaire est renseigné
	if (Commentaire_dao::supprimer_commentaire($_GET['commentaire_id'])) { //Si cet id correspond à un commentaire existant
		$message = "Le commentaire a bien été supprimé !";
	} else {
		header("Location: index.php?page=liste_commentaires");
	}
}



/********************RECUPERATION COMMENTAIRES***********************/

$all_commentaires = Commentaire_dao::trouver_tous_les_commentaires();

?>


<?php include("vues/admin/liste_commentaires_tpl.php"); ?>