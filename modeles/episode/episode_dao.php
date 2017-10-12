<?php

class Episode_dao {

	public static $db_table = "episodes";
	

/********************TROUVER******************************/

	// Recupère tous les épisodes
	// Renvoie un tableau d'objet Episode()
	public static function trouver_tout_les_episodes() {
		global $database;
		$sql = "SELECT * FROM " . self::$db_table . "  ORDER BY numero_episode ASC";
		$reponse = $database->execute_query($sql);
		$all_episodes = array();
		while ($donnees = $reponse->fetch()) {
			$episode = new Episode(array(
				'id'								=> $donnees['id'],
				'numero_episode'		=> $donnees['numero_episode'],
				'titre'							=> $donnees['titre'],
				'etat'							=> $donnees['etat'],
				'date_publication'	=> $donnees['date_publication'],
				'contenu'						=> $donnees['contenu'],
				'nbre_commentaires'	=> $donnees['nbre_commentaires'],
				'nbre_signalements'	=> $donnees['nbre_signalements']
			));
			array_push($all_episodes, $episode);
		}		
		return $all_episodes; 
	}


	// Recupère tous les épisodes publiés
	// Renvoie un tableau d'objet Episode()
	public static function trouver_tout_les_episodes_publies() {
		global $database;
		$sql = "SELECT * FROM " . self::$db_table . " WHERE etat=1";
		$reponse = $database->execute_query($sql);
		$all_episodes = array();
		while ($donnees = $reponse->fetch()) {
			$episode = new Episode(array(
				'id'								=> $donnees['id'],
				'numero_episode'		=> $donnees['numero_episode'],
				'titre'							=> $donnees['titre'],
				'etat'							=> $donnees['etat'],
				'date_publication'	=> $donnees['date_publication'],
				'contenu'						=> $donnees['contenu'],
				'nbre_commentaires'	=> $donnees['nbre_commentaires'],
				'nbre_signalements'	=> $donnees['nbre_signalements']
			));
			array_push($all_episodes, $episode);
		}		
		return $all_episodes; 
	}


	// Recupère un episode par son id
	public static function trouver_episode_par_id($id) {
		global $database;
		$id = (int) $id;

		$sql = "SELECT * FROM " . self::$db_table . " WHERE id=:id";
		$reponse = $database->execute_query($sql, array(':id' => $id));
		$episode = $reponse->fetch();

		if ($episode) {
			$episode_objet = new Episode(array(
				'id'								=> $episode['id'],
				'numero_episode'		=> $episode['numero_episode'],
				'titre'							=> $episode['titre'],
				'etat'							=> $episode['etat'],
				'date_publication'	=> $episode['date_publication'],
				'contenu'						=> $episode['contenu'],
				'nbre_commentaires'	=> $episode['nbre_commentaires'],
				'nbre_signalements'	=> $episode['nbre_signalements']
				));
			return $episode_objet;
		} else {
			return false;
		}
	}


	// Recupère un episode par son numero
	public static function trouver_episode_par_numero($numero_episode) {
		global $database;
		$numero_episode = (int) $numero_episode;

		$sql = "SELECT * FROM " . self::$db_table . " WHERE numero_episode=:numero_episode";
		$reponse = $database->execute_query($sql, array(':numero_episode' => $numero_episode));
		$episode = $reponse->fetch();

		if ($episode) {
			$episode_objet = new Episode(array(
				'id'								=> $episode['id'],
				'numero_episode'		=> $episode['numero_episode'],
				'titre'							=> $episode['titre'],
				'etat'							=> $episode['etat'],
				'date_publication'	=> $episode['date_publication'],
				'contenu'						=> $episode['contenu'],
				'nbre_commentaires'	=> $episode['nbre_commentaires'],
				'nbre_signalements'	=> $episode['nbre_signalements']
				));
			return $episode_objet;
		} else {
			return false;
		}
	}


	// Verifie si ce numero d'episode existe deja
	public static function numero_existe($numero_episode) {
		global $database;
		$numero_episode = (int) $numero_episode;

		$sql = "SELECT * FROM " . self::$db_table . " WHERE numero_episode=:numero_episode";
		$reponse = $database->execute_query($sql, array(':numero_episode' => $numero_episode));
		$episode = $reponse->fetch();
		return ($episode) ? true : false;

	}


	// Recupere le dernier id d'episode inséré dans la table
	public static function id_dernier_episode() {
		global $database;
		$sql = "SELECT MAX(id) FROM episodes";
		$reponse = $database->execute_query($sql);
		$id_dernier_episode = $reponse->fetch();
		return $id_dernier_episode[0];
	}



