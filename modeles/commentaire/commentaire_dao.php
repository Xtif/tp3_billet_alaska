
<?php

class Commentaire_dao {

	private static $db_table = "commentaires";


/***********************TROUVER*****************************************/
	//Trouver tout les commentaires par ordre de signalement
	//Renvoie un tableau d'objet Commentaires()
	public static function trouver_tous_les_commentaires_ordre_signalements() {	
		$database = new Database();

		$sql = "SELECT * FROM commentaires ORDER BY nbre_signalements DESC";
		$reponse = $database->execute_query($sql);
		$all_commentaires = array();

		while ($donnees = $reponse->fetch()) {
			$commentaire = new Commentaire(array('id'=>$donnees['id'], 'episode_id'=>$donnees['episode_id'], 'etat'=>$donnees['etat'], 'auteur'=>$donnees['auteur'], 'date_publication'=>$donnees['date_publication'], 'contenu'=>$donnees['contenu'], 'nbre_signalements'=>$donnees['nbre_signalements']));
			array_push($all_commentaires, $commentaire);
		}

		return $all_commentaires;
	}


	//Trouver tout les commentaire d'un épisode donné par nombre de signalements
	//Renvoie un tableau d'objet Commentaires()
	public static function trouver_commentaires_episode_ordre_signalements($episode_id) {
		$database = new Database();

		$sql = "SELECT * FROM commentaires WHERE episode_id=:episode_id ORDER BY nbre_signalements DESC";
		$reponse = $database->execute_query($sql, array(':episode_id' => $episode_id));
		$all_commentaires = array();

		while ($donnees = $reponse->fetch()) {
			$commentaire = new Commentaire(array('id'=>$donnees['id'], 'episode_id'=>$donnees['episode_id'], 'etat'=>$donnees['etat'], 'auteur'=>$donnees['auteur'], 'date_publication'=>$donnees['date_publication'], 'contenu'=>$donnees['contenu'], 'nbre_signalements'=>$donnees['nbre_signalements']));
			array_push($all_commentaires, $commentaire);
		}

		return $all_commentaires;
	}


	//Trouver tout les commentaire en ligne d'un épisode donné par ordre de date de publication
	//Renvoie un tableau d'objet Commentaires()
	public static function trouver_commentaires_publies_episode_ordre_publication($episode_id) {
		$database = new Database();
		$episode_id = (int) $episode_id;

		$sql = "SELECT * FROM commentaires WHERE episode_id=:episode_id AND etat=1 ORDER BY date_publication DESC";

		$reponse = $database->execute_query($sql, array(':episode_id' => $episode_id));
		$all_commentaires = array();

		while ($donnees = $reponse->fetch()) {
			$commentaire = new Commentaire(array('id'=>$donnees['id'], 'episode_id'=>$donnees['episode_id'], 'etat'=>$donnees['etat'], 'auteur'=>$donnees['auteur'], 'date_publication'=>$donnees['date_publication'], 'contenu'=>$donnees['contenu'], 'nbre_signalements'=>$donnees['nbre_signalements']));
			array_push($all_commentaires, $commentaire);
		}

		return $all_commentaires;
	}


	//Trouver un commentaire grace à son id
	//Retourne un objet Commentaire() si existe, false sinon
	public static function trouver_commentaire($commentaire_id) {
		$database = new Database();
		$commentaire_id = (int) $commentaire_id;

		$sql = "SELECT * FROM " . self::$db_table . " WHERE id=:commentaire_id";
		$reponse = $database->execute_query($sql, array(':commentaire_id' => $commentaire_id));

		if ($donnees = $reponse->fetch()) {
			$commentaire = new Commentaire(array('id'=>$donnees['id'], 'episode_id'=>$donnees['episode_id'], 'etat'=>$donnees['etat'], 'auteur'=>$donnees['auteur'], 'date_publication'=>$donnees['date_publication'], 'contenu'=>$donnees['contenu'], 'nbre_signalements'=>$donnees['nbre_signalements']));
			return $commentaire;
		} else {
			return false;
		}
	}


	//Nombre de commentaire en ligne total
	public static function nbre_commentaires_en_ligne_total() {
		$database = new Database();

		$sql = "SELECT COUNT(*) FROM " . self::$db_table . " WHERE etat=1";

		$reponse = $database->execute_query($sql);
		$count = $reponse->fetch();

		return array_shift($count);
	}


