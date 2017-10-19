<?php

//Démarrage de la session
session_start();

//Inclusion du header
include("vues/includes/header.php");

User_dao::increment_nbre_vues();

if (!empty($_GET['page']) && is_file("controleurs/" . $_GET['page'] . "_ctrl.php")) { //Si un controleur est appelé en GET et qu'il existe
  $nom_controleur = ucfirst($_GET['page']) . "_ctrl";
  $controleur = new $nom_controleur;

 	if (!empty($_GET['action'])) { // Si une action est spécifiée en GET
 		$nom_action = strtolower($_GET['action']);
		if (method_exists($controleur, $nom_action)) { // Si l'action correspond à une methode du controleur
			$controleur->$nom_action();
		} 
	} 

	//Inclusion du menu
	include("vues/includes/navigation.php");

	$controleur::inclusion_vue(); // Dans tous les cas, on inclut la vue

} else { // Si aucun controleur n'est passé au GEt ou qu'il n'existe pas, on renvoie vers la page d'accueil
	header('Location: index.php?page=accueil');
}

//Inclusion du pied de page
include("vues/includes/footer.php");

?>