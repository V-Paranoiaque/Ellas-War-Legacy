<?php

include('../header.php');

$paquet = new EwPaquet('refresh_chat', array($_GET['clean']));

$rep = $paquet->getRetour();

if(!empty($rep)) {
	foreach($rep as $texte) {
		echo '<b>'.$texte->login.'</b> : '.$texte->texte.'<br/>';
	}
}

?>