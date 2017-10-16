<?php

class Episode_dao {

	public static $db_table = "episodes";
	

/********************TROUVER******************************/

	// Recupère tous les épisodes par ordre de creation descendant
	// Renvoie un tableau d'objet Episode()
	public static function trouver_tout_les_episodes() {
		
		$database = new Database();
		$sql = "SELECT * FROM " . self::$db_table . "  ORDER BY date_creation DESC";
		$reponse = $database->execute_query($sql);

		$all_episodes = array();

		while ($donnees = $reponse->fetch()) {
			$episode = new Episode(array(
				'id'								=> $donnees['id'],
				'numero_episode'		=> $donnees['numero_episode'],
				'titre'							=> $donnees['titre'],
				'etat'							=> $donnees['etat'],
				'date_creation'			=> $donnees['date_creation'],
				'date_maj'					=> $donnees['date_maj'],
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

		$database = new Database();
		$sql = "SELECT * FROM " . self::$db_table . " WHERE etat=1";
		$reponse = $database->execute_query($sql);

		$all_episodes = array();

		while ($donnees = $reponse->fetch()) {
			$episode = new Episode(array(
				'id'								=> $donnees['id'],
				'numero_episode'		=> $donnees['numero_episode'],
				'titre'							=> $donnees['titre'],
				'etat'							=> $donnees['etat'],
				'date_creation'			=> $donnees['date_creation'],
				'date_maj'					=> $donnees['date_maj'],
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

		$id = (int) $id;

		$database = new Database();
		$sql = "SELECT * FROM " . self::$db_table . " WHERE id=:id";
		$reponse = $database->execute_query($sql, array(':id' => $id));
		
		$episode = $reponse->fetch();

		if ($episode) {
			$episode_objet = new Episode(array(
				'id'								=> $episode['id'],
				'numero_episode'		=> $episode['numero_episode'],
				'titre'							=> $episode['titre'],
				'etat'							=> $episode['etat'],
				'date_creation'			=> $episode['date_creation'],
				'date_maj'					=> $episode['date_maj'],
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

		$numero_episode = (int) $numero_episode;

		$database = new Database();
		$sql = "SELECT * FROM " . self::$db_table . " WHERE numero_episode=:numero_episode";
		$reponse = $database->execute_query($sql, array(':numero_episode' => $numero_episode));
		
		$episode = $reponse->fetch();

		if ($episode) {
			$episode_objet = new Episode(array(
				'id'								=> $episode['id'],
				'numero_episode'		=> $episode['numero_episode'],
				'titre'							=> $episode['titre'],
				'etat'							=> $episode['etat'],
				'date_creation'			=> $episode['date_creation'],
				'date_maj'					=> $episode['date_maj'],
				'contenu'						=> $episode['contenu'],
				'nbre_commentaires'	=> $episode['nbre_commentaires'],
				'nbre_signalements'	=> $episode['nbre_signalements']
				));
			return $episode_objet;
		} else {
			return false;
		}
	}


	// Verifie si ce numero d'episode existe deja, booléen
	public static function numero_existe($numero_episode) {

		$numero_episode = (int) $numero_episode;

		$database = new Database();
		$sql = "SELECT * FROM " . self::$db_table . " WHERE numero_episode=:numero_episode";
		$reponse = $database->execute_query($sql, array(':numero_episode' => $numero_episode));

		$episode = $reponse->fetch();

		return ($episode) ? true : false;
	}


	//Verifie si un episode est publié, booléen
	public static function episode_publie($episode_id) {
		
		$episode_id = (int) $episode_id;

		$database = new Database();
		$sql = "SELECT etat FROM " . self::$db_table . " WHERE id=:episode_id";
		$reponse = $database->execute_query($sql, array(':episode_id' => $episode_id));

		$etat = $reponse->fetch();

		return $etat['etat'] == 1 ? true : false;
	}


	// Recupere le dernier id d'episode inséré dans la table
	public static function id_dernier_episode() {

		$database = new Database();
		$sql = "SELECT MAX(id) FROM episodes";
		$reponse = $database->execute_query($sql);

		$id_dernier_episode = $reponse->fetch();

		return $id_dernier_episode[0];
	}



	// Recupere le numero du dernier episode de la table
	public static function numero_dernier_episode() {

		$database = new Database();
		$sql = "SELECT MAX(numero_episode) FROM episodes";
		$reponse = $database->execute_query($sql);

		$numero_dernier_episode = $reponse->fetch();

		return $numero_dernier_episode[0];
	}


	public static function numero_episode_associe_commentaire($episode_id) {
		
		$database = new Database();
		$sql = "SELECT numero_episode FROM " . self::$db_table . " WHERE id=:episode_id";

		$reponse = $database->execute_query($sql, array(':episode_id' => $episode_id));

		$numero_episode = $reponse->fetch();

		return $numero_episode[0];
	}

// var_dump($episode_suivant->get_id());

	// Recupere l'id du prochain episode publié
	public static function id_episode_suivant($numero_episode) {
		$numero_episode_suivant = $numero_episode + 1;
		$episode_suivant = Episode_dao::trouver_episode_par_numero($numero_episode_suivant);
		
		if ($episode_suivant) {
			if ($episode_suivant->get_etat() == "Publié") {
				return $episode_suivant->get_id();
			} else {
				self::id_episode_suivant($numero_episode_suivant);
			}
		} else {
		self::id_episode_suivant($numero_episode_suivant);
		}	
	}


	// Recupere l'id du précédent épisode publié 
	public static function id_episode_precedent($numero_episode) {
		$numero_episode_precedent = $numero_episode - 1;
		$episode_precedent = Episode_dao::trouver_episode_par_numero($numero_episode_precedent);

		if ($episode_precedent) {
			if ($episode_precedent->get_etat() == "Publié") {
				return $episode_precedent->get_id();
			} else {
				self::id_episode_suivant($numero_episode_precedent);
			}
		} else {
		self::id_episode_suivant($numero_episode_precedent);
		}	
	}


/**************************AJOUTER/SUPPRIMER******************************************/

	//Créer un episode dans la BDD
	public static function creer_episode($numero_episode, $titre, $etat, $contenu) {

		$numero_episode = (int) $numero_episode;
		$titre = htmlentities($titre);

		$database = new Database();
		$sql = "INSERT INTO " . self::$db_table . "(id, numero_episode, titre, etat, date_creation, date_maj, contenu, nbre_commentaires, nbre_signalements) VALUES (null, :numero_episode, :titre, :etat, NOW(), NOW(), :contenu, 0, 0)";

		return $database->execute_query($sql, array(
			':numero_episode'	=> $numero_episode,
			':titre'					=> $titre,
			':etat'						=> $etat,
			':contenu'				=> $contenu
		));
	}

	// Decale tous les épisodes vers le haut de 1 si insertion d'un numero existant
	public static function decaler_numero_episode_insertion($numero_episode) {

		$numero_episode = (int) $numero_episode;

		$database = new Database();
		$sql = "UPDATE " . self::$db_table . " SET numero_episode = numero_episode+1 WHERE numero_episode >= :numero_episode";

		return $database->execute_query($sql, array(':numero_episode' => $numero_episode));
	}


	// Decale tous les épisodes vers le bas de 1 si suppression d'un numero existant
	public static function decaler_numero_episode_suppression($numero_episode) {

		$numero_episode = (int) $numero_episode;

		$database = new Database();
		$sql = "UPDATE " . self::$db_table . " SET numero_episode = numero_episode-1 WHERE numero_episode >= :numero_episode";

		return $database->execute_query($sql, array(':numero_episode' => $numero_episode));
	}



	//Supprimer un episode de la BDD
	public static function supprimer_episode($episode_id) {

		$episode_id = (int) $episode_id;

		$database = new Database();
		$episode = self::trouver_episode_par_id($episode_id);
		$commentaires = Commentaire_dao::trouver_commentaires_publies_episode_ordre_publication($episode->get_id());

		if ($episode) { //Si l'épisode existe dans la BDD
			
			Commentaire_dao::supprimer_commentaires_definitivement($episode_id);

			$sql = "DELETE FROM " . self::$db_table . " WHERE id=:episode_id"; //Suppression du commentaire

			return $database->execute_query($sql, array(':episode_id' => $episode->get_id()));

		} else {
			return false;
		}
	}



/*******************MISE A JOUR*****************************/

	//Mise à jour d'un épisode
	public static function mise_a_jour_episode($episode_id, $numero_episode, $titre, $etat, $contenu) {
		
		$episode_id = (int) $episode_id;
		$numero_episode = (int) $numero_episode;
		$titre = htmlentities($titre);
		$etat = (int) $etat;
		$contenu = (string) $contenu;

		$database = new Database();
		$sql = "UPDATE " . self::$db_table . " SET 
			numero_episode=:numero_episode, 
			titre=:titre,
			etat=:etat, 
			date_maj=NOW(), 
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
		
		$nbre_commentaires = $episode->get_nbre_commentaires() + 1;

		$database = new Database();
		$sql = "UPDATE " . self::$db_table . " SET nbre_commentaires=:nbre_commentaires WHERE id=:episode_id";
		$reponse = $database->execute_query($sql, array(
			':nbre_commentaires'	=> $nbre_commentaires,
			':episode_id'					=> $episode->get_id()
		));
	}

	//Ajout d'un signalement abusif à un commentaire d'un épisode (en nombre)
	public static function ajouter_signalement(episode $episode) {
		
		$nbre_signalements = $episode->get_nbre_signalements() + 1;

		$database = new Database();
		$sql = "UPDATE " . self::$db_table . " SET nbre_signalements=:nbre_signalements WHERE id=:episode_id";
		$reponse = $database->execute_query($sql, array(
			':nbre_signalements'	=> $nbre_signalements,
			':episode_id'					=> $episode->get_id()
		));
	}

	//Supprimer un commentaire d'un épisode (en nombre)
	public static function supprimer_commentaire($nbre_signalements, episode $episode) {
		
		$nbre_signalements = (int) $nbre_signalements;
		$nbre_commentaires = $episode->get_nbre_commentaires() - 1;
		$nbre_signalements_episode = $episode->get_nbre_signalements() - $nbre_signalements;

		$database = new Database();
		$sql = "UPDATE " . self::$db_table . " SET nbre_commentaires=:nbre_commentaires, nbre_signalements=:nbre_signalements_episode WHERE id=:episode_id";

		$reponse = $database->execute_query($sql, array(
			':nbre_commentaires'					=> $nbre_commentaires,
			':nbre_signalements_episode'	=> $nbre_signalements_episode,
			':episode_id'									=> (int) $episode->get_id()
		));
	}



	




	

}

?>