<?php
	
	//require_once ('include/prepend.php');
	
	// $cl_db = new cl_db_mysql;
	// $cl_db->start();

	// $sql = "SELECT descriptif1, descriptif2 FROM tbl_index_$lang";
	//$cl_db->query($sql);
	//$cl_db->next_record();
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="fr" xml:lang="fr" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Section d'administration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<link type="text/css" rel="stylesheet" href="./css/style.css" />
	<style type="text/css">
		/* Le contenu (colonne droite)  */
		div#page div#contenu {
			margin-left: 0px; /* pour compenser l'absence du menu sur cette page uniquement */
			margin-right: 0px;
			height: 100px;
		}
		
	</style>
</head>

<body>

	<div id="page">
		
		<!-- Présentation : coins arrondis (corners) -->
		<div id="header">

			<img id="left_corner" src="./images/left_corner.gif" alt="" />
			<img id="right_corner" src="./images/right_corner.gif" alt="" />
			<h1>Accès à la Section d'administration</h1>
		</div>
		
		
	
		
		
		<div id="contenu" style="width:100%; text-align:center;">
			
			<form action="login_trait_identification.php" method="post">
				
				<table align="center">
					<tr>
						<td align="right">Login : </td>
						<td><input type="text" name="login" id="login" style="width: 180px;" /></td>
					</tr>
					<tr>
						<td align="right">Mot de Passe : </td>
						<td><input type="password" name="mdp" id="mdp" style="width: 180px;" /></td>
						<td><input type="submit" value="Se Loguer" /></td>
					</tr>
				</table>
				
			</form>
		</div>
		
		
		
		<div class="spacer">&nbsp;</div>
		
		<div id="footer" style="margin:0; padding:0;" >
			<p style="color:#333; font-size:0.9em; font-weight:normal; text-align:center; margin:0; padding:5px;">© 2009-<?php echo date('Y'); ?> <strong>WEBGROUP</strong></p>
		</div>
	</div>
</body>
</html>
