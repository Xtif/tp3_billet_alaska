<?php

$all_episodes = Episode_dao::trouver_tout_les_episodes_publies();

include("vues/front/sommaire_tpl.php");

?>