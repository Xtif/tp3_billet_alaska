<?php

class Episode_dao {

	public static $db_table = "episodes";
	
	// Creation d'un épisode
	// public function create_episode($numero_episode, $titre, $etat, $contenu) {
	// 	global $database;
	// 	var_dump($database->connection);
	// 	$sql = "INSERT INTO " . $this->db_table . "(numero_episode, titre, etat, date_publication, contenu) VALUES ($numero_episode, $titre, $etat, NOW(), $contenu)";
	// 	echo $sql;
	// 	$database->query($sql);
	// }


	// Recupère tous les épisodes
	// Renvoie un tableau d'objet Episode()
	public static function trouver_tout_les_episodes() {
		global $database;
		$sql = "SELECT * FROM " . self::$db_table . "";
		$reponse = $database->find_this_query($sql);
		$all_episodes = array();
		while ($donnees = $reponse->fetch()) {
			$episode = new Episode(array(
				$donnees['id'],
				$donnees['numero_episode'],
				$donnees['titre'],
				$donnees['etat'],
				$donnees['date_publication'],
				$donnees['contenu'],
				$donnees['nbre_commentaires'],
				$donnees['nbre_commentaires_abusifs']
			));
			array_push($all_episodes, $episode);
		}		
		return $all_episodes; 
	}


	// Recupère un episode par son id
	public static function trouver_episode_par_id($id) {
		global $database;
		$sql = "SELECT * FROM " . self::$db_table . " WHERE id=" . $id;
		$reponse = $database->find_this_query($sql);
		$episode = $reponse->fetch();

		if ($episode) {
			$episode_objet = new Episode(array(
				$episode['id'],
				$episode['numero_episode'],
				$episode['titre'],
				$episode['etat'],
				$episode['date_publication'],
				$episode['contenu'],
				$episode['nbre_commentaires'],
				$episode['nbre_commentaires_abusifs']
				));
			return $episode_objet;
		} else {
			return false;
		}
	}

	// Recupere le numero du dernier episode de la table
	public static function numero_dernier_episode() {
		global $database;
		$sql = "SELECT MAX(numero_episode) FROM episodes";
		$reponse = $database->find_this_query($sql);
		$numero_dernier_episode = $reponse->fetch();
		return $numero_dernier_episode[0];
	}

	//Mise à jour d'un épisode
	public function mise_a_jour_episode($episode_id, $numero_episode, $etat, $date_publication, $contenu, $nbre_commentaires, $nbre_commentaires_abusifs) {
		global $database;
		$sql = "UPDATE episodes SET 
			numero_episode=" . $numero_episode . ", 
			etat=" . $etat . ", 
			date_publication=" . $date_publication . ", 
			contenu=" . $contenu . ", 
			nbre_commentaires=" . $nbre_commentaires . ", 
			nbre_commentaires_abusifs=" . $nbre_commentaires_abusifs . " WHERE id=" . $episode_id;
		$reponse = $database->execute_query($sql);
		var_dump($reponse);
	}


	//Ajout d'un commentaire à un épisode (en nombre)
	public static function ajouter_commentaire($episode) {
		global $database;
		$nbre_commentaires = $episode->get_nbre_commentaires() + 1;
		$sql = "UPDATE episodes SET nbre_commentaires=" . $nbre_commentaires . " WHERE id=" . $episode->get_id();
		$reponse = $database->execute_query($sql);
	}

	//Supprimer un commentaire d'un épisode (en nombre)
	public static function supprimer_commentaire($episode) {
		global $database;
		$nbre_commentaires = $episode->get_nbre_commentaires() - 1;
		$sql = "UPDATE episodes SET nbre_commentaires=" . $nbre_commentaires . " WHERE id=" . $episode->get_id();
		$reponse = $database->execute_query($sql);
	}




	

}

?>