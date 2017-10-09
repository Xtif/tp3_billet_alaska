<?php

class Abonne_dao {

	private static $db_table = "abonnes_newsletter";

	public static function ajouter_abonne($email) {
		global $database;
		$email_clean = htmlspecialchars($email);
		$sql = "INSERT INTO " . self::$db_table . "(id, email) VALUES (null, '" . $email . "')";
		return $database->insert_this_query($sql);
	}

}

?>

<!-- thibault.fiacre@gmail.com -->