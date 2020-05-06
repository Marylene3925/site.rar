<?php
	
	//retourne true si ok, ou une chaine (le message d'erreur) si faux   //tester le retour == 1 et non == true ...
	//$fileName : nom de l'attribut name de la balise file du form
	
	//manque la gestion de : le fichier � upload� est obligatoire ou ne l'est pas
	
	function is_fileUploaded_ok ($fileName) {
		
		$msgErr = '';
		
		if (! isset($_FILES[$fileName]['error'])) { // fichier trop volumineux
			return 'La taille du fichier est plus grosse que la taille maximum autoris�e par php';
			//$msgErr = 'La taille du fichier est plus grosse que la taille maximum autoris�e par php';
		}		
		
		switch ($_FILES[$fileName]['error']) {
			 
			 case UPLOAD_ERR_INI_SIZE:
				$msgErr = 'La taille du fichier est plus grosse que la taille maximum autoris�e par php';
				break;
			
			 case UPLOAD_ERR_FORM_SIZE:
				$msgErr = 'La taille du fichier est plus grosse que la taille indiqu�e dans le formulaire';
				break;
			
			 case UPLOAD_ERR_PARTIAL:
				$msgErr = 'Le fichier n\'a �t� que partiellement t�l�charg�';
				break;
			
			 case UPLOAD_ERR_NO_FILE:
				//$msgErr = 'Aucun fichier n\'a �t� t�l�charg�';
				break;
			
			case UPLOAD_ERR_OK: //tout s'est bien pass� (doc php)
				if ($_FILES[$fileName]['size'] == 0) {
					$msgErr = 'Aucun fichier n\'a �t� t�l�charg�';
				}
				break;
		}
		
		return ($msgErr == '')?true:$msgErr;
		
	}

?>