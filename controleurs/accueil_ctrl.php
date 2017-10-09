<?php

$message="";

//Si le visiteur s'est inscrit à la newsletter
if (!empty($_POST['email_abonne_newsletter'])) {
	Abonne_dao::ajouter_abonne($_POST['email_abonne_newsletter']);
	$message = "Votre inscription à la newsletter a bien été prise en compte !";
}

//Inclusion de la vue
include("vues/front/accueil_tpl.php");

//Affichage du message si insciption à la newsletter
echo "<p class='col-lg-8 mx-auto font-italic text-center text-success' >" . $message . "</p>";

?>