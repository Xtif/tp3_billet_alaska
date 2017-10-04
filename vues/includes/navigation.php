<nav class="navbar navbar-expand-lg navbar-dark bg-dark">

	<!--Bouton du menu en responsive-->
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="#menu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!--Menu-->
	<div class="collapse navbar-collapse" id="menu">
		<ul class="navbar-nav">

			<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="sous-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sommaire</a>

					<!--Ici boucle PHP sur les épisodes pour le menu-->
					<div class="dropdown-menu" aria-labelledby="sous-menu">
						<a class="dropdown-item" href="#">Episode 1</a>
						<a class="dropdown-item" href="#">Episode 2</a>
						<a class="dropdown-item" href="#">Episode N</a>
					</div>
	
			</li>

			<li class="nav-item">
				<a class="nav-link" href="#">Contact</a>
			</li>

			

		</ul>
	</div>

</nav>


