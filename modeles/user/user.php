<?php

// Classe gérant la connection à l'interface d'administration
class User {

	public $login = false;
	public $nbre_vues;

	public function set_nbre_vues($nbre_vues) {
		$this->nbre_vues = $nbre_vues;
	}

	public function get_nbre_vues() {
		return $this->nbre_vues;
	}

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