	// Recupere le numero du dernier episode de la table
	public static function numero_dernier_episode() {
		global $database;
		$sql = "SELECT MAX(numero_episode) FROM episodes";
		$reponse = $database->execute_query($sql);
		$numero_dernier_episode = $reponse->fetch();
		return $numero_dernier_episode[0];
	}



/**************************AJOUTER/SUPPRIMER******************************************/

	//Créer un episode dans la BDD
	public static function creer_episode($numero_episode, $titre, $etat, $contenu) {

		global $database;
		$numero_episode = (int) $numero_episode;

		$sql = "INSERT INTO " . self::$db_table . "(id, numero_episode, titre, etat, date_publication, contenu, nbre_commentaires, nbre_signalements) VALUES (null, :numero_episode, :titre, :etat, NOW(), :contenu, 0, 0)";

		return $database->execute_query($sql, array(
			':numero_episode'	=> $numero_episode,
			':titre'					=> $titre,
			':etat'						=> $etat,
			':contenu'				=> $contenu
		));
	}


	//Supprimer un episode de la BDD
	public static function supprimer_episode($episode_id) {

		global $database;
		$episode_id = (int) $episode_id;
		$episode = self::trouver_episode_par_id($episode_id);
		$commentaires = Commentaire_dao::trouver_commentaires_episode_ordre_publication($episode->get_id());

		if ($episode) { //Si l'épisode existe dans la BDD
			
			foreach ($commentaires as $commentaire) { //Suppression de tous ses commentaires
				Commentaire_dao::supprimer_commentaire($commentaire->get_id());
			}

			$sql = "DELETE FROM " . self::$db_table . " WHERE id=:episode_id"; //Suppression du commentaire

			return $database->execute_query($sql, array(':episode_id' => $episode->get_id()));

		} else {
			return false;
		}
	}



/*******************MISE A JOUR*****************************/

	//Mise à jour d'un épisode
	public static function mise_a_jour_episode($episode_id, $numero_episode, $titre, $etat, $contenu) {
		global $database;
		$episode_id = (int) $episode_id;
		$numero_episode = (int) $numero_episode;
		$titre = addslashes(htmlentities($titre));
		$etat = (int) $etat;
		$contenu = addslashes($contenu);

		$sql = "UPDATE episodes SET 
			numero_episode=:numero_episode, 
			titre=:titre,
			etat=:etat, 
			date_publication=NOW(), 
			contenu=:contenu WHERE id=:episode_id";

		$reponse = $database->execute_query($sql, array(
			':numero_episode'	=> $numero_episode,
			':titre'					=> $titre,
			':etat'						=> $etat,
			':contenu'				=> $contenu,
			':episode_id'			=> $episode_id
		));
	}



/********************COMMENTAIRES*************************************/

	//Ajout d'un commentaire à un épisode (en nombre)
	public static function ajouter_commentaire(episode $episode) {
		global $database;
		$nbre_commentaires = $episode->get_nbre_commentaires() + 1;
		$sql = "UPDATE episodes SET nbre_commentaires=:nbre_commentaires WHERE id=:episode_id";
		$reponse = $database->execute_query($sql, array(
			':nbre_commentaires'	=> $nbre_commentaires,
			':episode_id'					=> $episode->get_id()
		));
	}

	//Ajout d'un signalement abusif à un commentaire d'un épisode (en nombre)
	public static function ajouter_signalement(episode $episode) {
		global $database;
		$nbre_signalements = $episode->get_nbre_signalements() + 1;
		$sql = "UPDATE episodes SET nbre_signalements=:nbre_signalements WHERE id=:episode_id";
		$reponse = $database->execute_query($sql, array(
			':nbre_signalements'	=> $nbre_signalements,
			':episode_id'					=> $episode->get_id()
		));
	}

	//Supprimer un commentaire d'un épisode (en nombre)
	public static function supprimer_commentaire($nbre_signalements, episode $episode) {
		global $database;
		$nbre_signalements = (int) $nbre_signalements;

		$nbre_commentaires = $episode->get_nbre_commentaires() - 1;
		$nbre_signalements_episode = $episode->get_nbre_signalements() - $nbre_signalements;

		$sql = "UPDATE episodes SET nbre_commentaires=:nbre_commentaires, nbre_signalements=:nbre_signalements_episode WHERE id=:episode_id";

		$reponse = $database->execute_query($sql, array(
			':nbre_commentaires'					=> $nbre_commentaires,
			':nbre_signalements_episode'	=> $nbre_signalements_episode,
			':episode_id'									=> (int) $episode->get_id()
		));
	}




	

}

?>