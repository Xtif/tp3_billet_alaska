<?php require_once("C:/wamp64/www/tp3_billet_alaska/init.php"); ?>

<!DOCTYPE html>
	<html lang="fr">

	<head>
	  <meta charset="utf-8">
	  <title>Billet simple pour l'Alaska</title>

	  <!--Style-->
		  <!--Bootstrap-->
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

		  <!--Font Awesome-->
		  <script src="https://use.fontawesome.com/a9427a5265.js"></script>

		  <!--Custom CSS-->
		  <link rel="stylesheet" href="/tp3_billet_alaska/vues/css/style.css">

		<!--Script-->
			<!--jQuery-->
			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

			<!--popper-->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
			
			<!--bootstrap-->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

			<!--Google Charts-->
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
			<script type="text/javascript">
				/******************Google Chart********************************/
				google.charts.load("current", {packages:["corechart"]});
				  google.charts.setOnLoadCallback(drawChart);
				  function drawChart() {
				    var data = google.visualization.arrayToDataTable([
				      ['Task', 'Hours per Day'],
				      ['Commentaires',  <?php echo Commentaire_dao::nbre_commentaires_en_ligne_total(); ?>],
				      ['Commentaires abusifs',   <?php echo Commentaire_dao::nbre_commentaires_signales_en_ligne_total(); ?>]
				    ]);
				    var options = {
				      title: "Suivi des commentaires",
				      pieHole: 0.4,
				      slices: {  
				        1: {offset: 0.1},        
				      },
				      colors: [
				        '#28a745',
				        '#dc3545'
				      ],
				    };
				    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
				    chart.draw(data, options);
				}
			</script>

			<!--TinyMCE-->
			<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=y2hoei3hauaqhrusqrii9vrsyxxawwiekayd0iugi91db04v"></script>
  		<script>tinymce.init({ selector:'#contenu-episode' });</script>

  		<!--Custom script-->
  		<script src="/tp3_billet_alaska/vues/js/custom_script.js"></script>

	</head>

	<div class="container-fluid">
		<header>
			<div class="row">
		  	<div class="col-lg-2 ml-auto text-right">
		  			<?php if (isset($_SESSION['user_login'])) { ?>
							<a href="index.php?page=se_connecter&action=se_deconnecter">Se déconnecter</a>
						<?php } else { ?>
							<a href="index.php?page=se_connecter">Se connecter</a>
						<?php } ?>
		  	</div>

		  	<div class="col-lg-12">
			  	<a class="image-header card text-white" href="/tp3_billet_alaska/index.php">
					  <img class="card-img image-header" src="/tp3_billet_alaska/vues/images/alaska_3.jpg" alt="Card image">
					  <div class="card-img-overlay text-center">
					  	<div class="mx-auto titre-header text-center">
						    <h2 class="titre-header-main card-title text-center">Billet simple pour l'Alaska</h2>
						    <h5 class="titre-header-second card-text text-center">Jean FORTEROCHE</h5>
						  </div>
					  </div>
					</a>
			</div>

			</div> <!--End row-->
		</header>


	<body>  