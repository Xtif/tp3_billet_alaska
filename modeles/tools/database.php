<?php

class Database {

	public $connection;
	private $host = "localhost";
	private $db_name = "tp3_billet_alaska";
	private $login = "root";
	private $password = "";

	public function __construct() {
		$this->open_db_connection();
	}

	// Connection à la BDD
	private function open_db_connection() {
		try {
			$this->connection = new PDO('mysql: host=' . $this->host . '; dbname=' . $this->db_name . '; charset=utf8', $this->login, $this->password, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		} catch (exception $e) {
			die('Erreur :' . $e->getMessage());
		}
	}


	// Execution d'une requete de selection dans la BDD
	public function find_this_query($sql) {
		$requete = $this->connection->query($sql);
		return $requete;
	}


	// Execution d'une insertion/suppression/mise à jour dans la BDD
	public function execute_query($sql) {
		return $insertion = $this->connection->exec($sql);
	}


	// Ferme la requete
	public function close_connection() {
		$this->connection = null;
	}

}



?>