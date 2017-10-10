<?php

class Episode {

	public $id;
	public $numero_episode;
	public $titre;
	public $etat;
	public $date_publication;
	public $contenu;
	public $nbre_commentaires;
	public $nbre_signalements;

	public function __construct(array $data = array()) {
		$this->hydrate($data);		
	}

	public function hydrate(array $data) {
		$this->set_id($data[0]);
		$this->set_numero_episode($data[1]);
		$this->set_titre($data[2]);
		$this->set_etat($data[3]);
		$this->set_date_publication($data[4]);
		$this->set_contenu($data[5]);
		$this->set_nbre_commentaires($data[6]);
		$this->set_nbre_signalements($data[7]);
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
		$date = new DateTime($date_publication);
		$date_formatee = $date->format('d/m/Y à H\hi\m');
		$this->date_publication = $date_formatee;
	}

	public function set_contenu($contenu) {
		$this->contenu = $contenu;
	}

	public function set_nbre_commentaires($nbre_commentaires) {
		$this->nbre_commentaires = $nbre_commentaires;
	}

	public function set_nbre_signalements($nbre_signalements) {
		$this->nbre_signalements = $nbre_signalements;
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

	public function get_nbre_commentaires() {
		return $this->nbre_commentaires;
	}

	public function get_nbre_signalements() {
		return $this->nbre_signalements;
	}

	/**************METHODES*****************/
	public function episode_suivant() {
		$episode_suivant = $this->get_numero_episode() + 1;
		return $episode_suivant;
	}

	public function episode_precedent() {
		$episode_precedent = $this->get_numero_episode() - 1;
		return $episode_precedent;
	}

}



?>