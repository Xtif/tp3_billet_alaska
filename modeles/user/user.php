<?php

// Classe gérant la connection à l'interface d'administration
class User {

	public $id;
	public $identifiant;
	public $password;
	public $nbre_vues;

	public function __construct(array $data = array()) {
		$this->hydrate($data);		
	}

	public function hydrate(array $data) {
		$this->set_id($data['id']);
		$this->set_identifiant($data['identifiant']);
		$this->set_password($data['password']);
		$this->set_nbre_vues($data['nbre_vues']);
	}

	/**********SETTERS***********/
	public function set_id($id) {
		$this->id = $id;
	}

	public function set_identifiant($identifiant) {
		$this->identifiant = $identifiant;
	}

	public function set_password($password) {
		$this->password = $password;
	}

	public function set_nbre_vues($nbre_vues) {
		$this->nbre_vues = $nbre_vues;
	}


	/*********GETTERS************/
	public function get_id() {
		return $this->id;
	}

	public function get_identifiant() {
		return $this->identifiant;
	}

	public function get_password() {
		return $this->password;
	}

	public function get_nbre_vues() {
		return $this->nbre_vues;
	}

}

?>