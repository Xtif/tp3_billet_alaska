<?php

class Accueil_ctrl {

	public static $message = "";

/**************INCLUSION DE LA VUE*************************/
	public static function inclusion_vue() {
		include("vues/front/accueil_tpl.php");
	}


/****************ABONNEMENT NEWSLETTER***********************/
	public static function abonnement() {

		if (!empty($_POST['email_abonne_newsletter'])) {		
			$email_clean = htmlspecialchars($_POST['email_abonne_newsletter']);
			
			if (Abonne_dao::email_existe($email_clean)) {
				self::$message = "Cet email est déjà enregistré pour recevoir la newsletter !";
			} else {
				$abonne = new Abonne_dao($email_clean);
				self::$message = "Votre inscription à la newsletter a bien été prise en compte !";		
			}
		}
	}
	

/****************RECUPERATION DU MESSAGE A AFFICHER******************/
	public static function get_message() {
		return self::$message;
	}

} // End of class Accueil_ctrl()

?>