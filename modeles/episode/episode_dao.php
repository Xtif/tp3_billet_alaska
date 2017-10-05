<?php

class Episode_dao {

	public static $db_table = "episodes";
	public static $episode_attribut = array(
		"id"=>"",
		"numero_episode"=>"",
		"titre"=>"",
		"etat"=>"",
		"date_publication"=>"",
		"contenu"=>""
	);
	


	// Creation d'un épisode
	// public function create_episode($numero_episode, $titre, $etat, $contenu) {
	// 	global $database;
	// 	var_dump($database->connection);
	// 	$sql = "INSERT INTO " . $this->db_table . "(numero_episode, titre, etat, date_publication, contenu) VALUES ($numero_episode, $titre, $etat, NOW(), $contenu)";
	// 	echo $sql;
	// 	$database->query($sql);
	// }

	public static function find_all_episodes() {
		global $database;
		$sql = "SELECT * FROM " . self::$db_table . "";
		$reponse = $database->find_this_query($sql);
		$episodes = $reponse->fetchAll();
		return $episodes;
	}


}










?>