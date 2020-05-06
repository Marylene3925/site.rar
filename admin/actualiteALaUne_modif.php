<?php
	require_once("include/prepend.php");
	include_once ('./include/controleIdent.inc.php');
	
	
	$titrePage = "Modification de l'actualité";
	$nomPageSubmit = "actualiteALaUne_trait_modif.php";
	$table = "actualiteALaUne";
	$cheminImages = "../images/actualiteALaUne";
	$cheminPDF = "../pdf/actualiteALaUne";
	
	
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		die;
	}
	
	
	$cl_db = new cl_db_mysql;
	$cl_db->start();
	
	$cl_db->query("SELECT id, titre, descriptifRTF, bDefilement FROM $table  WHERE id = $id");
	
	
	if ($cl_db->num_rows() <= 0) { //pas d'enreg
		
		die;
	} else {
		$cl_db->next_record();
		
		
		//$titre = htmlspecialchars($cl_db->record['titre']);
		$descriptifRTF = htmlspecialchars($cl_db->record['descriptifRTF']);
		$bDefilement = ($cl_db->record['bDefilement'] == true) ? 'checked="checked"' : '';
		
		$id = $cl_db->record['id'];
		
	}
	
	
	
	
	
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Section d'administration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<link type="text/css" rel="stylesheet" href="./css/style.css" />
	<script type="text/javascript" src="./js/tableRowsBackgroundColor.js"></script>
	<script type="text/javascript" src="./js/redimIhmAdmin.js"></script>
	<script type="text/javascript" src="./tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="./js/tinyMCE_init.js"></script>
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
			
			
			
			
			

	<form  action="<?php echo $nomPageSubmit; ?>" method="post" enctype="multipart/form-data" onsubmit="return checkForm();">
		
		<table id="tableauFormulaire" class="liste" border="0" cellspacing="0" cellpadding="4">
			<tbody>
			
			
			<!--
			<tr>
				<td width="42%" align="right"><strong>Titre</strong></td>
				<td align="left"><input style="width:98%;" type="text" value="<?php echo $titre; ?>" id="titre" name="titre" maxlength="255" /></td>
			</tr>
			-->
			
			<tr>
				<td width="42%" align="right"><strong>Descriptif</strong></td>
				<td align="left"><textarea rows="20" style="width:98%;" id="descriptif" name="descriptif"><?php echo $descriptifRTF; ?></textarea></td>
			</tr>
			
			<tr>
				<td width="42%" align="right"><strong>Afficher l'actualité ?</strong></td>
				<td align="left"><input style="width:98%;" type="checkbox" id="bDefilement" name="bDefilement" <?php echo $bDefilement; ?>  /></td>
			</tr>
			
			
			
			
<?php	
			/*
			for ($i=1; $i<=1; $i++) {
?>
				<!--
				<tr>
					<td width="42%" align="right"><strong>Image<?php //echo " $i"; ?></strong> (au format .jpg)</td>
					<td align="left">

					
<?php					
						echo (file_exists("$cheminImages/min_" . $id . "_$i.jpg") ? "<img alt=\"\" src=\"$cheminImages/min_" . $id . "_$i.jpg\" />" :  '&nbsp;' ) ;
						$bImageExiste = file_exists("$cheminImages/min_" . $id . "_$i.jpg");
?>
						
						<br /><span><input type="radio" style="width:10px;" id="choixImage<?php echo $i; ?>_1" name="choixImage<?php echo $i; ?>" value="1" <?php echo ( ($bImageExiste)? 'checked="checked"' : '' ); ?> /><label for="choixImage<?php echo $i; ?>_1">Conserver l'image</label></span><br />
						<input type="radio" style="width:10px;" id="choixImage<?php echo $i; ?>_2" name="choixImage<?php echo $i; ?>" value="2" /><label for="choixImage<?php echo $i; ?>_2">Supprimer l'image</label><br />
						<input type="radio" style="width:10px;" id="choixImage<?php echo $i; ?>_3" name="choixImage<?php echo $i; ?>" value="3" <?php echo ( ($bImageExiste)? '' : 'checked="checked"' ); ?> /><label for="choixImage<?php echo $i; ?>_3">Nouvelle image : </label><input type="file" id="image<?php echo $i; ?>" name="image<?php echo $i; ?>" />

					</td>
				</tr>
				-->
<?php
			}
			*/
?>
	
	
	
	
			
			
			
			<tr>
				<td align="center" colspan="2"><input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
				<input type="submit" value="Valider" /></td>
			</tr>
			
			
			
			</tbody>
		</table>
		
		
	</form>
			
			
			
			
		</div>
		
		
		
		<?php include ('./include/footer.inc.php'); ?>
	</div>
</body>
</html>



	
