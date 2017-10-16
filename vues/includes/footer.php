		</body>

		<hr/> <!--Trait de séparation-->

		<footer>
			<div class="row">
				<div class="col-md-4 small">

					<a href="index.php?page=mentions_legales">Mentions légales</a><br/>
					<?php if (isset($_SESSION['user_login'])) { ?>
						<a href="index.php?page=se_connecter&action=se_deconnecter">Se déconnecter</a>
					<?php } else { ?>
						<a href="index.php?page=se_connecter">Se connecter</a>
					<?php } ?>
				</div>

				<div id="footer_brand" class="col-md-4 ml-auto">
					<p class="text-right small">
						Site réalisé par <strong>Xtif Communication</strong><br/>
						71 rue Jean Jaurès<br/>
						75012 Paris<br/>
						01.42.46.58.95<br/>
						Copyright - Tous droits réservés
					</p>
				</div>
			</div> <!--End row-->
		</footer>




	</div> <!--End container-->

	

</html>