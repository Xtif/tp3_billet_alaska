<?php

class Accueil_ctrl {

	public static $message = "";

	public function __construct() {
		self::abonnement();
	} 

	public static function abonnement() {

		if (self::post_formulaire()) {		
			$email_clean = self::nettoyage_email_input($_POST['email_abonne_newsletter']);
			
			if (Abonne_dao::email_existe($email_clean)) {
				self::$message = "Cet email est déjà enregistré pour recevoir la newsletter !";
			} else {
				$abonne = new Abonne_dao($email_clean);
				self::$message = "Votre inscription à la newsletter a bien été prise en compte !";		
			}
		}

		//Inclusion de la vue
		include("vues/front/accueil_tpl.php");
	}

	// Nettoye les caractères spéciaux et les balises
	public static function nettoyage_email_input($email) {
		return htmlspecialchars($email);
	}

	// Verifie si le formulaire a été posté
	public static function post_formulaire() {
		return (!empty($_POST['email_abonne_newsletter'])) ? true : false;
	}

} // End of class Accueil_ctrl()

?>