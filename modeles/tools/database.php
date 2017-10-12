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


	// Execution d'une requete préparée dans la BDD
	public function execute_query($sql, $array_parameters=array()) {
		// var_dump($sql);
		// var_dump($array_parameters);
		$requete = $this->connection->prepare($sql);
		$requete->execute($array_parameters);
		return $requete;
	}


	// Ferme la requete
	public function close_connection() {
		$this->connection = null;
	}

}



?>