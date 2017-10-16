<?php 

class Dashboard_ctrl {

	public static function inclusion_vue() {
		if (!isset($_SESSION['user_login'])) {
			header('Location: index.php?page=se_connecter');
		} else {
			include("vues/admin/dashboard.php");
		}
	}
}

?>