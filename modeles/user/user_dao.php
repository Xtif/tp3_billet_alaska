<?php

class User_dao {

	public static $db_table = "user";

	/*******************************GESTION USER***********************************/
	// Recuperation du user
	public static function trouver_user() {
		$database = new Database();
		$sql = "SELECT * FROM " . self::$db_table;
		$reponse = $database->execute_query($sql);
		$user_found = $reponse->fetch();
		$user = new User(array('id'=>$user_found['id'], 'identifiant'=>$user_found['identifiant'], 'password'=>$user_found['password'],'nbre_vues'=>$user_found['nbre_vues']));		
		return $user; 
	}



	/********************************GESTION NBRE VUES*************************************/
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

} // End of class User_dao()

?>