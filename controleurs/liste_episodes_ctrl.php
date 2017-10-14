<?php

if (Liste_episodes_ctrl::episode_a_supprimer()) {
	Liste_episodes_ctrl::supprimer_episode($_GET['id']);
}

class Liste_episodes_ctrl {

	public static $message = "";

	public static function get_liste_episodes() {
		return Episode_dao::trouver_tout_les_episodes();
	} 

	// Récupère le message à afficher
	public static function get_message() {
		return self::$message;
	}

	// Verifie qu'un id est passé pour suppression
	public static function episode_a_supprimer() {
		return (!empty($_GET['id'])) ? true : false; 
	}

	// Supprime un épisode si l'id est renseigné
	public static function supprimer_episode($episode_id) {
		if ($episode = Episode_dao::trouver_episode_par_id($episode_id)) {
			Episode_dao::supprimer_episode($episode_id);
			Episode_dao::decaler_numero_episode_suppression($episode->get_numero_episode());
			self::$message = "L'épisode a bien été supprimé !";
		} 
			self::$message = "Cet épisode n'existe pas !";
	}
} // End of class Liste_episodes_ctrl()

include("vues/admin/Liste_episodes_tpl.php");

?>