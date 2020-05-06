<?php
	
	//anti spam
	if ( ! isset($_POST['email2']) || $_POST['email2'] != '') {
		die;
	}
	
	
	
	$tabRetour = array('error' => false);
	
	if (! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') { //si ajax
	
		
		
		$cl_db = new cl_db_mysql;
		$cl_db->start();
		
		$nom = trim($_POST['nom']);
		// $prenom = trim($_POST['prenom']);
		//$agence = trim($_POST['agence']);
		
		$email = trim($_POST['email']);
		$telephone = trim($_POST['telephone']);
		$message = trim($_POST['message']);
		$rgpd = trim($_POST['rgpd']);
		
		
		if ($nom == "") {
			$tabRetour['error'] = true;
			$tabRetour['errorCode'] = 1;
			$tabRetour['errorFields'][] = 'mailnom';
		}
		// if ($prenom == "") {
			// $tabRetour['error'] = true;
			// $tabRetour['errorCode'] = 1;
			// $tabRetour['errorFields'][] = 'mailprenom';
		// }
		// if ($agence == "-1") {
			// $tabRetour['error'] = true;
			// $tabRetour['errorCode'] = 1;
			// $tabRetour['errorFields'][] = 'mailagence';
		// }
		if ($email == "") {
			$tabRetour['error'] = true;
			$tabRetour['errorCode'] = 1;
			$tabRetour['errorFields'][] = 'mailemail';
		}
		if ($telephone == "") {
			$tabRetour['error'] = true;
			$tabRetour['errorCode'] = 1;
			$tabRetour['errorFields'][] = 'mailtel';
		}
		if ($message == "") {
			$tabRetour['error'] = true;
			$tabRetour['errorCode'] = 1;
			$tabRetour['errorFields'][] = 'mailmessage';
		}
		

		if ($tabRetour['error'] == false) {  //si pas erreur
			
			if ( filter_var($email, FILTER_VALIDATE_EMAIL) === false ) {
			
				$tabRetour['error'] = true;
				$tabRetour['errorCode'] = 2;
				$tabRetour['errorFields'][] = 'mailemail';
			} else {
					
				if ( $rgpd == 0 ) {
			
					$tabRetour['error'] = true;
					$tabRetour['errorCode'] = 3;
					$tabRetour['errorFields'][] = 'label_rgpd';
				}
			}
		}
		
		
		//enregistrement bdd + envois de mails
		if ($tabRetour['error'] == false) {  //si pas erreur
			
				
			$cl_db->query("INSERT INTO demande SET 
										date_demande = now(),
										email = '" . $cl_db->escape_string(utf8_decode($email)) . "', 
										nom = '" . $cl_db->escape_string(utf8_decode($nom)) . "', 
										message = '" . $cl_db->escape_string(utf8_decode($message)) . "', 
										bRGPD = '" . $cl_db->escape_string(utf8_decode($rgpd)) . "', 
										telephone = '" . $cl_db->escape_string(utf8_decode($telephone)) . "'"
			
			);
			
			
			$headers = 'From: ' . 'info@web-chasseur.fr' . "\r\n" .
				 "Content-Type: text/plain; charset=utf-8";
	
	
			
			$messageMail = "Nouvelle demande de contact : \n\n
Nom : $nom\n
Email : $email\n
Téléphone : $telephone\n
Message : $message\n
				";

			
			//mail à l'admin
			mail('info@web-chasseur.fr', "Cabinet Medon : demande de contact", $messageMail, $headers);
			
			
			
			
			//mail à l'internaute
			$messageMail = "Bonjour,\nVotre demande a été envoyée avec succès. Nous allons vous recontacter dans les plus brefs délais. Merci de votre confiance.\n\nEn soumettant ce formulaire, j'accepte que les informations saisies soient exploitées dans le cadre de la demande de devis et de la relation commerciale qui peuvent en découler.";
			mail($email, "Cabinet Medon : demande de contact", $messageMail, $headers);
		}
	

		
		//Envoi des données
		header('Content-type: application/json;');
		echo json_encode($tabRetour);
	}

?>