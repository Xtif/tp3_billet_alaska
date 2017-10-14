<?php 

class Episode_ctrl {

	public static $message;

	/**************INCLUSION DE LA VUE*************************/
	public static function inclusion_vue() {
		if (!Episode_ctrl::id_renseigne()) { //Si l'id du Get est vide
			echo "<h3 class=text-center >Cet épisode n'existe pas !</h3>";
		} else { // Si l'id du get est rensigné
			$episode = Episode_dao::trouver_episode_par_id($_GET['id']);
				if (!Episode_ctrl::id_existe($episode)) { // Si l'id renseigné ne correspond à aucun épisode
					echo "<h3 class=text-center >Cet épisode n'existe pas !</h3>";
				} else { // Si tout est OK, on affiche la vue
					include("vues/front/episode_tpl.php");
				}
		}	
	}

	/****************PUBLICATION NOUVEAU COMMENTAIRE***********************/
	public static function publication_commentaire() {
		if (Episode_ctrl::post_formulaire_commentaire()) { // Si un commentaire est soumis au POST
			Commentaire_dao::ajouter_commentaire($_GET['id'], $_POST['auteur'], $_POST['commentaire_contenu']);
			self::$message = "Votre commentaire a bien été ajouté !";
		} else { 
			header("Location: index.php?page=episode&id=" . $_GET['id']);
		}
	}

	// Boolean verifiant l'existence d'un commentaire a publié (POST)
	public static function post_formulaire_commentaire() {
		return (isset($_POST['auteur']) && (isset($_POST['commentaire_contenu']))) ? true : false;
	}


	/******************SIGNALEMENT D'UN COMMENTAIRE***********************/
	// Boolean verifiant l'existence d'un commentaire a signalé (GET)
	public static function get_commentaire_signale() {
		return (!empty($_GET['commentaire_id'])) ? true : false;
	}

	// Booleen de verification que le commentaire existe dans la BDD
	public static function commentaire_existe() {
		return (Commentaire_dao::trouver_commentaire($_GET['commentaire_id']));
	}

	public static function signaler_commentaire() {
		if (Episode_ctrl::get_commentaire_signale()) { // Si un commentairee est passé au GET
			if (self::commentaire_existe()) { // Si ce commentaire existe
				Commentaire_dao::signaler_commentaire($_GET['commentaire_id'], $_GET['id']);
				self::$message = "Le commentaire a bien été signalé !";
			} else {
				header("Location: index.php?page=episode&id=" . $_GET['id']);
			}
		} else {
			header("Location: index.php?page=episode&id=" . $_GET['id']);
		}
	}


	/***************RECUPERATION DES ELEMENTS DE LA PAGE**********************/
	// Booléan verifiant le passage d'un id au GET
	public static function id_renseigne() {
		return (empty($_GET['id'])) ? false : true; 
	}

	// Booléan vérifiant que cet id correspond bien a un épisode existant
	public static function id_existe($episode) {
		return ($episode) ? true : false;
	}


	/****************RECUPERATION DU MESSAGE A AFFICHER******************/
	public static function get_message() {
		return self::$message;
	}

} //End of class


?>