<?php

class Se_connecter_ctrl {

	public static $message="";

	/**************INCLUSION DE LA VUE*************************/
	public static function inclusion_vue() {
		self::se_connecter();
		include("vues/front/se_connecter_tpl.php");
	}


	/***************VERIFICATION USERNAME/PASSWORD**************************/
	// Verifie si le couple identifiant/password est correct
	public static function verification_user($identifiant, $password, $user) {
		if ($identifiant == $user->get_identifiant()) {
			return password_verify($password, $user->get_password()) ? true : false;
		} else {
			return false;
		}
	}



	/**********************LOGIN/LOGOUT********************************/
	public static function se_connecter() {
		if (isset($_POST['validation'])) { // Si l'utilisateur a entré un identifiant/password
			$user = User_dao::trouver_user(); // On récupère le user de la table

			if (self::verification_user($_POST['identifiant'], $_POST['password'], $user)) {
				$_SESSION['user_login'] = true;
				header("Location: index.php?page=dashboard");
			} else { // Sinon on renseigne le message
				self::$message = "Votre identifiant ou votre mot de passe est incorrect !";
			}

		} else { // Sinon le message est vide
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