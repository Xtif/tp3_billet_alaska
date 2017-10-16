<?php

class User_dao {

	// Verifie si le couple identifiant/password est correct
	public static function verification_user($identifiant, $password) {
		$database = new Database();
		$sql = "SELECT * FROM user WHERE identifiant=:identifiant AND password=:password";
		$reponse = $database->execute_query($sql, array(':identifiant' => $identifiant, ':password' => $password));
		$user = $reponse->fetch();
		return $user ? true : false;
	}

}

?>