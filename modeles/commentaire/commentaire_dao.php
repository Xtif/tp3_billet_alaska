
<?php

class Commentaire_dao {

	private static $db_table = "commentaires";

	//Trouver tout les commentaire d'un épisode donné
	public static function trouver_commentaires_episode($episode_id) {
		global $database;

		$sql = "SELECT * FROM commentaires WHERE episode_id=" . $episode_id;
		$reponse = $database->find_this_query($sql);
		$all_commentaires = array();

		while ($donnees = $reponse->fetch()) {
			$commentaire = new Commentaire(array(
				$donnees['id'],
				$donnees['episode_id'],
				$donnees['auteur'],
				$donnees['date_publication'],
				$donnees['contenu'],
				$donnees['nbre_signalements']
			));
			array_push($all_commentaires, $commentaire);
		}

		return $all_commentaires;
	}


	//Ajouter un commentaire à la BDD
	public static function ajouter_commentaire($episode_id, $auteur, $contenu) {
		global $database;

		$sql = "INSERT INTO " . self::$db_table . "(id, episode_id, auteur, date_publication, contenu, nbre_signalements) VALUES (null, '" . $episode_id . "', '" . $auteur . "', NOW(), '" . $contenu . "', 0)";

		$episode = Episode_dao::trouver_episode_par_id($episode_id);
		Episode_dao::ajouter_commentaire($episode);

		return $database->execute_query($sql);
	}


	//Supprimer un commentaire de la BDD
	public static function supprimer_commentaire($commentaire_id, $episode_id) {
		global $database;

		$sql = "DELETE FROM " . self::$db_table . " WHERE id=" . $commentaire_id;

		$episode = Episode_dao::trouver_episode_par_id($episode_id);
		Episode_dao::supprimer_commentaire($episode);

		return $database->execute_query($sql);
	}


	//Trouver un commentaire grace à son id
	//Retourne un objet Commentaire()
	public static function trouver_commentaire($commentaire_id) {
		global $database;

		$sql = "SELECT * FROM " . self::$db_table . " WHERE id=" . $commentaire_id;
		$reponse = $database->find_this_query($sql);

		if ($donnees = $reponse->fetch()) {
			$commentaire = new Commentaire(array(
				$donnees['id'],
				$donnees['episode_id'],
				$donnees['auteur'],
				$donnees['date_publication'],
				$donnees['contenu'],
				$donnees['nbre_signalements']
			));
			return $commentaire;
		} else {
			return false;
		}
	}


	//Ajout d'un signalement à un commentaire
	public static function signaler_commentaire($commentaire_id, $episode_id) {
		global $database;
		$commentaire = self::trouver_commentaire($commentaire_id);
		$nbre_signalements = $commentaire->get_nbre_signalements() + 1;

		$episode = Episode_dao::trouver_episode_par_id($episode_id);
		$episode->set_nbre_commentaires_abusifs($episode->get_nbre_commentaires_abusifs() + 1);

		$sql = "UPDATE commentaires SET nbre_signalements=" . $nbre_signalements . " WHERE id=" . $commentaire->get_id();
		
		$database->execute_query($sql);
		return true;
	} 


	//Renvoie le nombre de commentaires d'un episode donné
	public static function nombre_commentaires($episode_id) {
		global $database;
		$sql = "SELECT COUNT(*) FROM commentaires JOIN episodes ON commentaires.episode_id = episodes.id WHERE episodes.id=" . $episode_id;
		$reponse = $database->find_this_query($sql);
		$nbre_commentaires = $reponse->fetch();
		var_dump($nbre_commentaires);

	}
	


}










?>