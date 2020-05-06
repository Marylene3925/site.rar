<?php
	
	
	
	function pageEnCours ($sPrefixePage) {
		
		$tab_pagesPossibles = array();
		
		$tab_pagesPossibles[] = $sPrefixePage . '_liste.php';
		$tab_pagesPossibles[] = $sPrefixePage . '_modif.php';
		$tab_pagesPossibles[] = $sPrefixePage . '_ajout.php';
		
		$s = '/' . $_SERVER['SCRIPT_NAME'];
		$s = substr($s, strrpos($s, '/') + 1);
		
		return in_array($s, $tab_pagesPossibles);
	}
	
	$sStylePageEnCours = 'style="background-color: #cbf0ff;"';
	
?>


<?php 
	if ($_SESSION['droits'] == 1) {  //admin : tous les menus sont visibles

?>



	
	<h1 class="h1menu" style="margin-top:0; padding-top:0;">Menu</h1>

	
	
<?php 
	$sPrefixePage = 'actualiteALaUne';
	$classMenuEnCours = (pageEnCours($sPrefixePage))? $sStylePageEnCours : '' ;
?>
	
	<p <?php echo $classMenuEnCours; ?> class="menuTitres">Actualité à la une</p>
	<ul style="margin: 5px 0 0 25px; padding:0;">
		
		<li><a class="menu" href="<?php echo $sPrefixePage; ?>_liste.php">Lister</a></li>
	</ul>
	

	
		
		
<?php 
	} elseif ($droits == 2) {  
?>
	

	
	
<?php 
	}
?>

