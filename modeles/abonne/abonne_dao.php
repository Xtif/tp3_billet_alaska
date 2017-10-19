<?php

class Abonne_dao {

	private static $db_table = "abonnes_newsletter";
	public $message = "";


	public function __construct($email) {
		self::ajouter_abonne($email);
	}

	// Ajout de l'abonné à la BDD
	public static function ajouter_abonne($email) {
		$database = new Database();
		$sql = "INSERT INTO " . self::$db_table . "(id, email) VALUES (null, :email)";
		return $database->execute_query($sql, array(':email' => $email));
	}


	// Verifie si l'email existe déjà dans la BDD
	public static function email_existe($email) {
		$database = new Database();
		$sql = "SELECT * FROM " . self::$db_table . " WHERE email=:email";
		$reponse = $database->execute_query($sql, array(':email' => $email));
		return (!empty($reponse->fetchAll()));
	}


	// Envoie d'un mail à tous les abonnés si publication/mise à jour de contenu
	public static function envoie_email() {
		$database = new Database();
		$sql = "SELECT email FROM " . self::$db_table;
		$reponse = $database->execute_query($sql);
		$email_to = "";
		while ($donnees = $reponse->fetch()) {
			$email_to .= $donnees['email'] . ", ";
		}

		$email_sujet = "Billet simple pour l'Alaska - Nouveau contenu";
		$email_message = "Un nouveau contenu du roman\r\n<strong>Billet simple pour l'Alaska</strong>\r\nvient d'être publié sur le site\r\n<a href='http://www.billetsimplepourlalaska.com'>www.billetsimplepourlalaska.com !\r\nVenez poursuivre l'aventure...";
		$email_header = 	'From: info@billetsimplepourlalaska.com' . "\r\n" . 'Reply-To: nepasrepondre@billetsimplepourlalaska.com' . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/html; charset=iso-8859-1' . "\r\n" . 'Content-Transfert-Encoding: 8bit' . "\r\n";

		mail($email_to, $email_sujet, $email_message, $email_header);
	}


	//Renvoie le nombre d'abonnés à la newsletter
	public static function nbre_abonnes() {
		$database = new Database();
		$sql = "SELECT COUNT(*) FROM " . self::$db_table;
		$reponse = $database->execute_query($sql);
		$count = $reponse->fetch();
		return array_shift($count);
	}
}

?>