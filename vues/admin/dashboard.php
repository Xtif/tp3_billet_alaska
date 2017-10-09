<?php include("../includes/header.php"); ?>

<?php include("../includes/navigation.php"); ?>

<h1>Dashboard</h1>


<div class="row">

	<!--Premier bloc de stats-->
	<div class="col-lg-3">
		<div class="card border-primary">
			<div class="card-heading bg-primary">
				<div class="row panel-stat">
					<div class="col-lg-6">
						<i class="fa fa-eye fa-5x"></i>
					</div>
					<div class="col-lg-6 text-right stat">52</div>
				</div>
			</div>
			<div class="card-footer">Nombre de vues</div>
		</div>
	</div>

	<!--Deuxième bloc de stats-->
	<div class="col-lg-3">
		<div class="card border-success">
			<div class="card-heading bg-success">
				<div class="row panel-stat">
					<div class="col-lg-6">
						<i class="fa fa-comment fa-5x"></i>
					</div>
					<div class="col-lg-6 text-right stat">67</div>
				</div>
			</div>
			<div class="card-footer">
				<a href="#" class="lien_dashboard">
					<div class="pull-left">Commentaires</div>
					<div class="pull-right">
						<i class="fa fa-arrow-circle-right"></i>
					</div>
				</a>
			</div>
		</div>
	</div>

	<!--Troisième bloc de stats-->
	<div class="col-lg-3">
		<div class="card border-danger">
			<div class="card-heading bg-danger">
				<div class="row panel-stat">
					<div class="col-lg-6">
						<i class="fa fa-comments-o fa-5x"></i>
					</div>
					<div class="col-lg-6 text-right stat">6</div>
				</div>
			</div>
			<div class="card-footer">
				<a href="#" class="lien_dashboard">
					<div class="pull-left">Commentaires abusifs</div>
					<div class="pull-right">
						<i class="fa fa-arrow-circle-right"></i>
					</div>
				</a>
			</div>
		</div>
	</div>

	<!--Quatrieme bloc de stats-->
	<div class="col-lg-3">
		<div class="card border-warning">
			<div class="card-heading bg-warning">
				<div class="row panel-stat">
					<div class="col-lg-6">
						<i class="fa fa-users fa-5x"></i>
					</div>
					<div class="col-lg-6 text-right stat">78</div>
				</div>
			</div>
			<div class="card-footer">Abonnés newsletter</div>
		</div>
	</div>

</div> <!--End row stats-->



<!--Google chart-->
<div class="mx-auto" id="donutchart" style="width: 900px; height: 500px;"></div>

	

<?php include("../includes/footer.php"); ?>