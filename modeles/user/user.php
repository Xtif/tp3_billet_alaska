<?php

// Classe gérant la connection à l'interface d'administration
class User {

	public $login = false;

	// Verifie si le couple identifiant/password est correct
	public function verification_user($identifiant, $password) {
		global $database;
		$sql = "SELECT * FROM user";
		$reponse = $database->find_this_query($sql);
		$user = $reponse->fetch();
		if (($identifiant === $user['identifiant']) && ($password === $user['password'])) {
			$this->login = true;
			return $this->login;
		} else {
			return false;
		}
	}

	// Vérifie si l'utilisateur est logué
	public function get_login() {
		return $this->login;
	}
}

?>