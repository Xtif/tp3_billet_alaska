<?php

define("SITE_ROOT","C:/wamp64/www/tp3_billet_alaska");

require_once("modeles/tools/database.php");


/***********AUTOLOADER******************/
// Inclusion des classes manquantes
// Param: $class = classe demandées
function classAutoloader($class) {
	
	$class = strtolower($class);
	
	$path_1 = SITE_ROOT . "/modeles/episode/" . $class . ".php";
	$path_2 = SITE_ROOT . "/modeles/commentaire/" . $class . ".php";
	$path_3 = SITE_ROOT . "/modeles/abonne/" . $class . ".php";
	$path_4 = SITE_ROOT . "/modeles/tools/" . $class . ".php";
	$path_5 = SITE_ROOT . "/modeles/user/" . $class . ".php";

	if (file_exists($path_1)) {
		require_once($path_1);
	} else if (file_exists($path_2)) {
		require_once($path_2);
	} else if (file_exists($path_3)) {
		require_once($path_3);
	} else if (file_exists($path_4)) {
		require_once($path_4);
	} else if (file_exists($path_5)) {
		require_once($path_5);
	} else {
		die("The file {$class}.php was not found !");
	}
} // End classAutoloader()

	// Autoload de la fonction classAutoloader
	spl_autoload_register('classAutoloader');

?>