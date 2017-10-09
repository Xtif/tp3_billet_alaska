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