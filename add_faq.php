<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ajout d'une question</title>
</head>
<body>
<div class="partiefaq">

<?php 

echo "<button><a href='index.php #pharmacie'>Retour sur le site</a></button>";
echo "<button><a href='faq.php'>Retour aux questions</a></button>";


?>
</div> 
<?php 
echo "<h2>Ajouter une question</h2>";
session_start ();
    
$connection = new PDO('mysql:host=localhost:3308;dbname=WebGroup_test', 'root', '');
   
    echo "<form action='' method='post' class='form-eddit'>";
    echo "<input type='text' name='question'class='input-faq' value=''>";   
    echo "<input type='submit' value='ajouer'>";
    echo "</form>";

if(isset($_POST['question'])){
    
	
    $ajout="INSERT INTO FAQ (question) VALUES ('".$_POST['question']."')";
	$stmt = $connection->prepare($ajout);
    $stmt->execute();
  

}

if(isset($_POST['question'])) {
    header("Location:faq.php");
    }


