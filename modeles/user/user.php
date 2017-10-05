<?php

// Class de session
// Param: $signed_in = booléen, true si le user est logué
// Param: $user_id = id de l'user une fois logué (correspond à son Id de session et celui de la BDD)
// Param: $message = string, message renvoyé si besoin
class User {

	public $id;
	private $verif_login = false;
	public $nbre_visiteur;

	// Démarre la session 
	// Vérifie si l'utilisateur est logué
	function __construct() {
		session_start();
		$this->nbre_visiteur();
		$this->verification_login();
		$this->verification_message();
	}

	// Compte le nombre de visites
	public function nbre_visiteur() {
		if (isset($_SESSION['nbre_visiteur'])) {
			return $this->nbre_visiteur = $_SESSION['nbre_visiteur']++;
		} else {
			return $_SESSION['nbre_visiteur'] = 1;
		}
	}

	// Vérifie si l'utilisateur est logué 
	// Renvoie $login = booleen
	public function get_login() {
		return $this->login;
	}

	public function login($user) {
		if ($user) {
			$this->user_id = $_SESSION['user_id'] = $user->id;
			$this->signed_in = true;
		}
	}

	// Unset les variables $user_id et l'id de session + signed_in = false
	// Param: $user = objet User()
	public function logout($user) {
		unset($_SESSION['user_id']);
		unset($this->user_id);
		$this->signed_in = false;
	}

	// Vérifie si l'utilisateur est logué:
	// 		- Si oui: assigne l'id de session à la variable $user_id et $signed_in = true
	//		- Si non: unset $user_id et $signed_in = false
	private function check_the_login() {
		if (isset($_SESSION['user_id'])) {
			$this->user_id = $_SESSION['user_id'];
			$this->signed_in = true;
		} else {
			unset($this->user_id);
			$this->signed_in = false;
		}
	}
}

$session = new Session();
$message = $session->message();





?>