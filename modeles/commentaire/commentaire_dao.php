
<?php

class Commentaire_dao {

	private static $db_table = "commentaires";



/***********************TROUVER*****************************************/

	//Trouver tout les commentaires par ordre de signalement
	public static function trouver_tous_les_commentaires() {
		global $database;

		$sql = "SELECT * FROM commentaires ORDER BY nbre_signalements DESC";
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


	//Trouver tout les commentaire d'un épisode donné par ordre de date de publication
	public static function trouver_commentaires_episode($episode_id) {
		global $database;
		$episode_id = (int) $episode_id;

		$sql = "SELECT * FROM commentaires WHERE episode_id=" . $episode_id . " ORDER BY date_publication DESC";
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


	//Trouver tout les commentaire d'un épisode donné par nombre de signalements
	public static function trouver_commentaires_episode_ordre_signalements($episode_id) {
		global $database;

		$sql = "SELECT * FROM commentaires WHERE episode_id=" . $episode_id . " ORDER BY nbre_signalements DESC";
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


	//Trouver un commentaire grace à son id
	//Retourne un objet Commentaire()
	public static function trouver_commentaire($commentaire_id) {
		
		global $database;
		$commentaire_id = (int) $commentaire_id;

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



/**************************AJOUTER/SUPPRIMER******************************************/

	//Ajouter un commentaire à la BDD
	public static function ajouter_commentaire($episode_id, $auteur, $contenu) {

		global $database;
		$episode_id = (int) $episode_id;
		$auteur = htmlspecialchars($auteur);
		$contenu = htmlspecialchars($contenu);

		$sql = "INSERT INTO " . self::$db_table . "(id, episode_id, auteur, date_publication, contenu, nbre_signalements) VALUES (null, '" . $episode_id . "', '" . $auteur . "', NOW(), '" . $contenu . "', 0)";

		$episode = Episode_dao::trouver_episode_par_id($episode_id);
		Episode_dao::ajouter_commentaire($episode);

		return $database->execute_query($sql);
	}


	//Supprimer un commentaire de la BDD
	public static function supprimer_commentaire($commentaire_id) {

		global $database;
		$commentaire_id = (int) $commentaire_id;
		$commentaire = self::trouver_commentaire($commentaire_id);

		if ($commentaire) { //Si le commentaire existe dans la BDD
			$nbre_signalements = $commentaire->get_nbre_signalements();

			$episode_id = $commentaire->get_episode_id();
			$episode = Episode_dao::trouver_episode_par_id($episode_id);
			Episode_dao::supprimer_commentaire($nbre_signalements, $episode);

			$sql = "DELETE FROM " . self::$db_table . " WHERE id=" . $commentaire_id;

			return $database->execute_query($sql);

		} else {
			return false;
		}
	}




/******************************SIGNALER*****************************************/

	//Ajout d'un signalement à un commentaire
	public static function signaler_commentaire($commentaire_id, $episode_id) {
		
		global $database;
		$commentaire_id = (int) $commentaire_id;
		$episode_id = (int) $episode_id;

		$commentaire = self::trouver_commentaire($commentaire_id);
		$nbre_signalements = $commentaire->get_nbre_signalements() + 1;

		$episode = Episode_dao::trouver_episode_par_id($episode_id);
		Episode_dao::ajouter_signalement($episode);;

		$sql = "UPDATE commentaires SET nbre_signalements=" . $nbre_signalements . " WHERE id=" . $commentaire->get_id();
		
		$database->execute_query($sql);
		
		return true;
	} 

} //End class Commentaire_dao()

?>