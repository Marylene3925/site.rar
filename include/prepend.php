<?php
	
	
	//Gestion des erreurs stricte
	//error_reporting(E_ALL);

	
	//Classe d'abstraction à MySql
	require_once ('db.class.php');

	
	
	
	//Définition des constantes
	if ($_SERVER["REMOTE_ADDR"] == '127.0.0.1' || $_SERVER["REMOTE_ADDR"] == '::1') {
		define ('SITE_ROOT', 'http://localhost/test/'); //Chemin root (page index du site)
	}
	
	
	
	define('LIGNE_PAR_PAGE', 6);	//Barre de pagination : nombre de lignes (bdd) à afficher par page
	define('LIGNE_PAR_PAGE_ARTICLE', 20);
	
	
	
	
	
	
	//Fonctions utilitaires
	require_once ('pbCaractereHtml.php'); //dans les listes d'articles, pour pouvoir tronquer proproment les chaines RTF provenant de tiny mce
	
	
	
	date_default_timezone_set('Europe/Paris');
	setlocale(LC_ALL, 'fr_FR');
	
	class DateTimeFrench extends DateTime {
		public function format($format) {
			$english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
			$french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
			$english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
			$french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
			$english_months_abrv = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
			$french_months_abrv = array('Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc');
			return str_replace($english_months_abrv, $french_months_abrv, str_replace($english_days, $french_days, str_replace($english_months, $french_months, parent::format($format))));
		}
	}
	
	
	
	
	
?>