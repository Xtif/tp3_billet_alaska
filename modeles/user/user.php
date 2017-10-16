<?php

// Classe gérant la connection à l'interface d'administration
class User {

	public $login = false;

	public function login() {
		$this->login = true;
	}

	public function logout() {
		$this->login = false;
	}

	public function get_login() {
		return $this->login;
	}
}

?>