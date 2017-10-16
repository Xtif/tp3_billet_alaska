<?php 

class Admin_episode_ctrl {

	public static $message = "";

	/**************INCLUSION DE LA VUE*************************/
	public static function inclusion_vue() {
		if (!isset($_SESSION['user_login'])) {
			header('Location: index.php?page=se_connecter');
		} else {
			$episode = self::recuperation_page()["episode"];
			$all_commentaires_episode = self::recuperation_page()["commentaires"];
			include("vues/admin/admin_episode_tpl.php");
		}
	}



	/********************RECUPERATION DES ELEMENTS DE LA PAGE (EPISODE ET COMMENTAIRES)***********************/
	public static function recuperation_page() {

		if (self::id_get_episode_renseigne()) { // Si l'id est renseigné on recupère l'episode correspondant
			
			$episode = Episode_dao::trouver_episode_par_id($_GET['id']);
			
			if ($episode) { // Si l'id correspond bien à un épisode
				$all_commentaires_episode = Commentaire_dao::trouver_commentaires_episode_ordre_signalements($_GET['id']);
			} else { // Sinon on en crée un vide
				$episode = new Episode(array(
					'id'								=> "",
					'numero_episode'		=> "",
					'titre'							=> "",
					'etat'							=> "",
					'date_creation'			=> "",
					'date_maj'					=> "",
					'contenu'						=> "",
					'nbre_commentaires'	=> "",
					'nbre_signalements'	=> ""
				));

				$all_commentaires_episode = new Commentaire(array(
					'id' 								=> "",
					'episode_id' 				=> "",
					'etat'							=> "",
					'auteur'						=> "",
					'date_publication'	=> "",
					'contenu'						=> "",
					'nbre_signalements'	=> ""
				));
			}

		} else { // Sinon on en crée un vide
				$episode = new Episode(array(
					'id'								=> "",
					'numero_episode'		=> "",
					'titre'							=> "",
					'etat'							=> "",
					'date_creation'			=> "",
					'date_maj'					=> "",
					'contenu'						=> "",
					'nbre_commentaires'	=> "",
					'nbre_signalements'	=> ""
				));

				$all_commentaires_episode = new Commentaire(array(
					'id' 								=> "",
					'episode_id' 				=> "",
					'etat'							=> "",
					'auteur'						=> "",
					'date_publication'	=> "",
					'contenu'						=> "",
					'nbre_signalements'	=> ""
				));
			}

			return $donnees = array("episode" => $episode, "commentaires" => $all_commentaires_episode);		
	}

	public static function id_get_episode_renseigne() {
		return (!empty($_GET['id'])) ? true : false;
	}

	public static function episode_existe() {
		if (self::id_get_episode_renseigne()) {
			return ($episode = Episode_dao::trouver_episode_par_id($_GET['id'])) ? true : false;
		} else {
			return false;
		}
	}



	/**************************PUBLIER/MAJ OU SAUVEGARDER UN EPISODE*************************/
	public static function publier_maj_episode() {
		if (isset($_POST['publier'])) { // Si l'episode est publié/maj
			self::publier();
			header('Location: index.php?page=liste_episodes');
		} else if (isset($_POST['sauvegarder'])) { // Si l'episode est sauvegardé
			self::sauvegarder();
		}
	}

	// Verifie que le POST du numero d'episode est bien renseigné et strictement positif
	public static function verification_post_numero() {
		if ($_POST['numero_episode'] <= 0 || empty($_POST['numero_episode'])) { // Si le numero est vide ou inférieur à 0
			return $_POST['numero_episode'] = Episode_dao::numero_dernier_episode() + 1; // On lui attribue un numero à la suite des existants
		} else {
			return $_POST['numero_episode'];
		}
	}

