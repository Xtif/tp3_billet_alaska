
<?php

class Episode {

	public $id;
	public $numero_episode;
	public $titre;
	public $etat;
	public $date_publication;
	public $contenu;

	public function __construct($numero_episode, $titre, $etat, $contenu) {
		$this->set_numero_episode($numero_episode);
		$this->set_titre($titre);
		$this->set_etat($etat);
		$this->set_date_publication();
		$this->set_contenu($contenu);
		
	}

	/**********SETTERS***********/
	public set_numero_episode($numero_episode) {
		$this->numero_episode = $numero_episode;
	}

	public set_titre($titre) {
		$this->titre = $titre;
	}

	public set_etat($etat) {
		$this->etat = $etat;
	}

	public set_date_publication() {
		$this->date_publication = getdate();
	}

	public set_contenu($contenu) {
		$this->contenu = $contenu;
	}


	/*********GETTER************/
	public get_id() {
		return $this->id;
	}

	public get_numero_episode() {
		return $this->numero_episode;
	}

	public get_titre() {
		return $this->titre;
	}

	public get_etat() {
		return $this->etat;
	}

	public get_date_publication() {
		return $this->date_publication;
	}

	public get_contenu() {
		return $this->contenu;
	}


}










?>