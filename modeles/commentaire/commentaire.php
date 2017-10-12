<?php

class Commentaire {

	protected $id;
	protected $episode_id;
	protected $auteur;
	protected $date_publication;
	protected $contenu;
	protected $nbre_signalements;

	public function __construct(array $data = array()) {
		$this->hydrate($data);
	}

	public function hydrate($data) {
		$this->set_id($data['id']);
		$this->set_episode_id($data['episode_id']);
		$this->set_auteur($data['auteur']);
		$this->set_date_publication($data['date_publication']);
		$this->set_contenu($data['contenu']);
		$this->set_nbre_signalements($data['nbre_signalements']);
	}

	/**********SETTERS***********/
	public function set_id($id) {
		$this->id = $id;
	}

	public function set_episode_id($episode_id) {
		$this->episode_id = $episode_id;
	}

	public function set_auteur($auteur) {
		$this->auteur = $auteur;
	}

	public function set_date_publication($date_publication) {
		$date = new DateTime($date_publication);
		$date_formatee = $date->format('d/m/Y à H\hi\m');
		$this->date_publication = $date_formatee;
	}

	public function set_contenu($contenu) {
		$this->contenu = $contenu;
	}

	public function set_nbre_signalements($nbre_signalements) {
		$this->nbre_signalements = $nbre_signalements;
	}


	/*********GETTER************/
	public function get_id() {
		return $this->id;
	}

	public function get_episode_id() {
		return $this->episode_id;
	}

	public function get_auteur() {
		return $this->auteur;
	}

	public function get_date_publication() {
		return $this->date_publication;
	}

	public function get_contenu() {
		return $this->contenu;
	}

	public function get_nbre_signalements() {
		return $this->nbre_signalements;
	}


}

?>