<?php
	
	require_once ('include/prepend.php');
	
	//on tue les variables sessions de login
	$_SESSION['identAdmin'] = '';
	unset($_SESSION['identAdmin']);

	
	header('Location: ' . SITE_ADMIN_ROOT);
	
?>