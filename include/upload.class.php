<?php


	class upload {



		//private $tabTypeFichier = array('image/pjpeg' => 'jpg', 'image/jpeg' => 'jpg', 'image/png' => 'png', 'image/x-png' => 'png', 'image/gif' => 'gif', 'application/pdf' => 'pdf'); //application/octetstream
		private $tabTypeFichier = array('application/msword' => 'doc', 'application/excel' => 'xls', 'application/vnd.ms-excel' => 'xls', 'application/x-excel' => 'xls', 'application/x-msexcel' => 'xls', 'application/pdf' => 'pdf'); //application/octetstream
		private $tailleMaxi = 2097152; //2Mo en octects

		private $cheminUpload;
		private $separateurChemins;




		public function __construct() {

			//global $cl_config;

			//$this->tailleMaxi = $cl_config->tailleMaxiUpload;
			$this->cheminUpload = realpath('./upload');;
			$this->separateurChemins = '/';
			if ($_SERVER["REMOTE_ADDR"] == '127.0.0.1') {
				$this->separateurChemins = '\\';
			}
		}




		/**
		 * upload::TraiteFichierUpload()
		 *
		 * Copie le fichier, en le renommant, dans le répertoire protégé d'upload
		 *
		 * @param mixed $nomFichier
		 * @param mixed $tabMsgErr
		 * @param mixed $prefixeSession
		 * @return
		 */
		public function TraiteFichierUpload ($nomFichier, &$tabMsgErr, $prefixeSession) {
			$extensionFichier = strtolower(pathinfo($_FILES[$nomFichier]['name'], PATHINFO_EXTENSION));
			$nomFichierOriginal = $_FILES[$nomFichier]['name'];
			$nomNouveauFichier = $this->GenererNomFichier() . ".$extensionFichier";
			$cheminFichier = $this->cheminUpload . $this->separateurChemins . $nomNouveauFichier;



			if (! move_uploaded_file($_FILES[$nomFichier]['tmp_name'],  $cheminFichier) ) {

				$tabMsgErr[$nomFichier] = "Le fichier n'a pas pu être traité.";

				$_SESSION[$prefixeSession . 'nomFichier'] = '';
				$_SESSION[$prefixeSession . 'nomFichierOriginal'] = '';
				$_SESSION[$prefixeSession . 'cheminFichier'] = '';
				$_SESSION[$prefixeSession . 'extensionFichier'] = '';
				unset($_SESSION[$prefixeSession . 'nomFichierOriginal']);
				unset($_SESSION[$prefixeSession . 'nomFichier']);
				unset($_SESSION[$prefixeSession . 'cheminFichier']);
				unset($_SESSION[$prefixeSession . 'extensionFichier']);

			} else {

				$_SESSION[$prefixeSession . 'nomFichierOriginal'] = $nomFichierOriginal;
				$_SESSION[$prefixeSession . 'nomFichier'] = $nomNouveauFichier;
				$_SESSION[$prefixeSession . 'cheminFichier'] = $cheminFichier;
				$_SESSION[$prefixeSession . 'extensionFichier'] = $extensionFichier;
			}
		}




		/**
		 * upload::VerifierFichierUpload()
		 *
		 * Controle que le fichier a bien été uploadé
		 *
		 * @param mixed $nomFichier
		 * @param mixed $tabMsgErr
		 * @return
		 */
		public function VerifierFichierUpload ($nomFichier, &$tabMsgErr) {



			if (! isset($_FILES[$nomFichier]) ) {

				$tabMsgErr[$nomFichier] = "Le fichier n'a pas été uploadé.";
				return false;
			}


			//on controle si php a renvoyé une erreur
			if (! $this->TraiteMessageErreurPhp($nomFichier, $tabMsgErr) ) {

				return false;
			}


			//on controle à nouveau la taille du fichier
			if ( $_FILES[$nomFichier]['size'] > $this->tailleMaxi ) {

				$tabMsgErr[$nomFichier] = "Le poids du fichier ne peut pas accéder 2Mo.";
				return false;
			}

			//on controle si le fichier a bien été uploadé
			if (! is_uploaded_file($_FILES[$nomFichier]['tmp_name']) ) {
				$tabMsgErr[$nomFichier] = "Une erreur est survenue lors de l'upload de votre fichier.";
				return false;
			}

			//on controle le type et l'extension du fichier
			$extensionFichier = strtolower(pathinfo($_FILES[$nomFichier]['name'], PATHINFO_EXTENSION));
			$typeMimeFichier = $_FILES[$nomFichier]['type'];
			
			if ($extensionFichier != 'ppt' &&  $extensionFichier != 'doc' &&  $extensionFichier != 'xls' && $extensionFichier != 'pdf' && $extensionFichier != 'docx' && $extensionFichier != 'xlsx'  ) { //si extension non autorisée
				$tabMsgErr[$nomFichier] = "Le fichier doit être de type DOC, XLS, PPT ou PDF.";
				return false;
			}
			
			/*if (! array_key_exists($typeMimeFichier, $this->tabTypeFichier) || $extensionFichier != $this->tabTypeFichier[$typeMimeFichier] ) { //si je ne trouve pas le type mime du fichier ou que l'extension ne correspond pas au type mime
				$tabMsgErr[$nomFichier] = "Le fichier doit être de type DOC, XLS ou PDF.";
				return false;
			}*/


			return true;
		}



		private function GenererNomFichier () {
			return date('Ymd') . '_' . str_shuffle(strval( (int) microtime(true) )) . '_'.  mt_rand(1, 99999999);
		}




		private function TraiteMessageErreurPhp ($nomFichier, &$tabMsgErr) {

			$msgErr = '';



			switch ($_FILES[$nomFichier]['error']) {

				case UPLOAD_ERR_INI_SIZE:
					$msgErr = 'La taille du fichier est plus grosse que la taille maximum autorisée par php';
					$msgErr = 'Le poids du fichier ne peut pas accéder 2 Mo';
					break;

				case UPLOAD_ERR_FORM_SIZE:
					$msgErr = 'La taille du fichier est plus grosse que la taille indiquée dans le formulaire';
					$msgErr = 'Le poids du fichier ne peut pas accéder 2 Mo.';
					break;

				case UPLOAD_ERR_PARTIAL:
					$msgErr = 'Le fichier n\'a été que partiellement téléchargé';
					break;

				case UPLOAD_ERR_NO_FILE:
					$msgErr = 'Aucun fichier n\'a été téléchargé';
					break;

				case UPLOAD_ERR_OK: //tout s'est bien passé (doc php)
//					if ($_FILES[$nomFichier]['size'] == 0) {
//						$msgErr = 'Aucun fichier n\'a été téléchargé';
//					}
					break;
			}

			if ( $msgErr != '' ) {
				$tabMsgErr[$nomFichier] = $msgErr;
			}

			return ($msgErr == '');

		}


	}
?>