<?php
	
	require_once ('include/prepend.php');
	
	include_once ('./include/controleIdent.inc.php');
	
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
			<p style="margin-top: 0; padding-top: 0;"><strong>Bienvenue dans votre interface d'administration.</strong></p>
			
			
			
			
		</div>
		
		
		
		<!-- Footer -->
		<?php include ('include/footer.inc.php'); ?>

	</div>
</body>
</html>
