<?php

class Episode {

	public $id;
	public $numero_episode;
	public $titre;
	public $etat;
	public $date_publication;
	public $contenu;

	public function __construct(array $data = array(
			"id"=>"", 
			"numero_episode"=>"",
			"titre"=>"", 
			"etat"=>"",
			"date_publication"=>"",
			"contenu"=>""
		)) {
		$this->set_id($data["id"]);
		$this->set_numero_episode($data["numero_episode"]);
		$this->set_titre($data["titre"]);
		$this->set_etat($data["etat"]);
		$this->set_date_publication($data["date_publication"]);
		$this->set_contenu($data["contenu"]);
		
	}

	/**********SETTERS***********/
	public function set_id($id) {
		$this->id = $id;
	}

	public function set_numero_episode($numero_episode) {
		$this->numero_episode = $numero_episode;
	}

	public function set_titre($titre) {
		$this->titre = $titre;
	}

	public function set_etat($etat) {
		$this->etat = $etat;
	}

	public function set_date_publication($date_publication) {
		$this->date_publication = $date_publication;
		//$this->date_publication = getdate();
	}

	public function set_contenu($contenu) {
		$this->contenu = $contenu;
	}


	/*********GETTER************/
	public function get_id() {
		return $this->id;
	}

	public function get_numero_episode() {
		return $this->numero_episode;
	}

	public function get_titre() {
		return $this->titre;
	}

	public function get_etat() {
		return $this->etat;
	}

	public function get_date_publication() {
		return $this->date_publication;
	}

	public function get_contenu() {
		return $this->contenu;
	}

	/**********METHODES**********/
	// public function has_the_attribut() {
	// 	return isset($this->
	// }


}

?>