	public static function publier() {
		if (!self::id_get_episode_renseigne()) { // Si l'id du GET n'est pas renseigné (nouvel episode)

			$_POST['numero_episode'] = self::verification_post_numero();

			if (Episode_dao::numero_existe($_POST['numero_episode'])) { // Si le numero de l'episode existe deja
				Episode_dao::decaler_numero_episode_insertion($_POST['numero_episode']);
				self::$message = "L'épisode a bien été publié et les autres numéros d'épisode ont été décalés !";
			} else { //Si le numero n'existe pas
				self::$message = "L'épisode a bien été publié !";
			}

			Episode_dao::creer_episode($_POST['numero_episode'], $_POST['titre_episode'], 1, $_POST['contenu']);
			$_GET['id'] = Episode_dao::id_dernier_episode();

		} else if (self::id_get_episode_renseigne()) { // Si l'id du GET est renseigné (episode mise a jour)

			$_POST['numero_episode'] = self::verification_post_numero();
			$episode = Episode_dao::trouver_episode_par_id($_GET['id']);

			if (Episode_dao::numero_existe($_POST['numero_episode']) && ($_POST['numero_episode'] != $episode->get_numero_episode())) { //Si un autre episode (que lui meme) possede le meme numero, on decale les numeros suivant
				Episode_dao::decaler_numero_episode_insertion($_POST['numero_episode']);
				self::$message = "L'épisode a bien été publié et les autres numéros d'épisode ont été décalés !";
			} else { // Sinon on le met à jour
				Episode_dao::mise_a_jour_episode($_GET['id'], $_POST['numero_episode'], $_POST['titre_episode'], 1, $_POST['contenu']);
				self::$message = "L'épisode a bien été publié !";
			}

			Episode_dao::mise_a_jour_episode($_GET['id'], $_POST['numero_episode'], $_POST['titre_episode'], 1, $_POST['contenu']);
		}
		//Abonne_dao::envoie_email(); //Envoie du mail aux abonnés de la newsletter
	}

	public static function sauvegarder() {
		if (!self::id_get_episode_renseigne()) { // Si l'id n'est pas renseigné, l'episode est créé 

			$_POST['numero_episode'] = self::verification_post_numero();

			if (Episode_dao::numero_existe($_POST['numero_episode'])) { // Si le numero de l'episode existe deja
				Episode_dao::decaler_numero_episode_insertion($_POST['numero_episode']);
				self::$message = "L'épisode a bien été sauvegardé et les autres numéros d'épisode ont été décalés !";
			} else { //Si le numero n'existe pas
				self::$message = "L'épisode a bien été sauvegardé !";
			}

			Episode_dao::creer_episode($_POST['numero_episode'], $_POST['titre_episode'], 0, $_POST['contenu']);
			$_GET['id'] = Episode_dao::id_dernier_episode();

		} else if (self::id_get_episode_renseigne()) { // Sinon l'épisode est mis à jour

			$_POST['numero_episode'] = self::verification_post_numero();
			$episode = Episode_dao::trouver_episode_par_id($_GET['id']);

			if (Episode_dao::numero_existe($_POST['numero_episode']) && ($_POST['numero_episode'] != $episode->get_numero_episode())) {
				Episode_dao::decaler_numero_episode_insertion($_POST['numero_episode']);
				self::$message = "L'épisode a bien été sauvegardé et les autres numéros d'épisode ont été décalés !";
			} else {
				self::$message = "L'épisode a bien été sauvegardé !";
			}
			
			Episode_dao::mise_a_jour_episode($_GET['id'], $_POST['numero_episode'], $_POST['titre_episode'], 0, $_POST['contenu']);
		}
	}



	/******************SUPPRESSION COMMENTAIRE**********************/
	public static function supprimer_commentaire() {
		if (!empty($_GET['commentaire_id'])) { //Si un id de commentaire est renseigné
			if (Commentaire_dao::supprimer_commentaire($_GET['commentaire_id'])) { //Si cet id correspond à un commentaire existant
				self::$message = "Le commentaire a bien été supprimé !";
			} else {
				header("Location: index.php?page=admin_episode&id=" . $_GET['id']);
			}
		}
	}



	/****************RECUPERATION DU MESSAGE A AFFICHER******************/
	public static function get_message() {
		return self::$message;
	}



} // End of class

?>