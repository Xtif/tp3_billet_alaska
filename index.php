<?php

//Démarrage de la session
session_start();
 
//Inclusion des header et menu
include("vues/includes/header.php");
include("vues/includes/navigation.php");

// Appel du contrôleur s'il existe et s'il est spécifié
if (!empty($_GET['page']) && is_file("controleurs/" . $_GET['page'] . "_ctrl.php")) {
  // require_once("controleurs/" . $_GET['page'] . "_ctrl.php");
  $nom_controleur = ucfirst($_GET['page']) . "_ctrl";
  $controleur = new $nom_controleur;

 	if (!empty($_GET['action'])) { // Si une action est spécifiée
 		$nom_action = strtolower($_GET['action']);
		if (method_exists($controleur, $nom_action)) {
			$controleur->$nom_action();
		} 
	} 
	$controleur::inclusion_vue();
	

} else { // Appel du controleur de la page d'accueil sinon
	// require_once("controleurs/accueil_ctrl.php");
	header('Location: index.php?page=accueil');
}




 
//Inclusion du pied de page
include("vues/includes/footer.php");

?>