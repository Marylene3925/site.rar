<?php
	
	/*		Création d'un barre de pagination basique de ty pe (Préc - 1 - 2 - 3 - Suiv)
	*		version 0.2
	*
	*		Nécessite : 3 variables php pour fonctionner : $sql_navig , $table , $nomPage
	*				l'inclusion de la classe d'abstraction pour MySql : db.class.php
	*				1 Constante : LIGNE_PAR_PAGE
	*				facultatif (gestion d'une clé étrangère ex: table de categorie) : $clauseWhere et $IDclauseWhere
	*
	*		Utilisation : inclure ce fichier puis utiliser les variables suivantes :
	*		- $html_navig : contient le code html de la barre de pagination
	*		- $infoPage : contient l'info pageEnCours / NbPageMax. Ex: "4/9" 
	*
	*
	*		Pour styler la barre :
	*/
			// /* Les barres de navigation */
			// div.navig {
				// border: 1px solid #ff1693; /* rose */
				// margin-top: 10px;
			// }
			// div.navig ul {
				// list-style-type: none;
				// margin:0; padding:0;
			// }
			// div.navig ul li {
				// display: inline;
			// }
			// /* Barres de navigation : liens */
			// div.navig ul li a {
				// color : #ff1693; /* rose */ 
				// text-decoration: none; 
				// font-weight: normal;
				// font-style: normal;
			// }
			// div.navig ul li a:link, div.navig ul li a:visited {
				
			// }
			// div.navig ul li a:hover, div.navig ul li a:active {
			// }
			// /* Barres de navigation : page en cours  */
			// div.navig ul li span {
				// color: #fff;
				// background-color: #ff1693; /* rose */
				// font-weight: bold;
			// }
	
	
	
	
	

	//pas touche
	$nbEnreg = 0;		//nombre d'enregistrements total dans la bd
	$nbPage = 0;		//nombre de pages total à afficher
	$offset = 0;		//clause 'limit offset nbLigne' de la requête
	$html_navig = ''; 	//code html contenant la barre de nabigation
	$infoPage = ''; 	//libellé de type :  Pages : 1 sur 6
	$pageUrl = 0;		//on récupère le param 'a' de l'url
	$sParamUrlFK = "";  //gestion d'une cléf étrangère (ex; table mère de catégorie)

	//on récupère le nombre total d'enregistrement à paginer

	$cl_db = new cl_db_mysql;
	$cl_db->start();
	$sql = "Select count(*) as nb From $table";
	if (isset($clauseWhere) && isset($IDclauseWhere)) {
		$sql .= " $clauseWhere ";
		$sParamUrlFK = "&amp;c=$IDclauseWhere";
	}
	$cl_db->query($sql);
	$cl_db->next_record();
	$nbEnreg = $cl_db->record['nb'];
	////////////////////////////////////////////////////////////////////////////$nbPhoto = $nbEnreg; //on récupère cette info pour la suite du script

	//on calcule le nombre de pages
	$nbPage = ceil ($nbEnreg / LIGNE_PAR_PAGE);

	//on génère la barre de navigation


	//vérif du param url
	if (! isset($_GET['a'])) { //1er chargement de page
		$pageUrl = 1;
		
	} else {					//Nième chargement de page
		$pageUrl = $_GET['a'];
		if (! preg_match("/^[0-9]*$/", $pageUrl) || $pageUrl <= 0) {
			die ('Paramètre incorrect');
		}
	}

	if ($pageUrl > $nbPage) { //si l'admin a fait des suppressions durant la navigation d'un internaute
		$pageUrl = $nbPage;
	}


	$html_navig .= "<div class=\"navig\">\n\t<ul>\n";
		
		
	//lien précédant
	if ($pageUrl >= 2) {
		$html_navig .= "<li><a href=\"$nomPage?a=" . ($pageUrl-1) . $sParamUrlFK . '">Pr&eacute;c</a> - </li>';

	}


	//lien des pages (1, 2, 3 ...)
	if ($pageUrl > 0) {
		
		
		if ($nbPage == 1) { //si on a qu'une page, on affiche qu'un seul lien sans séparateur de lien
			$html_navig .= "\t<li><span>1</span></li>\n";
		} else {
			for ($i=1; $i<=$nbPage; $i++) {
				
				$separateur = ($i != $nbPage)?' - ':'';
								
				if ($i == $pageUrl) {
					$html_navig .= "\t<li><span>$i</span>$separateur</li>\n";
				} else {
					$html_navig .= "\t<li><a href=\"$nomPage?a=$i" . $sParamUrlFK . "\">$i</a>$separateur</li>\n";
				}
			}
		}
	}


	//lien suivant
	if ($pageUrl < $nbPage) {
		$html_navig .= "<li> - <a href=\"$nomPage?a=" . ($pageUrl+1). $sParamUrlFK . '">Suiv</a></li>';
	}


	//On cloture la liste de liens
	$html_navig .= "</ul>\n</div>\n";	

	//libellé d'infos
	$infoPage = "$pageUrl/$nbPage";


	//on intègre la clause limit
	$offset = LIGNE_PAR_PAGE * $pageUrl - LIGNE_PAR_PAGE;
	$offset = ($offset < 0)?0:$offset;
	$sql_navig .= " limit $offset, " . LIGNE_PAR_PAGE;
	
	
?>