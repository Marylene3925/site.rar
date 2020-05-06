<?php
	require_once("include/prepend.php");
	$cheminImages = "../images/actualiteALaUne";
	$nomPageRedirection = "actualiteALaUne_liste.php";
	$table = "actualiteALaUne";
	$cheminPDF = "../pdf/actualiteALaUne";
	

	

	$cl_db = new cl_db_mysql;
	$cl_db->start();
	
	$id = $_POST['id'];
	
	
	/*
	//gestion image
	for ($i=1; $i<=1; $i++) {
		
		
		if ( isset($_POST["choixImage$i"]) ) {
			
			
			switch ($_POST["choixImage$i"]) {
				
				
				case '1': //conserver l'image, on fait rien
					
					break;
				
				case '2': //supprimer l'image
					
					@unlink("$cheminImages/$id" . "_$i.jpg");
					@unlink("$cheminImages/min_$id" . "_$i.jpg");
					
					break;
				
				
				case '3': //nouvelle image : on traite l'upload
				
					$tmp = is_fileUploaded_ok("image$i"); //1 si ok, msg d'erreur si ko
					if ($tmp != 1) { die ($tmp); } //affichage message erreur
					
					if ($_FILES["image$i"]['type'] != 'image/jpeg' && $_FILES["image$i"]['type'] != 'image/pjpeg' && $_FILES["image$i"]['type'] != '') { //image uploadée différente de .jpg
						die ("L'image doit être au format jpg" . "<br>" . $_FILES["image$i"]['type']); 
					}
					if ($_FILES["image$i"]['type'] != '') { //image uploadée, on la traite !
						
						$path = './tmp/tmp.jpg';
						move_uploaded_file ($_FILES["image$i"]['tmp_name'], $path);
						//on donne les droits pour la nouvelle image
						$gd = new gd;
						$width = TAILLE_IMAGE_POPUP_X;
						$height = TAILLE_IMAGE_POPUP_Y;
						$minWidth = TAILLE_IMAGE_MINIAT_X;
						$minHeight = TAILLE_IMAGE_MINIAT_Y;
						
						
						//détection des portraits
						$tabSizeInfo = GetImageSize($path);  
						$image_width = $tabSizeInfo[0]; 
						$image_height = $tabSizeInfo[1];
						
						if ($image_height > $image_width) {//image portrait
							$width = TAILLE_IMAGE_POPUP_Y;
							$height = TAILLE_IMAGE_POPUP_X;
							$minWidth = TAILLE_IMAGE_MINIAT_Y;
							$minHeight = TAILLE_IMAGE_MINIAT_X;
							
							
						}
						
						$width = 375;
						$height = 175;
						$minWidth = 375;
						$minHeight = 175;
						
						$gd->RedimImage ($path, "$cheminImages/min_$id" . "_$i.jpg", $minWidth, $minHeight);
						$gd->RedimImage ($path, "$cheminImages/$id" . "_$i.jpg", $width, $height);
					}
					
					
					break;
			}
		}
	}
	*/
	
	
	
	
	
	
	
	
	//Ajout du formulaire
	
	
	$descriptifRTF = $cl_db->escape_string($_POST['descriptif']);
	$descriptifTexte = $cl_db->escape_string($_POST['descriptif']);
	$descriptifTexte = str_replace('&nbsp;', ' ', $descriptifTexte);
	$descriptifTexte = str_replace('<br />', ' ', $descriptifTexte);
	$descriptifTexte = strip_tags($descriptifTexte); //on vire la mise en page. Equivalent à : preg_replace("/(<\/?)(\w+)([^>]*>)/", '', $chaine);
	
	
	$bDefilement = (isset($_POST['bDefilement']) && $_POST['bDefilement'] == 'on') ? 1 : 0 ;
	
	
	
	$sql = sprintf("UPDATE $table SET descriptifTexte = '%s', descriptifRTF = '%s' , bDefilement = %d
										WHERE id = $id", 
					
					
					$descriptifTexte,
					$descriptifRTF,
					$bDefilement
	
	);
	
	
	
	
	$cl_db->query($sql);
	

	header("Location: $nomPageRedirection");

?>