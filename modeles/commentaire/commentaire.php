
<?php

class Commentaire {

	protected $id;
	protected $episode_id;
	protected $auteur;
	protected $date_publication;
	protected $contenu;
	protected $nbre_signalements;

	public function __construct($episode_id, $auteur, $contenu, $nbre_signalements) {
		$this->set_episode_id($episode_id);
		$this->set_auteur($auteur);
		$this->set_date_publication();
		$this->set_contenu($contenu);
		$this->set_nbre_signalements($nbre_signalements);
	}

	/**********SETTERS***********/
	public set_episode_id($episode_id) {
		$this->episode_id = $episode_id;
	}

	public set_auteur($auteur) {
		$this->auteur = $auteur;
	}

	public set_date_publication() {
		$this->date_publication = getdate();
	}

	public set_contenu($contenu) {
		$this->contenu = $contenu;
	}

	public set_nbre_signalements($nbre_signalements) {
		$this->nbre_signalements = $nbre_signalements;
	}


	/*********GETTER************/
	public get_id() {
		return $this->id;
	}

	public get_episode_id() {
		return $this->episode_id;
	}

	public get_auteur() {
		return $this->auteur;
	}

	public get_date_publication() {
		return $this->date_publication;
	}

	public get_contenu() {
		return $this->contenu;
	}

	public get_nbre_signalements() {
		return $this->nbre_signalements;
	}


}










?>