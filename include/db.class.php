<?php

/**
*	
*	Driver MySQLi
*
*/

class cl_db_mysql {
	
	protected static $_instance = null;

	private $class_name = "cl_db_mysql";

	public $user = "";
	public $password = "";
	public $host = "";
	public $database = "";

	private $auto_free = 0;			// 1 = mysql_free_result automatique | 0 mysql_free_result manuel



	// Ne rien modifier
	private $mysql_link;
	private $query_id = 0;
	public $record = array();
	
	

	/**
	* @desc Constructeur
	* @param void
	* @return void
	*/
	
	public function start() {
		
		if ($_SERVER["REMOTE_ADDR"] == '127.0.0.1' || $_SERVER["REMOTE_ADDR"] == '::1') { 			// CONFIG LOCAL
			$this->user = "root";
			$this->password = "";
			$this->host = "localhost:3308";
			$this->database = "WebGroup_test";
			$this->auto_free = 0;
		}
		
		$this->mysql_link = mysqli_connect($this->host, $this->user, $this->password, $this->database);
		if ( ! $this->mysql_link) {
			die('Erreur de connexion (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
		}
	}
	
	
	
	
	
	
	/**
	 * cl_db_mysql::getInstance()
	 * @desc Impl�mentation du motif Singleton
	 * $db = cl_db_mysql::getInstance();
	 * @return
	*/
	/*
	public static function getInstance() {

		if (is_null(self::$_instance)) {
			self::$_instance = new self;
			return self::$_instance;
		}
	}
	*/
	
		
	/**
	* @desc public : envoie une requ�te sql � la base de donn�es
	* @param string [Requete sql]
	* @return query_id ou rien du tout
	*/
	public function query($sql) {
		$this->query_id = mysqli_query($this->mysql_link, $sql);
		
		// Erreur dans la requ�te
		if (!$this->query_id) {
			die("Erreur : " . mysqli_error($this->mysql_link));
			
    	}
    	
    	return $this->query_id;
	}
	
	/**
	* @desc Retourne le dernier ID g�n�r� par mysql
	* @param void
	* @return int
	*/
	public function lastInsertId() {
		return mysqli_insert_id($this->mysql_link);
	}

	/**
	* @desc public : Passe � l'enregistrement suivant
	* @param void
	* @return boolean
	*/
	public function next_record() {
		if (!$this->query_id) {
      		die ("next_record() a �t� appel�e sans aucune requ�te associ�e");
    	}
    	
    	$this->record = mysqli_fetch_array($this->query_id);
    	$retour = is_array( $this->record );
    	if ( !$retour && $this->auto_free ) {
    		$this->free();
    	}
    	
    	return $retour;
	}
	
	
	function query2data($sql, &$data, $escape = false) {

		$data = array();
		$this->query($sql);

		while($item = mysqli_fetch_array($this->query_id, MYSQLI_ASSOC)) {
			$data[] = $item;

		}

		if (is_array($data) && count($data) > 0) {

			//boucle echapper caract�res
			foreach ($data as $key => $tabEnreg) {

				foreach ( $tabEnreg as $champ => $valeurChamp) {

					if ( $escape ) {
						$data[$key][$champ] = htmlspecialchars ($valeurChamp) ;
					} else {
						$data[$key][$champ] = $valeurChamp;
					}
				}
			}
			return true;

		} else {
			return false;
		}
	}
	
	
	/**
	* @desc public : Nombre de lignes affect�es lors de la derni�re requ�te SQL MYSQL
	* @param void
	* @return integer
	*/
	public function affected_rows() {
		return mysqli_affected_rows($this->mysql_link);
	}
	
	/**
	* @desc public : Retourne le nombre de lignes d'un r�sultat MYSQL
	* @param void
	* @return integer
	*/
	public function num_rows() {
		return mysqli_num_rows($this->query_id);
	}
	
	/**
	* @desc public : Retourne le nombre de champs d'un r�sultat MYSQL
	* @param void
	* @return integer
	*/
	public function num_fields() {
		return mysqli_num_fields($this->query_id);
	}
	
	
	
	
	/**
	* @desc public : efface le resultat d'une requete
	* @param void
	* @return void - Arrete l'application
	*/
	public function free() {
		mysqli_free_result($this->query_id);
		$this->query_id = 0;
	}
	
	
	/**
	* @desc Retourne une chaine �chapp�e par la fonction mysqli_real_escape_string()
	* @param string
	* @return string
	*/
	public function escape_string($string) {
		return mysqli_real_escape_string($this->mysql_link, $string);	
	}
	
	
}

/*
$db = new db_mysql();
$db->query("SELECT * FROM test");
while($db->next_record()) {
	echo $db->record['id'] . " | " . $db->record['lib'] . "</br>";	
}

echo $db->num_rows();
echo $db->affected_rows();
echo $db->num_fields();
*/

?>
