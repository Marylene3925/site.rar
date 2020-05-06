<?php
	
	//retourne true si ok, ou une chaine (le message d'erreur) si faux   //tester le retour == 1 et non == true ...
	//$fileName : nom de l'attribut name de la balise file du form
	
	//manque la gestion de : le fichier à uploadé est obligatoire ou ne l'est pas
	
	function is_fileUploaded_ok ($fileName) {
		
		$msgErr = '';
		
		if (! isset($_FILES[$fileName]['error'])) { // fichier trop volumineux
			return 'La taille du fichier est plus grosse que la taille maximum autorisée par php';
			//$msgErr = 'La taille du fichier est plus grosse que la taille maximum autorisée par php';
		}		
		
		switch ($_FILES[$fileName]['error']) {
			 
			 case UPLOAD_ERR_INI_SIZE:
				$msgErr = 'La taille du fichier est plus grosse que la taille maximum autorisée par php';
				break;
			
			 case UPLOAD_ERR_FORM_SIZE:
				$msgErr = 'La taille du fichier est plus grosse que la taille indiquée dans le formulaire';
				break;
			
			 case UPLOAD_ERR_PARTIAL:
				$msgErr = 'Le fichier n\'a été que partiellement téléchargé';
				break;
			
			 case UPLOAD_ERR_NO_FILE:
				//$msgErr = 'Aucun fichier n\'a été téléchargé';
				break;
			
			case UPLOAD_ERR_OK: //tout s'est bien passé (doc php)
				if ($_FILES[$fileName]['size'] == 0) {
					$msgErr = 'Aucun fichier n\'a été téléchargé';
				}
				break;
		}
		
		return ($msgErr == '')?true:$msgErr;
		
	}

?>