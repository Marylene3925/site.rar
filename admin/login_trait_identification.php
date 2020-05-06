<?php
	
	require_once ('include/prepend.php');
	

	if (isset($_POST['login']) && isset($_POST['mdp']) ) {
		
		 
		
		$cl_db = new cl_db_mysql;
		$cl_db->start();

		
		$login = $cl_db->escape_string($_POST['login']);
		$mdp = md5($cl_db->escape_string($_POST['mdp']));
		
		$sql = "SELECT * FROM utilisateur WHERE login = '$login' AND mdp = '$mdp'";
		$cl_db->query($sql);
		$cl_db->next_record();
	
		if ($cl_db->num_rows() > 0) {
			
			//on logue l'utilisateur
			$_SESSION['identAdmin'] = 'ok';
			$_SESSION['droits'] = $cl_db->record['droits'];
			
			
		} else {
			
			//on tue les variables sessions de login
			$_SESSION['identAdmin'] = '';
			unset($_SESSION['identAdmin']);
		}
		
	}
	
	header('Location: ' . SITE_ADMIN_ROOT);
?>