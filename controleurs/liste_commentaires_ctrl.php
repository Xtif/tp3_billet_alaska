<?php

class Liste_commentaires_ctrl {

	public static $message = "";


	/**************INCLUSION DE LA VUE*************************/
	public static function inclusion_vue() {
		include("vues/admin/liste_commentaires_tpl.php");
	}


	/***************RECUPERATION DES ELEMENTS DE LA PAGE**********************/
	public static function get_liste_commentaires() {
		return Commentaire_dao::trouver_tous_les_commentaires_ordre_signalements();
	} 


	/***************GESTION DE LA SUPPRESSION**********************/
	// Verifie qu'un id est passé pour suppression
	public static function commentaire_a_supprimer() {
		return (!empty($_GET['commentaire_id'])) ? true : false; 
	}

	// Supprime un commentaire si l'id est renseigné
	public static function supprimer_commentaire() {
		if (self::commentaire_a_supprimer()) {
			if ($commentaire = Commentaire_dao::trouver_commentaire($_GET['commentaire_id'])) {
				Commentaire_dao::supprimer_commentaire($_GET['commentaire_id']);
				self::$message = "Le commentaire a bien été supprimé !";
			} else {
				header("Location: index.php?page=liste_commentaires");
			}
		}
	}


	/****************RECUPERATION DU MESSAGE A AFFICHER******************/
	public static function get_message() {
		return self::$message;
	}

} // End of class Liste_episodes_ctrl()

?>