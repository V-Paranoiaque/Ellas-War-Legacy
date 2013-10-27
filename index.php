<?php

include('config.php');
include('function.php');
include('class_ewpaquet.php');

session_start();
set_lang();

/*
$my_name = 'tyty';

printf(_("My name is %s.\n"), $my_name);
*/

include('autorise/pubautorise.php');

if(!empty($_GET['page']) && preg_match("/^[a-zA-Z0-9_]+$/", $_GET['page'])) {
	$page = $_GET['page'];
}

echo '<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />';
		
$paquet =  new EwPaquet();

if(empty($page)) {
	$page = 'home';
}

include('header/'.$page.'.php');

$paquet -> send_actions();

switch($paquet->get_infoj('statu')) {
	case 1:
		include('autorise/priveautorise.php');
		$prefix = 'co';
	break;
	case 0:
		include('autorise/pubautorise.php');
		$prefix = 'deco';
	break;
}

if(!empty($_GET['page'])) {
	$page = ($_GET['page']);
	if(!in_array($page,$autorise)) {
		$page = $autorise[0];
	}
}
else {
	$page = $autorise[0];
}

echo '<link rel="stylesheet" href="css/design_'.$prefix.'.css" />';
/*echo '<!–[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]–>';*/

echo '<script type="text/javascript" src="js/jquery.min.js" ></script>';
echo '<script type="text/javascript" src="js/scripts.js" ></script>';

echo '<link rel="shortcut icon" type="image/png" href="favicon.ico" />
		<meta name="google-site-verification" 
	        content="'.GOOGLE_CHECK.'" />
		<meta name="ROBOTS" content="INDEX, FOLLOW"/>
		<meta name="author" content="Mighty" />
	</head>
  <body>';

include('body/haut_'.$prefix.'.php');

include('include/'.$page.'.php');

include('body/bas_'.$prefix.'.php');

echo '<footer>';

include('body/footer_'.$prefix.'.php');

echo '</footer>
  </body>
</html>';

?>