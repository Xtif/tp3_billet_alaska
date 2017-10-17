<?php

class User_dao {

	public static $db_table = "user";

	// Verifie si le couple identifiant/password est correct
	public static function verification_user($identifiant, $password) {
		$database = new Database();
		$sql = "SELECT * FROM " . self::$db_table . " WHERE identifiant=:identifiant AND password=:password";
		$reponse = $database->execute_query($sql, array(':identifiant' => $identifiant, ':password' => $password));
		$user = $reponse->fetch();
		return $user ? true : false;
	}

	//Compte le nombre de vues
	public static function increment_nbre_vues() {
		$database = new Database();
		$sql = "UPDATE " . self::$db_table . " SET nbre_vues=:nbre_vues";
		$reponse = $database->execute_query($sql, array(':nbre_vues' => self::count_nbre_vues() + 1));
	}

	//Compte le nombre de vues
	public static function count_nbre_vues() {
		$database = new Database();
		$sql = "SELECT nbre_vues FROM " . self::$db_table;
		$reponse = $database->execute_query($sql);
		$count = $reponse->fetch();
		return ((int)$count['nbre_vues']);
	}

}

?>