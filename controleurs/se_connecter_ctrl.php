<?php

$message="";
$user = new User();

// Si l'utilisateur est déjà logué, on le redirige vers dashboard.php 
if ($user->get_login()) {
	redirect("../admin/dashboard.php");
}

// Si l'utilisateur a entré un identifiant/password
if (isset($_POST['validation'])) {

	// On assigne les variables
	$identifiant = trim($_POST['identifiant']);
	$password = trim($_POST['password']);

	// On verifie le couple identifiant/password
	$user_valide = $user->verification_user($identifiant, $password);

	if ($user_valide) {
		header("Location: ../admin/dashboard.php");
	} else { // Sinon on affiche un message
		$message = "Votre identifiant ou votre mot de passe est incorrect !";
	}

} else { // Sinon les variabes sont vides
	$message = "";
	$username = "";
	$password = "";
}


include("vues/front/se_connecter_tpl.php");

?>