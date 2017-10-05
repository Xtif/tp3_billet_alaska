<?php include("../includes/header.php"); ?>

<?php include("../includes/navigation.php"); ?>



<form id="form_login" method="post" class="form-control col-lg-5 mx-auto" action="admin/dashboard.php">
	<div class="form-group row">
		<label class="col-lg-2 col-form-label mx-auto" for="identifiant">Identifiant</label>
		<div class="col-lg-8 mx-auto">
			<input class="form-control" type="email" name="identifiant" placeholder="Entrer votre email" required />
		</div>
	</div>

	<div class="form-group row">
		<label class="col-lg-2 col-form-label mx-auto" for="password">Password</label>
		<div class="col-lg-8 mx-auto">
			<input class="form-control" type="password" name="password" placeholder="Password" required />
		</div>
	</div>

	<div class="row">
		<button type="submit" class="btn btn-info mx-auto">Se connecter</button>
	</div>
</form>




<?php include("../includes/footer.php"); ?>




<?php







?>