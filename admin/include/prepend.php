<?php
	//Gestion des erreurs stricte
	//error_reporting(E_ALL);
	
	//session_start();
	
	//Classe d'abstraction à MySql
	include('../include/db.class.php');
	include ('./include/upload.inc.php');
	// include ('./include/gd.class.php');

	
	//Définition des constantes
	if ($_SERVER["REMOTE_ADDR"] == '127.0.0.1' || $_SERVER["REMOTE_ADDR"] == '::1') {
		define ('SITE_ADMIN_ROOT', 'http://localhost/test/admin/');
	}
	
	define ('TAILLE_IMAGE_POPUP_X', 640);
	define ('TAILLE_IMAGE_POPUP_Y', 480);
	define ('TAILLE_IMAGE_MINIAT_X', 160);
	define ('TAILLE_IMAGE_MINIAT_Y', 120);
	
	
	define('LIGNE_PAR_PAGE', 30);				//Barre de pagination : nombre de lignes (bdd) à afficher par page (pour l'ensemble des rubriques)
	
	define ('CHARSET', 'ISO-8859-15');
	
	
	
	define ('MAIL_WEBMASTER', '');
	
	
	
	
	//On vérifie si l'utilisateur est bien logué
	$prepend_nomScriptEnCours = substr ($_SERVER['SCRIPT_NAME'], strrpos ($_SERVER['SCRIPT_NAME'], '/') + 1 );
	
	if ( $prepend_nomScriptEnCours != 'login.php' && $prepend_nomScriptEnCours != 'login_trait_identification.php' && $prepend_nomScriptEnCours != 'loginDeconnexion.php' ) {
		require_once ('./include/controleIdent.inc.php');
	}

	
?>