<?php
	
	//Traite une chaine RTF (par exemple provenant d'un tinyMCE)
	//Quand on veut tronquer la chaine RTF  à x caractères, il peut arriver qu'on tronque la chaine sur un caractère html (&agrave;)
	//Ce qui provoque des erreurs xhtml !
	//Cette fonction reçoit la chaine tronquée, examine si le dernier caractère est de type html, si oui elle le supprime proprement
	function SupprimeDernierCaractereHtml ($sChaine) {
		
		$nbCaractereAnalyse = 12; //on analyse les derniers caractères de la chaine
		$nLongueurChaine = strlen($sChaine);
		$sRetour = $sChaine;
		
		
		$nPosition = strrpos($sChaine, '&');
		if ( $nPosition !== false) {
			
			if ( $nPosition > $nLongueurChaine - $nbCaractereAnalyse) { //si un caractère spécial trouvé dans les 10 derniers caractères
			
				$sRetour = substr($sChaine, 0, $nPosition);
			}
		}
		
		return $sRetour;
	}
	
	
	
	
	
	
	
	
	
	
?>