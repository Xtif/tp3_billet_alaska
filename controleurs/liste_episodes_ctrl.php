<?php

class Liste_episodes_ctrl {

	public static $message = "";


	/**************INCLUSION DE LA VUE*************************/
	public static function inclusion_vue() {
		include("vues/admin/Liste_episodes_tpl.php");
	}


	/***************RECUPERATION DES ELEMENTS DE LA PAGE**********************/
	public static function get_liste_episodes() {
		return Episode_dao::trouver_tout_les_episodes();
	} 


	/***************GESTION DE LA SUPPRESSION**********************/
	// Verifie qu'un id est passé pour suppression
	public static function episode_a_supprimer() {
		return (!empty($_GET['id'])) ? true : false; 
	}

	// Supprime un épisode si l'id est renseigné
	public static function supprimer_episode() {
		if (self::episode_a_supprimer()) { 
			if ($episode = Episode_dao::trouver_episode_par_id($_GET['id'])) {
				Episode_dao::supprimer_episode($_GET['id']);
				Episode_dao::decaler_numero_episode_suppression($episode->get_numero_episode());
				self::$message = "L'épisode a bien été supprimé !";
			} else {
				self::$message = "Cet épisode n'existe pas !";
			}
		}
	}


	/****************RECUPERATION DU MESSAGE A AFFICHER******************/
	public static function get_message() {
		return self::$message;
	}

} // End of class Liste_episodes_ctrl()

?>