	//Nombre de commentaire signalé en ligne total
	public static function nbre_commentaires_signales_en_ligne_total() {
		$database = new Database();

		$sql = "SELECT COUNT(*) FROM " . self::$db_table . " WHERE etat=1 AND nbre_signalements!=0";

		$reponse = $database->execute_query($sql);
		$count = $reponse->fetch();

		return array_shift($count);
	}


	//Trouver le nombre de commentaires en ligne pour un episode donné
	public static function nbre_commentaires_en_ligne($episode_id) {

		$database = new Database();

		$sql = "SELECT COUNT(*) FROM " . self::$db_table . " WHERE episode_id=:episode_id AND etat=1";

		$reponse = $database->execute_query($sql, array(':episode_id' => $episode_id));
		$count = $reponse->fetch();

		return array_shift($count);
	}


	//Trouver le nombre signelements de commentaires en ligne pour un episode donné
	public static function nbre_signalements_en_ligne($episode_id) {

		$database = new Database();

		$sql = "SELECT SUM(nbre_signalements) FROM " . self::$db_table . " WHERE episode_id=:episode_id AND etat=1";

		$reponse = $database->execute_query($sql, array(':episode_id' => $episode_id));
		$count = $reponse->fetch();

		return is_null(array_shift($count)) ? 0 : array_shift($count);

	}

/**************************AJOUTER/SUPPRIMER******************************************/
	//Ajouter un commentaire à la BDD
	//Retourne faux si erreur de requete
	public static function ajouter_commentaire($episode_id, $auteur, $contenu) {

		$database = new Database();
		$episode_id = (int) $episode_id;
		$auteur = htmlspecialchars($auteur);
		$contenu = htmlspecialchars($contenu);

		//Ajout commentaire à l'épisode
		$episode = Episode_dao::trouver_episode_par_id($episode_id);
		Episode_dao::ajouter_commentaire($episode);

		$sql = "INSERT INTO " . self::$db_table . "(id, episode_id, etat, auteur, date_publication, contenu, nbre_signalements) VALUES (null, :episode_id, 1, :auteur, NOW(), :contenu, 0)";

		return ($database->execute_query($sql, array(':episode_id'=>$episode_id, ':auteur'=>$auteur, ':contenu'=>$contenu)));
	}


	//Supprimer un commentaire du front end mais le conserve en BDD
	//Retourne faux si erreur de requete ou si le commentaire n'existe pas
	public static function supprimer_commentaire($commentaire_id) {

		$database = new Database();
		$commentaire_id = (int) $commentaire_id;

		if (self::trouver_commentaire($commentaire_id)) { //Si le commentaire existe dans la BDD

			$sql = "UPDATE " . self::$db_table . " SET etat=0 WHERE id=:commentaire_id";

			return $database->execute_query($sql, array(':commentaire_id' => $commentaire_id));

		} else {
			return false;
		}
	}


	//Supprimer définitivement un commentaire de la BDD
	//Retourne faux si erreur de requete ou si le commentaire n'existe pas
	public static function supprimer_commentaires_definitivement($episode_id) {

		$database = new Database();
		$episode_id = (int) $episode_id;

		$sql = "DELETE FROM " . self::$db_table . " WHERE episode_id=:episode_id";

		return $database->execute_query($sql, array(':episode_id' => $episode_id));
	}




/******************************SIGNALER*****************************************/
	//Ajout d'un signalement à un commentaire
	public static function signaler_commentaire($commentaire_id, $episode_id) {

		$database = new Database();
		$commentaire_id = (int) $commentaire_id;
		$episode_id = (int) $episode_id;

		$commentaire = self::trouver_commentaire($commentaire_id);
		$nbre_signalements = $commentaire->get_nbre_signalements() + 1;

		//Ajoute un signalement au niveau de l'episode
		$episode = Episode_dao::trouver_episode_par_id($episode_id);
		Episode_dao::ajouter_signalement($episode);;

		$sql = "UPDATE commentaires SET nbre_signalements=:nombre_signalements WHERE id=:commentaire_id";
		
		return $database->execute_query($sql, array(':nombre_signalements'=>$nbre_signalements, ':commentaire_id'=>$commentaire->get_id()));
	} 

} //End class Commentaire_dao()

?>