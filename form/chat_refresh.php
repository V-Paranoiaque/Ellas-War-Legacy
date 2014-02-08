<?php

include('../header.php');

if(empty($_GET['clean'])) {
	$_GET['clean'] = 0;
}

$paquet = new EwPaquet();
$paquet -> add_action('refresh_chat', array($_GET['clean']));
$paquet -> send_actions();

$rep   = $paquet->get_answer('refresh_chat')->{1};
$moi   = 0;
$autre = 0;

if(!empty($rep)) {
	foreach($rep as $texte) {
		if($texte->joueur == $paquet->get_infoj('id')) {
			$moi++;
		}
		else {
			$autre++;
		}
		/*
		if(empty($texte->date)) {
			echo '<img src="/images/joueurs/signaler.png" 
		    	       alt="signaler" 
			           title="signaler" 
		        	   onclick="signaler_chat(\''.$texte->joueur.'\', \''.$texte->temps.'\');"
			           class="chat_signaler" />';
		}*/
		echo '<b>'.$texte->login.'</b> : '.$texte->texte;
		/*
		if($paquet->getlvl2() >= 2) {
			echo ' <img src="/images/joueurs/supprimer_mp.png" 
			            alt="Supprimer" 
			            title="Supprimer" 
			            class="chat_signaler"
			            onclick="supprimer_chat(\''.$texte->joueur.'\', \''.$texte->temps.'\');" />';
		}*/
		
		echo '<br/>';
	}
	
	if(empty($_GET['clean'])) {
		if($autre > 0) {
			echo '<script type="text/javascript">
			$("#cadre_chat_titre2").css("color", "red");
			</script>';
		}
		elseif($moi > 0) {
			echo '<script type="text/javascript">
			$("#cadre_chat_titre2").css("color", "black");
			</script>';
		}
	}	
}

?>