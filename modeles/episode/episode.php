<?php

class Episode {

	public $id;
	public $numero_episode;
	public $titre;
	public $etat;
	public $date_creation;
	public $date_maj;
	public $contenu;
	public $nbre_commentaires;
	public $nbre_signalements;

	public function __construct(array $data = array()) {
		$this->hydrate($data);		
	}

	public function hydrate(array $data) {
		$this->set_id($data['id']);
		$this->set_numero_episode($data['numero_episode']);
		$this->set_titre($data['titre']);
		$this->set_etat($data['etat']);
		$this->set_date_creation($data['date_creation']);
		$this->set_date_maj($data['date_maj']);
		$this->set_contenu($data['contenu']);
		$this->set_nbre_commentaires($data['nbre_commentaires']);
		$this->set_nbre_signalements($data['nbre_signalements']);
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
		$this->etat = ($etat == 1) ? "Publié" : "Brouillon";
	}

	public function set_date_creation($date_creation) {
		$date = new DateTime($date_creation);
		$date_formatee = $date->format('d/m/Y à H\hi\m');
		$this->date_creation = $date_formatee;
	}

	public function set_date_maj($date_maj) {
		$date = new DateTime($date_maj);
		$date_formatee = $date->format('d/m/Y à H\hi\m');
		$this->date_maj = $date_formatee;
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

	public function get_date_creation() {
		return $this->date_creation;
	}

	public function get_date_maj() {
		return $this->date_maj;
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
		return Episode_dao::id_episode_suivant($this->get_numero_episode());
	}

	public function episode_precedent($episode_id) {
		return Episode_dao::id_episode_precedent($episode_id);
	}

	public function get_nbre_commentaires_en_ligne() {
		return Commentaire_dao::nbre_commentaires_en_ligne($this->get_id());
	}

	public function get_nbre_signalements_en_ligne() {
		return Commentaire_dao::nbre_signalements_en_ligne($this->get_id());
	}

} //End of class

?>