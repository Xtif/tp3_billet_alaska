<?php

//Démarrage de la session
session_start();
 
//Inclusion des header et menu
include("vues/includes/header.php");
include("vues/includes/navigation.php");

//Inclusion du contrôleur s'il existe et s'il est spécifié
if (!empty($_GET['page']) && is_file("controleurs/" . $_GET['page'] . "_ctrl.php")) {
  include("controleurs/" . $_GET['page'] . "_ctrl.php");
} else {
	$page_accueil = new Accueil_ctrl();
}
 
//Inclusion du pied de page
include("vues/includes/footer.php");

?>