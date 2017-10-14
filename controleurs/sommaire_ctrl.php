<?php

class Sommaire_ctrl {

	public static function inclusion_vue() {
		include("vues/front/sommaire_tpl.php");
	}

	public static function get_liste_episodes_publies() {
		return Episode_dao::trouver_tout_les_episodes_publies();
	}
}

?>