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

	// Envoie de la requete à la BDD
	public function find_this_query($sql) {
		// $sql = $this->escape_string($sql);
		$requete = $this->connection->query($sql);
		// $requete = $this->connection->prepare($sql);
		// $reponse = $requete->execute();
		// $this->confirm_query($reponse);
		// $reponse->closeCursor();
		return $requete;
	}


	//Insertion dans la BDD
	public function execute_query($sql) {
		return $insertion = $this->connection->exec($sql);
	}


	// Verification que la requete renvoie quelque chose
	private function confirm_query($reponse) {
		if (!$reponse) {
			die("Query failed");
		}
	}

	// Echappe les aractères spéciaux (empeche les injections SQL
	public function escape_string($string) {
		$escaped_string = $this->connection->quote($string);
		return $escaped_string;
	}

	// Renvoie le dernier id inséré
	public function last_insert_id() {
		return $this->connection->lastInsertId();
	}

	// Ferme la requete
	public function close_connection() {
		$this->connection = null;
	}

}



?>