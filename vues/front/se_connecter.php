<?php include("../includes/header.php"); ?>

<?php include("../includes/navigation.php"); ?>

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


?>

<form id="form_login" method="post" class="form-control col-lg-7 mx-auto" action="se_connecter.php">
	<div class="form-group row">
		<label class="col-lg-2 col-form-label mx-auto" for="identifiant">Identifiant</label>
		<div class="col-lg-8 mx-auto">
			<input class="form-control" type="text" name="identifiant" placeholder="Entrer votre email" required />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-lg-2 col-form-label mx-auto" for="password">Password</label>
		<div class="col-lg-8 mx-auto">
			<input class="form-control" type="password" name="password" placeholder="Password" required />
		</div>
	</div>

	<div class="row">
		<button type="submit" name="validation" class="btn btn-info mx-auto">Se connecter</button>
	</div>

	<div class="message col-lg-12 col-md-12 col-sm-12 col-xs-12 mx-auto">
		<p class="text-center bg-danger font-italic"><?php echo $message; ?></p>
	</div>
</form>






<?php include("../includes/footer.php"); ?>




<?php







?>