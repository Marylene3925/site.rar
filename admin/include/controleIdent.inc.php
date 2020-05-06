<?php
	
	
	if (! isset($_SESSION['identAdmin']) || $_SESSION['identAdmin'] != 'ok') {	
		
		header('Location: login.php');
		exit;
	} else {
		session_regenerate_id();
	}
	
	
?>