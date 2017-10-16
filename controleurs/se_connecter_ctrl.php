<?php

class Se_connecter_ctrl {

	public static $message="";

	/**************INCLUSION DE LA VUE*************************/
	public static function inclusion_vue() {
		self::se_connecter();
		include("vues/front/se_connecter_tpl.php");
	}


	/***************VERIFICATION USERNAME/PASSWORD**************************/
	public static function se_connecter() {
		if (isset($_POST['validation'])) { // Si l'utilisateur a entré un identifiant/password

			// On assigne les variables
			$identifiant = trim($_POST['identifiant']);
			$password = trim($_POST['password']);

			// On verifie le couple identifiant/password
			$user_valide = User_dao::verification_user($identifiant, $password);

			if ($user_valide) {
				$_SESSION['user_login'] = true;
				$user = new User();
				$user->login();
				header("Location: index.php?page=dashboard");
			} else { // Sinon on affiche un message
				self::$message = "Votre identifiant ou votre mot de passe est incorrect !";
			}

		} else { // Sinon les variabes sont vides
			self::$message = "";
		}
	}


	public static function se_deconnecter() {
		unset($_SESSION['user_login']);
		header('Location: index.php');
	}


	/****************RECUPERATION DU MESSAGE A AFFICHER******************/
	public static function get_message() {
		return self::$message;
	}

} // End of class


?>