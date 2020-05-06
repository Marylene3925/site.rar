<?php
	require_once("include/prepend.php");
	include_once ('./include/controleIdent.inc.php');
	
	$titrePage = "Liste de l'actualité à la une";
	$sPageSuppression = "./actualiteALaUne_trait_suppression.php";
	$sPageModif = "./actualiteALaUne_modif.php";
	$table = "actualiteALaUne";
	$nomPage = 'actualiteALaUne_liste.php';
	$cheminPDF = "../pdf/actualiteALaUne";
	$cheminImages = "../images/actualiteALaUne";
	$sMessageSuppresion = 'Confirmez-vous la suppression de cette actualité ?';
	
	
	//BARRE DE PAGINATION
	$sql_navig = "SELECT $table.id as id, $table.titre as titre, $table.descriptifTexte as descriptifTexte
						
					FROM $table
					
					ORDER BY $table.id DESC"; 
	
	//include ('../include/pagination.inc.php');
	
	
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Section d'administration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<link type="text/css" rel="stylesheet" href="./css/style.css" />
	<script type="text/javascript" src="./js/tableRowsBackgroundColor.js"></script>
	<script type="text/javascript" src="./js/redimIhmAdmin.js"></script>
	<script type="text/javascript" src="./js/launcherOnLoad.js"></script>
</head>

<body>

	<div id="page">
		
		<!-- Présentation : coins arrondis (corners) -->
		<div id="header">

			<img id="left_corner" src="./images/left_corner.gif" alt="" />
			<img id="right_corner" src="./images/right_corner.gif" alt="" />
			<h1>Section d'administration</h1>
		</div>
		
		
		
		<div id="menu">
			
			<?php include ("./include/menu.inc.php"); ?>
			
		</div>
		
		
		
		<div id="contenu">
			<h2><?php echo $titrePage; ?></h2>
			
<?php

	
			
			
			
			$cl_db = new cl_db_mysql;
			$cl_db->start();
			
			//$cl_db->query("SELECT id, DATE_FORMAT(date,'%d/%m/%Y') as date, titre, descriptifTexte FROM $table ORDER BY id DESC");
			$cl_db->query($sql_navig);
			
			
			
			
			if ($cl_db->num_rows() == 0) {
				
				echo "Aucun Enregistrement !";
				
			} else {
				
				$sqlListe = '<table id="tableauFormulaire" class="liste" cellspacing="0" cellpadding="4">
								<thead>
									<tr>
										
										
										<th>Descriptif</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
								';
				
				while ($cl_db->next_record()) {
					
					
					$id = $cl_db->record['id'];
					
					
					$sqlListe .= '<tr>';
					
					/*
					for ($i=1; $i<=1; $i++) {
						$sqlListe .= '<td>' . ( (file_exists("$cheminImages/min_" . $id . "_$i.jpg")) ? "<img alt=\"\" src=\"$cheminImages/min_" . $id . "_$i.jpg\" />" :  '&nbsp;' ) . '</td>';
					}
					*/
					
					//$sqlListe .= '<td>' . (($cl_db->record['titre'] == '')? '&nbsp;' : htmlspecialchars($cl_db->record['titre'])) . '</td>';

					
					
					require_once('../include/pbCaractereHtml.php');
					$descriptifTexte = $cl_db->record['descriptifTexte'];
					$descriptifTexte = substr($descriptifTexte, 0, 100);
					$descriptifTexte = SupprimeDernierCaractereHtml($descriptifTexte);
					if (strlen($cl_db->record['descriptifTexte']) > 100) {
						$descriptifTexte .= '...';
					}
					$sqlListe .= '<td>' . (($descriptifTexte == '')? '&nbsp;' : $descriptifTexte) . '</td>';
					
					
					
				
					
					
					//$sqlListe .= '<td>' . "<a class=\"command\" onclick='javascript: return confirm(\"Confirmez-vous la suppression de cette actualité ?\");' href=\"$sPageSuppression?id=" . $cl_db->record['id'] . '">Supprimer</a>' . " - <a class=\"command\" href=\"$sPageModif?id=" . $cl_db->record['id'] . '">Modifier</a>' . '</td>';
					
					$sqlListe .= '<td style="width:120px;">' . 
									 
									"<a class=\"command\" href=\"$sPageModif?id=" . $cl_db->record['id'] . '"><img src="images/action_modifier.png" alt="Modifier" title="Modifier" /></a>' .
									
									
								'</td>';
								
					
					$sqlListe .= '</tr>';
					
					
				}
				
				$sqlListe .= '</tbody></table>';
				
				echo $sqlListe;
				
				
				//Barre de pagination
				//echo $html_navig;
				//echo $infoPage;
			}








?>

			
		</div>
		
		
		
		<?php include ('./include/footer.inc.php'); ?>
	</div>
</body>
</html>





