<?php

class Accueil_ctrl {

	public function __construct() {

		if (self::check_abonne()) {
			Abonne_dao::ajouter_abonne($_POST['email_abonne_newsletter']);
		}

		$message = self::check_message();

		//Inclusion de la vue
		include("vues/front/accueil_tpl.php");

	} // End of __construct()




	public static function check_abonne() {
		return (!empty($_POST['email_abonne_newsletter'])) ? true : false;
	}

	public static function check_message() {
		return self::check_abonne() ? "Votre inscription à la newsletter a bien été prise en compte !" : "";
	}


} // End of class Accueil_ctrl()



?>